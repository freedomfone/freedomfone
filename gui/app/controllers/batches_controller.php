<?php
/****************************************************************************
 * batches_controller.php	- Manage batches of outgoing SMS 
 * version 		 	- 3.0.1500
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

class BatchesController extends AppController{

      var $name = 'Batches';

      var $helpers = array('Time','Html', 'Session','Form','Ajax','Flash');
      var $components = array('RequestHandler');



      function add_batch(){

      	    $this->loadModel('Channel');
            //$this->set('channels',$this->Channel->find('list', array('fields' => array('IMSI'))));

      $auth  = Configure::read('GAMMU');
      $gammu = new sms('mysql', $auth);
      $phones    = $gammu->getPhones(); 

      foreach($phones as $phone){
        $channels[] = $phone[0];
      }

      $officeroutes  = Configure::read('OR_SNMP');
      foreach($officeroutes as $officeroute){
        
	$channels[] = "OR ".$officeroute['ip_addr']." ".$officeroute['domain'];
      }

      $this->set('channels',$channels);

      	       
	       //Process form data
	       if($this->data){

	        //Validate data 
	        if ($this->Batch->saveAll($this->data, array('validate' => 'only'))) {


		$receivers = file($this->data['Batch']['file']['tmp_name']);
		unset($this->data['Batch']['file']);

		if($receivers){

			//Save batch data
	  		$this->Batch->save($this->data['Batch']);
	 		$batch_id = $this->Batch->getLastInsertId();

			foreach($receivers as $key => $receiver){
		  	  $this->data['SmsReceiver'][$key]['batch_id'] = $batch_id;
		  	  $this->data['SmsReceiver'][$key]['receiver'] = trim($receiver);
			}

	 		//Save sms receiver data
	 		$this->Batch->SmsReceiver->create($this->data['SmsReceiver']);
	 		$this->Batch->SmsReceiver->saveAll($this->data['SmsReceiver'],array('validate' => false));
				
	         } 
                }
	       }
      } //add_batch


}
?>
