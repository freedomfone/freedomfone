<?php
/****************************************************************************
 * campaign_controller.php	- Controller for managing callback Campaigns
 * version 		 	- 2.5.1200
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

class CampaignsController extends AppController{

	var $name = 'Campaigns';
	var $helpers = array('Flash','Session','Time','Number','Formatting','Html');      


	var $paginate = array(
		    	      'limit' => 50,
			      'order' => array('Campaign.name' => 'ASC'));


/*
 *
 * List all Campaigns
 *
 *
 */
        function index(){

                 $this->pageTitle = __('Campaigns',true);
                 $campaigns = $this->paginate('Campaign');

                 foreach($campaigns as $key => $campaign){
                       $result = $this->getServiceName($campaign['Campaign']['extension']);
                       $campaigns[$key]['Campaign']['service_name'] = $result['service_name'];
                       $campaigns[$key]['Campaign']['application'] = $result['application'];
                 }
 
                 $this->set(compact('campaigns'));    

        }


/*
 *
 * Create new callback campaign
 *
 *
 */
        function add(){

           $this->pageTitle = __('Create campaign',true);
           $callback_type  = 'OUT';
           $status         = 'pending';
   	   $dialer = Configure::read('DIALER');

               $phonebooks = $this->getPhoneBooks();
               if(!$phonebooks){ $this->_flash(__('There is no valid phone book in the system. Please create a phone book (with one or more users) before you create the campaign.',true), 'warning');}

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

                  //Fetch phone numbers
                  $campaign = $this->data['Campaign'];

                  $extension = $this->Campaign->getExtension($campaign);
                  $this->data['Campaign']['extension'] = $extension;

                  $this->loadModel('User');
                  $data = $this->User->PhoneBook->findById($campaign['phone_book_id']);
              
                  foreach($data['User'] as $entry){
                         $user_id[] = $entry['id'];
                  }
              
                  $result = $this->User->PhoneNumber->find('all', array('conditions' => array('user_id' => $user_id)));;

                  //FIXME: makes sure only one phone number per user (takes the last one)
                  foreach($result as $key => $entry){
                        $phone_numbers[] = $entry['PhoneNumber']['number'];
                        $user_id[] = $entry['PhoneNumber']['user_id'];
                  }
              

 

                  foreach ($phone_numbers as $key => $phone_number){

                       $this->data[$key]['Callrequest']['phone_number'] = $phone_number;
                       $this->data[$key]['Callrequest']['user_id'] = $user_id[$key];
                       $this->data[$key]['Callrequest']['status'] = $status;
                       $this->data[$key]['Callrequest']['type'] = $callback_type;


                  }

                  $startingdate    = strtotime($this->dateToString($campaign['start_time']));
                  $expirationdate   = strtotime($this->dateToString($campaign['end_time']));

                  $socket_data = array(
                             'name'             => $campaign['name'], 
                             'callerid'        => $dialer['caller_id'],
                             'startingdate'     => $startingdate, 
                             'expirationdate'   => $expirationdate, 
                             'frequency'        => $dialer['frequency'],
                             'callmaxduration'  => $campaign['max_duration'],
                             'maxretry'         => $campaign['max_retries'],
                             'intervalretry'    => $campaign['retry_interval'],
                             'calltimeout'      => $dialer['call_timeout'],
                             'aleg_gateway'     => $dialer['a-leg_gateway'],
                             'voipapp'          => $dialer['voip_app'], 
                             'extra_data'       => $extension,
                             'daily_start_time' => '00:00:00',
                             'daily_stop_time'  => '23:59:59',
                             'monday'           => 1,
                             'tuesday'          => 1,
                             'wednesday'        => 1,
                             'thursday'         => 1,
                             'friday'           => 1,
                             'saturday'         => 1,
                             'sunday'           => 1,
                             );
              
                  $this->Campaign->set( $this->data );
                  if($this->Campaign->saveAll($this->data, array('validate' => 'only'))){

                        $HttpSocket = new HttpSocket();
                    

                        $request    = array('auth' => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']));
                        $results = $HttpSocket->post($dialer['host'].$dialer['campaign'], $socket_data, $request); 
                        $header  = $HttpSocket->response['raw']['status-line'];
                        $status = $this->headerGetStatus($header);

                        if ( $status == 1) {

                           $results   = json_decode($results,true);
                           $nf_phone_book_id  = $results['phonebook'][0]['id']; 
                           $this->data['Campaign']['status'] = 1;
                           $this->data['Campaign']['nf_phone_book_id'] = $nf_phone_book_id;
                           $this->data['Campaign']['nf_campaign_id'] = $results['id'];

                           $this->Campaign->saveAll($this->data['Campaign'],array('validate' => false));
                           $campaign_id = $this->Campaign->getLastInsertId();

                           foreach ($phone_numbers as $key => $contact) {

                                   $contact = array('phonebook_id' => $nf_phone_book_id, 'contact' =>  $contact);
                                   $results = $HttpSocket->post($dialer['host'].$dialer['contact'], $contact, $request); 
                                   $results = json_decode($results,true);
                                   $header  = $HttpSocket->response['raw']['status-line'];

                                   $this->data[$key]['Callrequest']['nf_campaign_subscriber_id'] = $results['id'];
                                   $this->data[$key]['Callrequest']['campaign_id'] = $campaign_id;
                                   $this->data[$key]['Callrequest']['status'] = 1;
                                   $this->data[$key]['Callrequest']['state'] = 1;
                                   $this->data[$key]['Callrequest']['epoch'] = time();

                                   
                                   if ( $this->headerGetStatus($header) == 1) {

	                             $this->Campaign->Callback->create($this->data[$key]['Callrequest']);
	                             $this->Campaign->Callback->saveAll($this->data[$key]['Callrequest'],array('validate' => false));

                                   } else {

       	                              $this->_flash(__('Dialer API Error (contact POST).',true).' '.$header, 'error');                           	
                                   }

                           }

       	                   $this->_flash(__('The campaign has successfully been created.',true), 'success');                           	 
   	                   $this->redirect(array('action'=>'index'));

                         } elseif ($status == 2 ) {

       	                       $this->_flash(__('The Campaign name is already in use. Please try again.',true), 'error');

                         } elseif( $status == 5){

       	                       $this->_flash($results.'<br/>'.__('Please change your campaign settings, or modify the Dialer Settings of your Newfies installation.',true), 'error');

                         }  else {
       	               

                         $this->_flash(__('Dialer API Error (campaign POST).',true).' '.$header, 'error');                           	

                         }



              } //if validates

              else {
      	                 $this->_flash(__('Please select a Service.', true), 'error');                           	
              }

             } // if $this->data
        
             $this->render();

       }


/*
 *
 * Delete Campaign (AJAX)
 *
 *
 */

    function delete($id = null){

    Configure::write('debug', 0);
      $dialer = Configure::read('DIALER');
      
       if($id && $data= $this->Campaign->find('first', array('conditions' => array('id'=> $id)))){

              $HttpSocket = new HttpSocket();
              $request    = array('auth' => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']));
              $results    = $HttpSocket->delete($dialer['host'].$dialer['campaign'].'/delete_cascade/'.$data['Campaign']['nf_campaign_id'], false, $request); 
              $header  = $HttpSocket->response['raw']['status-line'];


                    if ($this->headerGetStatus($header) == 4) {  //NO CONTENT (OK)                    
                        $results   = json_decode($results,true);

                        $this->Campaign->id= $id;

                        if ($this->Campaign->delete($id,true)){


                           $campaigns = $this->paginate('Campaign');

                           foreach($campaigns as $key => $campaign){

                                         $result = $this->getServiceName($campaign['Campaign']['extension']);
                                         $campaigns[$key]['Campaign']['service_name'] = $result['service_name'];
                                         $campaigns[$key]['Campaign']['application'] = $result['application'];
                           }
                      
                           $this->set('data',$campaigns);
                           $this->_flash(__('The campaign has been deleted.',true), 'success');
                           $this->render('delete_success','ajax');
                        }
                    } else {

       	              $this->_flash(__('Dialer API Error.',true).' '.$header, 'error');
                      $this->redirect(array('action'=>'index'));   	                     

                    } 
       } else {

                      $this->_flash(__('There is no campaign with this id.',true), 'error');
                      $this->redirect(array('action'=>'index'));   	                     

       }

    }


/*
 *
 * Stop/pause/abort campaigns.
 *
 *
 */
   function set_status() {

        $dialer = Configure::read('DIALER');

        if(!empty($this->data)){

              $id = $this->data['Campaign']['id'];
              $status = $this->data['Campaign']['status'];
              $data = $this->Campaign->findById($id);
              $nf_campaign_id = $data['Campaign']['nf_campaign_id'];

              $socket_data = array('status' => $status);
              $HttpSocket = new HttpSocket();
              $request    = array('auth' => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']));
              $results = $HttpSocket->put($dialer['host'].$dialer['campaign'].$nf_campaign_id, $socket_data, $request); 
              $header = $HttpSocket->response['raw']['status-line'];

debug($nf_campaign_id);
debug($socket_data);
debug($results);
debug($header);
              if ($this->headerGetStatus($header) == 1) {           

       	         $this->_flash(__('The campaign status has successfully been changed.',true), 'success');                           	
                 $this->Campaign->updateAll(array('Campaign.status'=> $status),array('Campaign.id' => $id));

              } else {

       	                $this->_flash(__('Dialer API Error.',true).' '.$header, 'error');
              }
              
              $this->redirect(array('action'=>'/'));   	 

       }

    }



/*
 *
 * AJAX drop-down menu for edit campaign status
 *
 *
 */
   function overview($id = null){


        Configure::write('debug',0);
        $data = $this->Campaign->findById($id);
	$this->set('campaign', $data);  

   
   }


/*
 *
 * List status of callback requests. Set individual call status {start,pause,abort}
 *
 *
 */
	function status($status = null) {

        $dialer = Configure::read('DIALER');
      	$this->pageTitle = __('Callback status',true);


        if(!empty($this->data)){

              $HttpSocket = new HttpSocket();
              $request    = array('auth' => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']));


             foreach($this->data['Callback'] as $key => $entry){

                    $results = $HttpSocket->put($dialer['host'].$dialer['contact'].$entry['nf_campaign_id'].'/'.$entry['phone_number'], array('status' => $entry['state']), $request);               
                    $header = $HttpSocket->response['raw']['status-line'];

                    if ($this->headerGetStatus($header) == 1) {           

                       $this->loadModel('Callback');
                       $this->Callback->id = $entry['id'];
                       $this->Callback->saveField('state',$entry['state']);

                   }

              }

         } 


        $campaign         = $this->Campaign->find('list', array('fields' => array('Campaign.id','Campaign.name')));

        $this->set(compact('campaign'));


        }


/*
 *
 * AJAX drop-down menu for Campaign jobs (index)
 *
 *
 */

   function status_disp(){

       $status = $campaign = $data = $order = $dir = false;

         $status = $this->data['Callback']['status'];
         $campaign_id = $this->data['Callback']['campaign_id'];       
         $order = $this->data['Callback']['order'];

         if (!$dir = $this->data['Callback']['dir']) { 
                  $dir = 'DESC';
         }

         $param = array();
         $conditions = array();
         $order_by = array();
        
         if ($status) {
            $conditions['Callback.status'] = $status;
         } 
         if ($campaign_id) {
            $conditions['Campaign.id'] = $campaign_id;
         } else {
            $conditions['Campaign.id !='] = 0;

         } 
         if ($order) {
            $order_by = $order.' '.$dir;
         } 

	 $this->Campaign->Callback->bindModel(array('belongsTo' => array('User' => array('ClassName' => 'user_id'))));   
	 $this->Campaign->Callback->unbindModel(array('belongsTo'=> array('CallbackService')));
         $param = array('conditions' => $conditions, 'order' => $order_by);
         $campaigns = $this->Campaign->Callback->find('all', $param);

	 $this->set('campaigns', $campaigns);  


   }

/*
 *
 * AJAX link to user details
 *
 *
 */
   function user($user_id){

    	$this->layout = null;
    	$this->autoLayout = false;

        Configure::write('debug', 0);
      	
            if($user_id){

                $this->loadModel('User');
                $result = $this->User->findById($user_id);

                $this->set('user',$result);

            } 


   }



/*
 *
 * AJAX link to campaign details
 *
 *
 */

   function view($id){

    	$this->layout = null;
    	$this->autoLayout = false;

        Configure::write('debug', 0);
      	
            if($id){

                $result = $this->Campaign->findById($id);

                $this->set('campaign',$result);

            } 


   }


/*
 *
 * Refresh of Campaign request from Dialer
 *
 *
 */

   function dialer_refresh($mode = null){

          $this->autoRender = false;
   	  $dialer = Configure::read('DIALER');
          $result = $this->Campaign->find('all', array('fields' => 'Campaign.id'));

         
             //** CAMPAIGN::GET **//
             $HttpSocket = new HttpSocket();
             $request = array('auth' => array('method' => 'Basic', 'user' => $dialer['user'],'pass' => $dialer['pwd']));
             $results = $HttpSocket->get($dialer['host'].$dialer['campaign'], false,  $request); 
             $header = $HttpSocket->response['raw']['status-line'];


             if ($this->headerGetStatus($header) == 1) {     

                $results = json_decode($results,true);

                foreach ($results as $key => $campaign){
       
                       $id = $campaign['id'];
                       if($data = $this->Campaign->find('first', array('conditions' => array('nf_phone_book_id' => $id)))){
                               $this->Campaign->id = $data['Campaign']['id'];
                               $this->Campaign->saveField('status',$campaign['status']);
                               $this->log("SUCCESS: dialer_refresh; Dialer id: ".$id."; Mode: ".$mode, "campaign");
                       } 
                }
             
             } else {

                      $this->log("FAILURE: dialer_refresh; Campaign id: ".$data['Campaign']['id']."; Mode: ".$mode, "campaign"); 
             }


   }



}

?>
