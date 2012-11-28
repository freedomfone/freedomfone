<?php
/****************************************************************************
 * callback_services_controller.php	- Controller for SMS based Callback Services.
 * version 		 	        - 2.5.1700
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
	var $helpers = array('Flash','Ajax','Formatting','Xml','Number');      
        var $components = array('RequestHandler','Security');

	var $paginate = array(
		    	      'limit' => 50,
			      'order' => array('CallbackService.code' => 'asc'));


/*
 *
 * List all Callback Services
 *
 *
 */

        function index(){

                 $this->pageTitle   = __('Callback Services',true);


		 
                 if($this->data){

                        $this->CallbackService->updateAll(array('CallbackService.tickle' => 0));
			if($this->data['CallbackService']['tickle']){	

                    	     $this->CallbackService->id = $this->data['CallbackService']['tickle'];
                             $this->CallbackService->saveField('tickle',1);
			}
                 }


		 $tickle = $this->CallbackService->find('first', array('recursive' => false, 'conditions' => array('tickle' => 1)));


                 $services = $this->paginate('CallbackService');
                 foreach($services as $key => $service){

                       $result = $this->getServiceName($service['CallbackService']['extension']);
                       $services[$key]['CallbackService']['service_name'] = $result['service_name'];
                       $services[$key]['CallbackService']['application'] = $result['application'];
                 }

                 $this->set(compact('services','tickle'));    
        }



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
	   $mapping = Configure::read('EXTENSIONS'); 

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


               //REMOVE!!!
               unset($this->data['_Token']);
               //Form data exists, store and push to dialer	   
               if (!empty($this->data)){ 

                  $type = $this->data['CallbackService']['type'];
                  $key = $type."_instance_id";
                  $extension   = $mapping[$type].$this->data['CallbackService'][$key];
  

                  $this->data['CallbackService']['extension']   = $mapping[$type].$this->data['CallbackService'][$key];
                  $this->data['CallbackService']['instance_id'] = $this->data['CallbackService'][$key];
                  $this->CallbackService->set($this->data);


                  if($this->CallbackService->saveAll($this->data, array('validate' => 'only'))){
                        $campaign = $this->data['CallbackService'];
                        $startingdate    = strtotime($this->dateToString($campaign['start_time']));
                        $expirationdate   = strtotime($this->dateToString($campaign['end_time']));

                        $socket_data = array(
                             'name'             => $campaign['code'], 
                             'callerid'        => $dialer['caller_id'],
                             'startingdate'     => $startingdate, 
                             'expirationdate'   => $expirationdate, 
                             'frequency'        => $dialer['frequency'],
                             'callmaxduration'  => $campaign['max_duration'],
                             'maxretry'         => $campaign['max_retries'],
                             'intervalretry'    => $campaign['retry_interval'],
                             'calltimeout'      => $dialer['call_timeout'],
                             'aleg_gateway'     => $dialer['a-leg_gateway'],
			     'content_type'	=> $dialer['content_type'],
                             'object_id'        => $dialer['object_id'], 
                             'extra_data'       => "voice_app_data=".$extension,
                             'daily_start_time' => '00:00:00',
                             'daily_stop_time'  => '23:59:59',
                             'status'  		=> '1',
                             );

                        $HttpSocket = new HttpSocket();
                        $request    = array( 'auth'   => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']), 
                                           'header' => array('Content-Type' =>'application/json')
                                         );

                        
                        $results = $HttpSocket->post($dialer['host'].$dialer['path'].$dialer['campaign_POST'], json_encode($socket_data), $request); 
                        $results = json_decode($results);
                        $header  = $HttpSocket->response['raw']['status-line'];
                        $header_status = $this->headerGetStatus($header);

		      if(!$header_status){

		      $this->_flash(__('Newfies is not responding. Please review your Newfies settings.',true), 'error');
		      
		      }

                      elseif ( $header_status  == 1) {

                          //Get Newfies campaign id
                          $location = explode($dialer['path'].$dialer['campaign_POST'], $HttpSocket->response['header']['Location']);
                          $nf_campaign_id = trim($location[1],'/');

                          //Get Newfies phone book id
                          $results = $HttpSocket->get($dialer['host'].$dialer['path'].$dialer['campaign_GET'].$nf_campaign_id.'/?format=json', false, $request); 
                          $results = json_decode($results,true);
                          $nf_phone_book_id = $results['phonebook'][0]['id'];                        

                           $this->data['CallbackService']['nf_phone_book_id'] = $nf_phone_book_id;
                           $this->data['CallbackService']['nf_campaign_id'] = $nf_campaign_id;
                           $this->CallbackService->saveAll($this->data['CallbackService'],array('validate' => false));

                           $this->redirect(array('action'=>'index'));

                        } elseif ($header_status == 2)  {                      

      	                   $this->_flash(__('The SMS code is already in use in the dialer. Please try again with another code.', true), 'error');

                        } elseif ($header_status == 5)  {

       	                   $this->_flash($results->chk_campaign[0].'<br/>'.__('Please change your campaign settings, or modify the Dialer Settings of your Newfies installation.',true), 'error');

                        } elseif ($header_status == 6)  {                      
      	                 
                            $this->_flash(__('Authentication failed with selected dialer.', true)." (".$header.")", 'error');
                       }

                  } else {

                    if(array_key_exists('extension', $error = $this->CallbackService->invalidFields())){

      	                 $this->_flash($error['extension'],'error');

                    }

                  }

                }

         }


/*
 *
 * Delete Callback service (AJAX)
 *
 *
 */

    function delete($id = null){

    Configure::write('debug', 0);
      $dialer = Configure::read('DIALER');
      

       if($id && $data= $this->CallbackService->find('first', array('conditions' => array('CallbackService.id'=> $id)))){

              $HttpSocket = new HttpSocket();
              $request    = array('auth' => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']));
              $results    = $HttpSocket->delete($dialer['host'].$dialer['path'].$dialer['campaign_DELETE'].$data['CallbackService']['nf_campaign_id'].'/', false, $request); 
              $header  = $HttpSocket->response['raw']['status-line'];

                    if ($this->headerGetStatus($header) == 4) {  //NO CONTENT (OK)                    
                        $results   = json_decode($results,true);

                        $this->CallbackService->id= $id;

                        if ($this->CallbackService->delete($id,true)){


                           $callback_services = $this->paginate('CallbackService');


                           foreach($callback_services as $key => $callback_service){

                                         $result = $this->getServiceName($callback_service['CallbackService']['extension']);
                                         $callback_services[$key]['CallbackService']['service_name'] = $result['service_name'];
                                         $callback_services[$key]['CallbackService']['application']  = $result['application'];
                           }


                           $this->set('data',$callback_services);
                           $this->_flash(__('The callback service has been deleted.',true), 'success');
                           $this->render('delete_success','ajax');
                        }
                    } else {

       	              $this->_flash(__('Dialer API Error.',true).' '.$header, 'error');
                      $this->redirect(array('action'=>'/'));   	                     

                    } 
       } else {

                      $this->_flash(__('There is no callback service with this id.',true), 'error');
                      $this->redirect(array('action'=>'index'));   	                     

       }

    }


/*
 *
 * Delete Callback Service (AJAX)
 *
 *
 */

/*    function delete($id){

    Configure::write('debug', 0);

       if($id){
                
           if ($this->CallbackService->del($id)){
                   $this->set('data',$this->CallbackService->find('all',array('order'=>'CallbackService.code ASC')));        
                   $this->render('delete_success','ajax');
           }

        }
        
    }*/

/*
 *
 * List status of callback requests. Set individual call status {start,pause,abort}
 *
 *
 */
	function status($status = null) {

        $dialer = Configure::read('DIALER');
      	$this->pageTitle = __('Callback service status',true);


         unset($this->data['_Token']);
        if(!empty($this->data)){

              $HttpSocket = new HttpSocket();
              $request    = array( 'auth'   => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']), 
                                           'header' => array('Content-Type' =>'application/json')
                                         );

          if(array_key_exists('Callback', $this->data)){
             foreach($this->data['Callback'] as $key => $entry){

                    $results = $HttpSocket->put($dialer['host'].$dialer['path'].$dialer['campaign_subscriber_PUT'].$entry['nf_campaign_id'].'/', 
                                                json_encode(array('contact' => $entry['phone_number'], 'status' => $entry['status'])),
                                                $request
                                                );


                    $header = $HttpSocket->response['raw']['status-line'];
                    if ($this->headerGetStatus($header) == 4) {           

                       $this->loadModel('Callback');
                       $this->Callback->id = $entry['id'];
                       $this->Callback->saveField('status',$entry['status']);

                   }

              }
           }

         } 


        $callback_service         = $this->CallbackService->find('list', array('fields' => array('CallbackService.id','CallbackService.code')));
        $this->set(compact('callback_service'));


        }


/*
 *
 * AJAX drop-down menu for Callback service calls
 *
 *
 */

   function disp(){

       $status = $callback_service = $data = $order = $type = false;
       $dir = 'DESC';

         $status = $this->data['Callback']['status'];
         $callback_service_id = $this->data['Callback']['callback_service_id'];
         $order = $this->data['Callback']['order'];
         $dir = $this->data['Callback']['dir'];

         if(!$type = $this->data['Callback']['type']){
                   $type = array('SMS','TICKLE');
         }

         $param = array();
         $conditions = array();
         $order_by = array();
        
         if ($status) {
            $conditions['Callback.status'] = $status;
         } 
         if ($callback_service_id) {
            $conditions['CallbackService.id'] = $callback_service_id;
         } 
         if ($type) {
            $conditions['Callback.type'] = $type;
         } 
         if ($order) {
            $order_by = $order.' '.$dir;
         } 

	 $this->CallbackService->Callback->unbindModel(array('belongsTo' => array('Campaign')));
	 $this->CallbackService->Callback->bindModel(array('belongsTo' => array('User' => array('ClassName' => 'user_id'))));   
         $param = array('conditions' => $conditions, 'order' => $order_by);
         $callback_services = $this->CallbackService->Callback->find('all', $param);

	 $this->set('callback_services', $callback_services);  


   }

/*
 *
 * AJAX link to callback service status
 *
 *
 */

   function view($id){

    	$this->layout = null;
    	$this->autoLayout = false;

        Configure::write('debug', 0);
      	
            if($id){

                $this->set('callbackService' ,$this->CallbackService->findById($id));

            } 


   }

   function edit($id = null){

	    $mapping = Configure::read('EXTENSIONS'); 
   	    $dialer = Configure::read('DIALER');
    	    $this->pageTitle = __('Edit Callback Service',true);

	    if(!$id){

		     $this->redirect(array('action' =>'/'));

            } elseif($this->data){

              $data = $this->data['CallbackService'];

              $nf_campaign_id = $data['nf_campaign_id'];

              $startingdate     = strtotime($this->dateToString($data['start_time']));
              $expirationdate   = strtotime($this->dateToString($data['end_time']));
              $type 		= $this->data['CallbackService']['type'];
       

              $key = $type."_instance_id";
              $extension = $mapping[$type].$this->data['CallbackService'][$key];
              $data['extension'] = $extension;
              $data['instance_id'] = $this->data['CallbackService'][$key];


             if($this->CallbackService->saveAll($data, array('validate' => 'only'))){

              $socket_data = array(
                             'status'           => $data['status'],
                             'startingdate'     => $startingdate, 
                             'expirationdate'   => $expirationdate, 
                             'frequency'        => $data['retry_interval'],
                             'callmaxduration'  => $data['max_duration'],
                             'maxretry'         => $data['max_retries'],
                             'intervalretry'    => $data['retry_interval'],
                             'extra_data'       => "voice_app_data=".$extension,
                             );


              $HttpSocket = new HttpSocket();
              $request    = array( 'auth'   => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']), 
                                           'header' => array('Content-Type' =>'application/json')
                                         );

              $results = $HttpSocket->put($dialer['host'].$dialer['path'].$dialer['campaign_PUT'].$nf_campaign_id.'/', json_encode($socket_data), $request); 


              $header = $HttpSocket->response['raw']['status-line'];


              if ($this->headerGetStatus($header) == 4) {           

	        $this->CallbackService->save($data);

       	         $this->_flash(__('The callback service has successfully been updated.',true), 'success');                           	
         	 $this->redirect(array('action'=>'index'));

              } else {

	      	     $results = json_decode($results);
                     $results = get_object_vars($results);

                   if(array_key_exists('chk_frequency', $results)){ 
                        $this->_flash($results['chk_frequency'][0], 'error');
                   }
  

              }

               

             } else

             //Does not validate
             {

                    if(array_key_exists('extension', $error = $this->CallbackService->invalidFields())){

      	                 $this->_flash($error['extension'],'error');

                    }

             }


            } 

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

               $this->set(compact(array('ivr','selector','lam')));
               $this->data = $this->CallbackService->findById($id);

            

   }
}

?>
