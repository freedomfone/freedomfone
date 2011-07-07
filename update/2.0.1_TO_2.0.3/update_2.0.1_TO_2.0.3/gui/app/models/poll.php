<?php
/****************************************************************************
 * poll.php		- Model for poll. Manages validation of poll creation, and refresh data from spooler.
 * version 		- 2.0.1160
 * 
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 *
 * The Initial Developer of the Original Code is
 *   Louise Berthilson <louise@it46.se>
 *
 *
 ***************************************************************************/


class Poll extends AppModel{


      var $name = 'Poll';
      var $hasMany = array('Vote' => array(
                        	       'order' => 'Vote.id ASC',
                        	       'dependent' => true)
				       ); 



function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

      $this->validate = array(
        'question' => array(
            'rule'=>array('minLength', 10),
	    'required' => true,
            'message'=> __('A valid question is required.',true)
	    ),
	'code' => array(
			'alphaNumeric' => array(
 				       'rule' => 'alphaNumeric',
 				       'message' => __('Letters and numbers only. No spaces or special characters allowed.',true)
 				       ),
 			'between' => array(
 				       'rule' => array('between', 1, 10),
 				       'message' => __('Between 1 to 10 characters',true)
 				       ),
	                'isUnique' =>array(
				     'rule' => 'isUnique',
				     'message' => __('This SMS code is already in use.',true)
				     )
 		),
	'start_time' => array(
			'checkDate' => array(
        				       'rule' => array('checkDate', 'start_time' ),
        				       'message' => __('The date is not valid.',true)
                )
            ),	
	'end_time' => array(
			'compareFieldValues' => array(
        				       'rule' => array('compareFieldValues', 'start_time' ),
        				       'message' => __('The end time must be later than the start time.',true)
                			       ),
			'checkDate' => array(
        				       'rule' => array('checkDate', 'end_time' ),
        				       'message' => __('The date is not valid.',true)
                			       )

            ) 
	);
}


/*
 * Validation: check that number of days is matching month
 *
 *
 */
function checkDate($data,$field){

	 $date = date_parse($data[$field]);

	 if(checkdate($date['month'],$date['day'],$date['year'])){ 
	 	return true;
		} else {
		return false;
		}

}


/*
 * Validation: Comparison of two fields
 *
 *
 */

 function compareFieldValues( $data, $field) 
    {
        foreach( $data as $key => $value ){
            $v1 = $value;
            $v2 = $this->data[$this->name][ $field ];                 
            if($v2 > $v1) {
                return FALSE;
            } else {
                continue;
            }
        }
        return TRUE;
    }



/*
 * Validation: Checks if a given timestamp is less than current timestamp
 *
 *
 */

   function futureDate($data, $field){

   	       date_default_timezone_set(Configure::read('Config.timezone'));

                if (strtotime($data[$field]) < time()){
                        return FALSE;
                }
                return TRUE;
    } 

    function getTitle($id){

    $data = $this->findById($id);
    return $data['Poll']['question'];     
    }


/*
 * Calculates and sets status of a poll before saving
 *
 *
 */

    function beforeSave(){

        date_default_timezone_set(Configure::read('Config.timezone'));
	$start = strtotime($this->data['Poll']['start_time']);
	$end   = strtotime($this->data['Poll']['end_time']);
	$now = time();


      	if ($start < $now && $end < $now ){ 
      	 $this->data['Poll']['status']=2;
	 }

      	elseif ($start > $now ){ 
      	 $this->data['Poll']['status']=0;
	 }

	 else {
      	 $this->data['Poll']['status']=1;
	 }


    	 return true;

    }


/*
 * Fetches new data from spooler
 *
 *
 */

     function refresh(){

      $array = Configure::read('poll_in');
 


	       $obj = new ff_event($array);	       

	       if ($obj -> auth != true) {

    	       	  die(printf("Unable to authenticate\r\n"));
	       }


      	    while ($entry = $obj->getNext('update')){

                $userData = false;
	        $body 	        =  $entry['Body']; 
		$_message	=  explode(' ',$body);
		$polls_code   	=  trim($_message[0]);
		$votes_chtext 	=  trim($_message[1]);
		$sender		=  urldecode($entry['from']);
		$proto		=  $entry['proto'];
	        $created 	= floor($entry['Event-Date-Timestamp']/1000000);
		$matched      	=  false;

		// CHECK A: SMS CODE EXISTS (VALID/INVALID)
		if ($poll_entry = $this->findByCode( $polls_code)){
		   
			$poll_id = $poll_entry['Poll']['id'];
			$status = $poll_entry['Poll']['status'];

			//Fetch valid chtext for identified poll
	   		foreach ($poll_entry['Vote'] as $key => $vote){
	
				//Search for matching chtext
				if (!strcasecmp($votes_chtext,$vote['chtext'])){
		   	   		$matched=true;
					$vote_id = $vote['id'];        
		   		 }
	 	        }

			        //CHECK A1: VALID VOTE (correct code, correct chtext)

				if ($matched){		   	   	  
			
				  switch($status){

				   case 0:
				   //ADD TO STATS (early)
				   $mode=__("Valid, early",true);
				   $this->Vote->query("UPDATE votes SET votes_early=votes_early+1 WHERE id=$vote_id "); 
				   break;

				   case 1:
				   //ADD TO STATS (open)
		   	   	   $this->Vote->query("UPDATE votes SET chvotes=chvotes+1 WHERE id= $vote_id "); 
				   $mode=__("Valid, open", true);
				   break;


				   case 2:
				   //ADD TO STATS (closed)
				   $mode=__("Valid, closed",true);
		   	   	   $this->Vote->query("UPDATE votes SET votes_closed=votes_closed+1 WHERE id=$vote_id "); 
				   break;

				   }

				} else {

				//CHECK A2: INVALID VOTE (correct code, invalid chtext)
				   switch($status){

				   case 0:
				   //ADD TO STATS (early)	
				   $mode=__("Invalid, early",true);
				   $this->query("UPDATE polls SET invalid_early=invalid_early+1 WHERE id=$poll_id ");
				   break;

				   case 1:
				   //ADD TO STATS (open)
				   $mode=__("Invalid, open", true);
				   $this->query("UPDATE polls SET invalid_open=invalid_open+1 WHERE id=$poll_id ");
				   break;


				   case 2:
				   //ADD TO STATS (closed)
				   $mode=__("Invalid, closed",true);
				   $this->query("UPDATE polls SET invalid_closed=invalid_closed+1 WHERE id=$poll_id");
				   break;

				   }

	 	         	}
				$application = 'poll';

		} else {
		// CHECK B: INCORRECT VOTE (no matching code)

			
			 //ADD TO TRASH
	   		 $mode=__("Unclassified",true);
			 $application = 'bin';
			 $result = $this->query("insert into bin (body,sender,created,mode,proto)values ('$body','$sender','$created','$mode','$proto')");
	        }

  	        //Add data to CDR
	        $resultCdr = $this->query("insert into cdr (epoch, channel_state, call_id, caller_name, caller_number, extension,application,proto) values ('$created','MESSAGE','','','$sender','','$application','$proto')");
	        $this->log("Message: ".$mode."; Body: ".$body."; From: ".$sender."; Timestamp: ".$created, "poll"); 



                        $field = false;
		  	if( strcasecmp($proto,'skype')) { $field = 'skype';}
		  	elseif( strcasecmp($proto,'gsm')) { $field = 'PhoneNumber.number';}
			elseif( strcasecmp($proto,'sip')) { $field = 'PhoneNumber.number';}

		        if($application=='poll')  { 
                            $update = 'count_poll';
                        } else { 
                            $update = 'count_bin'; 
                        } 

			$value = urldecode($entry['from']);                        
                        $this->bindModel(array('hasMany' => array('User' => array('className' => 'User','foreignKey' => 'id'))));

                        //Does user exist in database
                        if (strcasecmp($proto,'sip') || strcasecmp($proto,'gsm')){

                           $userData = $this->User->PhoneNumber->find('first',array('conditions' => array('PhoneNumber.number' => $value)));

                        } elseif (strcasecmp($proto,'skype')){

                           $userData = $this->User->find('first',array('conditions' => array('skype' => $value)));

                        }

                        if ($userData){

		 		$count = $userData['User'][$update]+1;
				$id = 	$userData['User']['id'];
                                $this->User->read(null, $id);
	 			$this->User->set(array($update => $count,'last_app'=>$application,'last_epoch'=>time()));
		 		$this->User->save($this->User->data,false);

		        } else {

			      $created = time();

                              if(strcasecmp($proto,'sip') || strcasecmp($proto,'gsm')){

                                 $user = array('created'=> $created,'new'=>1,$update=>1,'first_app'=>$application,'first_epoch' => $created, 'last_app'=>$application,'last_epoch'=>$created,'acl_id'=>1,'name' => __('Unknown user',true));
                                 if($this->User->save($user,false)){
					$user_id = $this->User->getLastInsertId();
                                 	$phonenumber = array('user_id' => $user_id, 'number' => $value);
                                 	$this->User->PhoneNumber->saveAll($phonenumber);
			          }

                              } elseif ( strcasecmp($proto,'skype')){

                                 $user = array('skype' => $value,'created'=> $created,'new'=>1,$update=>1,'first_app'=>$application,'first_epoch' => $created, 'last_app'=>$application,'last_epoch'=>$created,'acl_id'=>1,'name' => __('Unknown user',true));

                                 $this->User->save($user,false);

                              }

		       }



	} //while

        $this->unbindModel(array('hasMany' => array('User')));

	// Update status of polls (use beforeSave to update status)
	$data = $this->findAll();
	foreach ($data as $key => $entry){
		$this->save($entry);
	}


   }

}



?>
