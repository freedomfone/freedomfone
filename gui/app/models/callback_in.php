<?php
/****************************************************************************
 * callback_in.php	- Model for callback requests. Manages outgoing calls, and user limits.
 * version 		- 1.0.353
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


App::import('Core', 'Socket');

class CallbackIn extends AppModel{

      var $name = 'CallbackIn';


/**
 * Check if the number of callbacks allowed (within a certain time limit) for a user has exceeded its maximum value or not
 * return true| false
 *
 */
	function withinLimit($sender){

		 $data = $this->query("select * from callback_settings where instance_id=100 limit 0,1");

		       if ($data[0]['callback_settings']['limit_time']==0 | $data[0]['callback_settings']['limit_user'] ==0 ){
	    	       	  return true;
			  }
		       else {

		       	$epoch_limit = time()-$data[0]['callback_settings']['limit_time']*3600;
			$user_limit  = $data[0]['callback_settings']['limit_user'];
			$response = $this->find('count', array('conditions' => array('CallbackIn.sender' => $sender,'CallbackIn.created >' => $epoch_limit,'CallbackIn.status' =>'1')));

		    		  if($response >= $user_limit){
		        	  	       return false;
		     			       }
		     			       else {
		     			       return true;
		     	             }
		   }

	}




/*
 * Fetching new data from spooler
 *
 *
 */

	function dial($data){

	$settings = $this->query("select response_type from callback_settings where instance_id=100 limit 0,1");
	$ext  = $settings[0]['callback_settings']['response_type'];

        $defaults = array(
        'host' => '127.0.0.1',
        'port' => '9999',
        'timeout' => 30,
        'stream_timeout' => 5
        );

	$id = $data['id'];
	$proto = $data['proto'];
	$sender = $data['sender'];


	$msg = $id.",".$proto.','.$sender.','.$ext;
		 $this->Socket = new CakeSocket($defaults);	
		 $this->Socket->connect();
		 $this->Socket->write($msg);
		 $this->Socket->disconnect();
	}
}

?>
