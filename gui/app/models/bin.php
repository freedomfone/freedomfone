<?php
/****************************************************************************
 * bin.php		- Model for SMS that does not match existing polls (aka 'Other SMS'). Manages refresh method from spooler.
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

class Bin extends AppModel{

      var $name = 'Bin';


    function getBody($id){

    	  $data = $this->findById($id);
    	  return $data['Bin']['body'];     

    }


/*
 * Fetches new data from spooler
 *
 *
 */

    function refresh(){

      $array       = Configure::read('bin');
      $mode        = __("Unclassified",true);
      $application = 'bin';
      $update      = 'count_bin'; 
      $obj         = new ff_event($array);	       

       	   if ($obj -> auth != true) {
  	       	  die(printf("Unable to authenticate\r\n"));
           }

     	    while ($entry = $obj->getNext('update')){

	      $created  = floor($entry['Event-Date-Timestamp']/1000000);
	      $sender	= urldecode($entry['from']);
	      $proto   = $entry['proto'];
              
      	      $data= array ('body' => $entry['Body'], 'sender' => $sender, 'created' => $created, 'mode' => $mode,'proto'=>$proto);
	      
	      $this->create();
	      $result = $this->save($data);
	      $this->log("Message: ".$mode."; Body: ".$entry['Body']."; From: ".$sender."; Timestamp: ".$created, "bin"); 
	 
	      //add to CDR
	     $resultCdr = $this->query("insert into cdr (epoch, channel_state, call_id, caller_name, caller_number, extension,application,proto) values ('$created','MESSAGE','','','$sender','','$application','$proto')");

                        $field = false;
		  	if( strcasecmp($proto,'skype')) { $field = 'User.skype';}
		  	elseif( strcasecmp($proto,'gsm')) { $field = 'PhoneNumber.number';}
			elseif( strcasecmp($proto,'sip')) { $field = 'PhoneNumber.number';}




                        $this->bindModel(array('hasMany' => array('User' => array('className' => 'User','foreignKey' => 'user_id'))));

                        //Does user exist in database
                        if (strcasecmp($proto,'sip') || strcasecmp($proto,'gsm')){

                           $userData = $this->User->PhoneNumber->find('first',array('conditions' => array('PhoneNumber.number' => $sender)));

                        } elseif (strcasecmp($proto,'skype')){

                           $userData = $this->User->find('first',array('conditions' => array('skype' => $sender)));

                        }


                        if ($userData){

		 		$count = $userData['User'][$update]+1;
				$id    = $userData['User']['id'];
                                $this->User->id = $id;
	 			$this->User->set(array('id' => $id, $update => $count,'last_app'=>$application,'last_epoch'=>time()));
 		 		$this->User->save();

		        } else {

			      $created = time();

                              if(strcasecmp($proto,'sip') || strcasecmp($proto,'gsm')){

                                 $user =array('created'=> $created,'new'=>1,$update=>1,'first_app'=>$application,'first_epoch' => $created, 'last_app'=>$application,'last_epoch'=>$created,'acl_id'=>1);
                                 $this->User->save($user);
                                 $user_id = $this->User->getLastInsertId();
                                 $phonenumber = array('user_id' => $user_id, 'number' => $sender);
                                 $this->User->PhoneNumber->saveAll($phonenumber);

                              } elseif ( strcasecmp($proto,'skype')){

                                 $user =array($field => $sender,'created'=> $created,'new'=>1,'count_ivr'=>1,'first_app'=>$application,'first_epoch' => $created, 'last_app'=>$application,'last_epoch'=>$created,'acl_id'=>1);
                                 $this->User->save($user);
  
                              }
		       }

                       $this->unbindModel(array('hasMany' => array('User')));

	      }

	}

}

?>
