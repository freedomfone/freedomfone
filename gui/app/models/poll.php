<?php
/****************************************************************************
 * poll.php		- Model for poll. Manages validation of poll creation, and refresh data from spooler.
 * version 		- 1.0.359
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
 				       'message' => __('Alphabets and numbers only',true)
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
	'end_time' => array(
			'compareFieldValues' => array(
        				       'rule' => array('compareFieldValues', 'start_time' ),
        				       'message' => __('The end time must be later than the start time.',true)
                )
            ) 
	);
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
      $instance_id = IID;
	      
	       $obj = new ff_event($array);	       

	       if ($obj -> auth != true) {

    	       	  die(printf("Unable to authenticate\r\n"));
	       }

      	    while ($entry = $obj->getNext('update')){

	        $body 	        =  $entry['Body']; 
		$_message	=  explode(' ',$body);
		$polls_code   	=  trim($_message[0]);
		$votes_chtext 	=  trim($_message[1]);
		$sender		=  $entry['from'];
	        $created 	= floor($entry['Event-Date-Timestamp']/1000000);
		$matched      	=  false;

		// CHECK A: CODE OK (VALID OR INCORRECT)
		if ($poll_entry = $this->findByCode( $polls_code)){
		   
			$poll_id = $poll_entry['Poll']['id'];
			$status = $poll_entry['Poll']['status'];

			//Fetch valid chtext for identified poll
	   		foreach ($poll_entry['Vote'] as $key => $vote){
	
				//Search for matching chtext
				if (strcasecmp($votes_chtext,$vote['chtext'])==0){
		   	   		$matched=true;
					$vote_id = $vote['id'];
		   		 }
	 	         }		 

			        //CHECK A1: OPTION CORRECT (correct code, correct chtext)

				if ($matched){		   	   	  
			
				  switch($status){

				   case 0:
				   //ADD TO TRASH (pending)
				   $mode="VALID VOTE, PENDING";
				   $result = $this->query("insert into bin (instance_id,body,sender,created,mode)values ($instance_id,'$body','$sender','$created','$mode')");
				   break;

				   case 1:
				   //ADD TO STATS (open)
		   	   	   $this->Vote->query("UPDATE votes SET chvotes=chvotes+1 WHERE id=$vote_id "); 
				   $mode="VALID VOTE, OPEN";
				   break;


				   case 2:
				   //ADD TO STATS (closed)
				   $mode="VALID VOTE, CLOSED";
		   	   	   $this->Vote->query("UPDATE votes SET votes_closed=votes_closed+1 WHERE id=$vote_id "); 
				   break;

				   }

				} else {

				//CHECK A2: OPTION INCORRECT (correct code, invalid chtext)
				   switch($status){

				   case 0:
				   //ADD TO TRASH (pending)
				   $mode="INCORRECT VOTE, PENDING";
				   $result = $this->query("insert into bin (instance_id,body,sender,created,mode)values ($instance_id,'$body','$sender','$created','$mode')");
				   break;

				   case 1:
				   //ADD TO STATS (open)
				   $mode="INCORRECT VOTE, OPEN";
				   $this->query("UPDATE polls SET incorrect_open=incorrect_open+1 WHERE id=$poll_id ");
				   break;


				   case 2:
				   //ADD TO STATS (closed)
				   $mode="INCORRECT VOTE, CLOSED";
				   $this->query("UPDATE polls SET incorrect_closed=incorrect_closed+1 WHERE id=$poll_id");
				   break;

				   }

	 	         	}

		} else {
		// CHECK B: CODE NOT OK (INVALID)

			
			 //ADD TO TRASH
	   		 $mode="INVALID VOTE";
			 $result = $this->query("insert into bin (instance_id,body,sender,created,mode)values ($instance_id,'$body','$sender','$created','$mode')");
	        }

	$this->log("Message: ".$mode."; Body: ".$body."; From: ".$sender."; Timestamp: ".$created, "poll"); 

	}


	// Update status of polls (use beforeSave to update status)
	$data = $this->findAll();
	foreach ($data as $key => $entry){
		$this->save($entry);
	}


   }

}



?>