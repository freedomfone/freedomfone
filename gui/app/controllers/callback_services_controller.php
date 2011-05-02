<?php
/****************************************************************************
 * callback_services_controller.php	- Controller for SMS based Callback Services.
 * version 		 	        - 2.5.1200
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

class CallbackServicesController extends AppController{

	var $name = 'CallbackServices';
	var $helpers = array('Flash');      

	var $paginate = array(
		    	      'limit' => 50,
			      'order' => array('CallbackService.code' => 'asc'));


/*
 *
 * Create new Callback Service
 *
 *
 */
        function add(){

           $callback_type  = 'IN';
           $status         = 'pending';
   	   $dialer = Configure::read('DIALER');
               
               $this->loadModel('PhoneBook');
               $phonebooks = $this->PhoneBook->find('list');

               $this->loadModel('IvrMenu');
               $ivr = $this->IvrMenu->find('list',array('conditions' => array('ivr_type' => 'ivr'), 'fields' => array('instance_id','title'),'recursive' => 0));
               $selector = $this->IvrMenu->find('list',array('conditions' => array('ivr_type' => 'switcher'), 'fields' => array('instance_id','title'),'recursive' => 0));
               
               $this->loadModel('LmMenu');
               $lam = $this->LmMenu->find('list',array('fields' => array('instance_id','title'),'recursive' => 0));

               $this->loadModel('CallbackSetting');
               $settings = $this->CallbackSetting->find('first');

               $maxduration   = $settings['CallbackSetting']['max_duration'];
               $retryinterval = $settings['CallbackSetting']['retry_interval'];
               $maxretries    = $settings['CallbackSetting']['max_retries'];

               $this->set(compact(array('phonebooks','ivr','selector','lam','maxduration','retryinterval','maxretries')));

               //Form data exists, store and push to dialer	   
               if (!empty($this->data)){ 


                  $this->CallbackService->set($this->data);

                  if($this->CallbackService->saveAll($this->data)){

       	                   $this->_flash(__('The Callback Service has successfully been added',true), 'success');                           	 
                           $this->redirect(array('action'=>'index'));

                   } else {
       	           
       	                   $this->_flash(__('The Callback Service could not be created.',true), 'error');                           	 
                           
                   }

                }

         }
        

}
?>
