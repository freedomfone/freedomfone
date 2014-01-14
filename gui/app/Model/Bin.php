<?php
/****************************************************************************
 * bin.php		- Model for SMS that does not match existing polls (aka 'Other SMS'). Manages refresh method from spooler.
 * version 		- 3.0.1500
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

     	   while ($entry = $obj->getNext('delete')){

	      $created  = intval(floor($entry['Event-Date-Timestamp']/1000000));
	      $sender	= $this->sanitizePhoneNumber($entry['from']);
	      $proto   = $entry['proto'];
       	      $login   = $entry['login'];

	      //FIXME!!!
	      //$channel = getChannel($proto,$login);
	 
              //Update user statistics
              $user_id = $this->updateUserStatistics($proto,$sender,$application, $update);

              //Save bin data
              $this->create();   

     	      $data= array ('body' => $entry['Body'], 'sender' => $sender, 'created' => $created, 'mode' => $mode, 'proto' => $proto, 'login' => $login, 'channel' => $this->protoToChannel($proto), 'user_id' => $user_id);   
	      $result = $this->save($data);
	      $this->log("[INFO] NEW SMS, Body: ".$entry['Body'].", From: ".$sender.", Epoch: ".$created.", Login. ".$login, "bin"); 


              //Create CDR
	     $resultCdr = $this->query("insert into cdr (epoch, channel_state, call_id, caller_name, caller_number, extension, application, proto, login,  user_id) values ('$created','MESSAGE','','','$sender','','$application','$proto', '$login', '$user_id')");

              $this->log("[INFO] NEW CDR, Application: ".$application.", Epoch: ".$created, "cdr");

	      }

	}





}

?>
