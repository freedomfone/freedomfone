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

      var $helpers = array('Time','Html', 'Session','Form','Flash');
      var $components = array('RequestHandler');
      var $layout ='jquery';


    function index(){


          $this->set('title_for_layout', __('SMS Outboxes',true));
      	  $this->set('channels',$this->Batch->getChannels());

     	  $this->Batch->recursive = 1; 
   	  $batch = $this->paginate();


	  $this->loadModel('SmsGateway');
      	  $sms_gateways = $this->SmsGateway->find('list', array('fields' => array('name')));

 	  $this->set(compact('batch','sms_gateways'));

      }


    function disp(){


    	     $sender = $this->request->data['Batch']['sender'];
    	     if(is_numeric($sender)){
		$data   = $this->paginate('Batch', array('Batch.sms_gateway_id' => $sender));
	     } elseif(!$sender)  {
	       $data   = $this->paginate('Batch');
	     } else {
	       $data   = $this->paginate('Batch', array('Batch.sender' => $sender));
	     }


    	     $this->set('batch',$data);  


    }

    function method(){

    if($this->request->data['Batch_method']['gateway_type']== 0){

	    $this->loadModel('SmsGateway');
      	    $this->set('options',$this->SmsGateway->find('list', array('fields' => array('id','name'))));
	    $this->set('gateway_type','IP_GW');

    } elseif ($this->request->data['Batch_method']['gateway_type']== 1){

	    $this->set('gateway_type','GSM_GW');
      	    $this->set('options',$this->Batch->getChannels());

    } 


    }

      function add(){


            //Process form data
	       if($this->request->data){

	        //Validate data 

	        if ($this->Batch->saveAll($this->request->data['Batch'], array('validate' => 'only'))) {

		if($this->request->data['Batch']['gateway_type']== 'IP_GW'){
			$this->loadModel('SmsGateway');
			$tmp = $this->SmsGateway->findById($this->request->data['Batch']['sms_gateway_id']);
			$this->request->data['Batch']['gateway_code'] =  $tmp['SmsGateway']['gateway_code'];
		} else {
		        $this->request->data['Batch']['gateway_code'] =  substr($this->request->data['Batch']['sms_gateway_id'],0,2); 
		        $this->request->data['Batch']['sender'] =  $this->request->data['Batch']['sms_gateway_id'];
			unset($this->request->data['Batch']['sms_gateway_id']);
		}


		$receivers = file($this->request->data['Batch']['file']['tmp_name']);
		unset($this->request->data['Batch']['file']);

		if($receivers){

		        $receivers = $this->validateReceivers($receivers, $this->request->data['Batch']['gateway_code'], $this->getPrefix());
			

			//Save batch data
	  		$this->Batch->save($this->request->data['Batch']);
	 		$batch_id = $this->Batch->getLastInsertId();

			foreach($receivers as $key => $receiver){
		  	  $this->request->data['SmsReceiver'][$key]['batch_id'] = $batch_id;
		  	  $this->request->data['SmsReceiver'][$key]['receiver'] = trim($receiver);
			}

	 		//Save sms receiver data
	 		$this->Batch->SmsReceiver->create($this->request->data['SmsReceiver']);
	 		$this->Batch->SmsReceiver->saveAll($this->request->data['SmsReceiver'],array('validate' => false));
				
	         }

		 //$this->Batch->processBatch($batch_id); 

		 $this->redirect(array('action' => 'index'));

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
