<?php
/****************************************************************************
 * BatchesController.php	- Manage batches of outgoing SMS 
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

      var $paginate = array('page' => 1, 'limit' => 25, 'order' => array( 'Batch.created' => 'desc')); 
      var $helpers = array('Time','Html', 'Session','Form','Flash');
      var $components = array('RequestHandler');
      var $layout ='jquery';


    function index(){


          $this->set('title_for_layout', __('SMS Batches',true));

     	  $this->Batch->recursive = 1; 
   	  $batch = $this->paginate();


      	  $sms_gateways = $this->Batch->SmsGateway->find('list', array('fields' => array('SmsGateway.name')));
      	  $gsm_gateways = $this->Batch->find('list', array('conditions' => array('sms_gateway_id' => 0), 'fields' => array('sender')));

 	  $this->set(compact('batch','sms_gateways','gsm_gateways'));

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

          $this->set('title_for_layout', __('Create SMS batch',true));

            //Process form data
	       if(array_key_exists('Batch', $this->request->data)){

	        //Validate data 
		$fileData = $this->request->data['Batch']['file'];
		unset($this->request->data['Batch']['file']);
		$this->request->data['Batch']['filename'] = $fileData['tmp_name'];


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


		$receivers = file($fileData['tmp_name']);

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
			  $sms_receiver_id[] = $this->Batch->SmsReceiver->getLastInsertId();
			 
		          $status = $this->Batch->processBatch($batch_id); 
		

			  //For Clickatell: update apimsgid for receivers
			  if($this->request->data['Batch']['gateway_code'] == 'CT'){

			  	foreach($receivers as $key => $receiver){
		  	  	  		   $data['SmsReceiver'][$key]['id'] = $sms_receiver_id[$key];
						   $data['SmsReceiver'][$key]['apimsgid'] = $status[0][$key];
				}

	 		$this->Batch->SmsReceiver->saveAll($data['SmsReceiver'], array('validate' => false));
			
		
			} //Clickatell

		} //receivers

		 //Save batch status
		 if(!$status){
			$status=false	;
		 } elseif(is_array($status[0])){
		        $status=true;
		 } else { 
		        $status=false;
			$this->Session->setFlash($status[0]);
		 }

		 $this->Batch->id = intval($batch_id);
	       	 $this->Batch->saveField('status', $status);	

		 $this->redirect(array('action' => 'index'));		 

                }
	       }



      } //add



    function delete ($id){

    
    	     if($this->Batch->delete($id))
	     {
		$this->Session->setFlash('SMS batch has been deleted.','success');
                $this->log('[INFO], SMS DELETED; Id: '.$id, 'batch');
	     	$this->redirect(array('action' => 'index'));
	     }

    }



    function view($id){

        if($id){
     	     $this->requestAction('/batches/update/'.$id);

     	     $this->Batch->recursive = 1; 
             $batches = $this->paginate('Batch', array('Batch.id' => $id));
	     $this->set(compact('batches'));

	     }
    }


    function update($id){

      $data = $this->Batch->findById($id);
      $code = $data['Batch']['gateway_code'];

	 $sms = $this->Batch->authBatch($id);

      foreach($data['SmsReceiver']  as $key => $entry){

         //Update status

    	 $status = $this->Batch->getStatus($sms, $code, $entry['apimsgid']);
	 $data['SmsReceiver'][$key]['status'] = $status;

      }

         $this->Batch->saveAll($data);
    }


    function process(){

    	     if(array_key_exists('Submit', $this->request->data)){

	        if($this->request->data['Submit'] == 'Delete'){

		  foreach($this->request->data['batch'] as $id){
		    $this->Batch->delete($id);
                  }
		}

	     }

	     	$this->redirect(array('action' => 'index'));	     
    }
}
?>
