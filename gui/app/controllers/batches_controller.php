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

    function index(){

          $this->set('title_for_layout', __('SMS Outboxes',true));
      	  $this->set('channels',$this->Batch->getChannels());

     	  $this->Batch->recursive = 1; 
   	  $batch = $this->paginate();
 	  $this->set(compact('batch'));
      }


    function disp(){

    	     $sender = $this->data['Batch']['sender'];
    	     if($sender){
		$data   = $this->paginate('Batch', array('Batch.sender' => $sender));
	     } else { 
	       $data   = $this->paginate('Batch');
	     }

    	     $this->set('batch',$data);  


    }


      function add(){


      	    $this->set('channels',$this->Batch->getChannels());

      	       
	       //Process form data
	       if($this->data){

	        //Validate data 
	        if ($this->Batch->saveAll($this->data, array('validate' => 'only'))) {

		$this->data['Batch']['gateway_type'] =  substr($this->data['Batch']['sender'],0,2); 


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

		 $this->Batch->processBatch($batch_id); 
                }
	       }
      } //add



    function delete ($id){

    
    	     if($this->Batch->delete($id))
	     {
		$this->Session->setFlash('SMS batch has been deleted.');
                $this->log('[INFO], SMS DELETED; Id: '.$id, 'batch');
	     	$this->redirect(array('action' => 'index'));
	     }

    }

}
?>
