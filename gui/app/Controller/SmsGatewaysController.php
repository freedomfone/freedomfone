<?php
/****************************************************************************
 * SmsGatewaysController.php	- Manage gateways for outgoing SMS 
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

class SmsGatewaysController extends AppController{

      var $name = 'SmsGateways';
      var $components = array('RequestHandler');
      var  $paginate = array('limit' => 50, 'page' => 1, 'order' => array( 'SmsGateway.name' => 'desc')); 

    function index(){

          $this->set('title_for_layout', __('SMS Gateways',true));

     	  $this->SmsGateway->recursive = 0; 
   	  $gateways = $this->paginate('SmsGateway');
 	  $this->set(compact('gateways'));
     

    }



    function disp(){

    }


      function add(){

          $this->set('title_for_layout', __('Create SMS Gateway',true));

	       //Process form data
	       if(array_key_exists('SmsGateway', $this->request->data)){

	       	  if ($this->SmsGateway->saveAll($this->request->data, array('validate' => 'only'))) {
	  		$this->SmsGateway->save($this->request->data['SmsGateway']);
                	$this->log('[INFO], SMS GATEWAY ADDED; Name: '.$this->request->data['SmsGateway']['name'], 'sms_gateway');
	     		$this->redirect(array('action' => 'index'));				
	           }

	       }

      } 

    function edit ($id){

        $this->set('title_for_layout', __('Edit SMS gateway',true),true);
 
	   if (!$id && empty($this->request->data)){ 
			$this->Session->setFlash(__('Invalid SMS gateway', true)); 
			$this->redirect(array('action'=>'index')); 
	    } elseif (empty($this->request->data['SmsGateway'])){ 

		$this->request->data = $this->SmsGateway->read(null,$id);

	   } else{
   
                //Fetch form data
	        $this->SmsGateway->set( $this->request->data );

	        //Validate data
	        if ($this->SmsGateway->saveAll($this->request->data, array('validate' => 'only'))) {

	            //Save  data

	            $this->SmsGateway->save($this->request->data);
                    $this->Session->setFlash(__("The SMS gateway has been updated.",true),'success');
                    $this->redirect(array('action' => 'index'));

		 }
              }
    }


    function delete ($id){

    	     if($this->SmsGateway->delete($id))
	     {
		$this->Session->setFlash('SMS gateway has been deleted.');
                $this->log('[INFO], SMS GATEWAY DELETED; Id: '.$id, 'sms_gateway');
	     	$this->redirect(array('action' => 'index'));
	     }


    }

}
?>
