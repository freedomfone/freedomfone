<?php
/****************************************************************************
 * campaign_controller.php	- Controller for managing callback Campaigns
 * version 		 	- 2.5.1700
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

               
             if(!$phonebooks){ 
	     		      $this->_flash(__('There is no valid phone book in the system. Please create a phone book (with one or more users) before you create the campaign.',true), 'warning');
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
                             'callerid'         => $dialer['caller_id'],
                             'startingdate'     => $startingdate, 
                             'expirationdate'   => $expirationdate, 
                             'frequency'        => $dialer['frequency'],
                             'callmaxduration'  => $campaign['max_duration'],
                             'maxretry'         => $campaign['max_retries'],
                             'intervalretry'    => $campaign['retry_interval'],
                             'calltimeout'      => $dialer['call_timeout'],
                             'aleg_gateway'     => $dialer['a-leg_gateway'],
                             'object_id'        => $dialer['object_id'], 
                             'extra_data'       => $extension,
                             'daily_start_time' => '00:00:00',
                             'daily_stop_time'  => '23:59:59',
			     'content_type'	=> $dialer['content_type'],
                             'monday'           => 1,
                             'tuesday'          => 1,
                             'wednesday'        => 1,
                             'thursday'         => 1,
                             'friday'           => 1,
                             'saturday'         => 1,
                             'sunday'           => 1,
                             'status'           => 1,
                             );
              
                  $this->Campaign->set( $this->data );


                  if($this->Campaign->saveAll($this->data, array('validate' => 'only'))){

                      $HttpSocket = new HttpSocket();
                      $request    = array( 'auth'   => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']), 
                                           'header' => array('Content-Type' =>'application/json')
                                         );
                      $results = $HttpSocket->post($dialer['host'].$dialer['path'].$dialer['campaign_POST'], json_encode($socket_data), $request); 
                      $results  = json_decode($results);

                      $header  = $HttpSocket->response['raw']['status-line'];
                      $status = $this->headerGetStatus($header);

                        if ( $status == 1) {  //201 Created (POST Campaign)

                          //Get Newfies campaign id
                          $location = explode($dialer['path'].$dialer['campaign_POST'], $HttpSocket->response['header']['Location']);
                          $nf_campaign_id = trim($location[1],'/');

                          //Get Newfies phone book id
                          $results = $HttpSocket->get($dialer['host'].$dialer['path'].$dialer['campaign_GET'].$nf_campaign_id.'/?format=json', false, $request); 
                          $results = json_decode($results,true);


                           $nf_phone_book_id = $results['phonebook'][0]['id'];                        
                           $this->data['Campaign']['status'] = 1;
                           $this->data['Campaign']['nf_phone_book_id'] = $nf_phone_book_id;
                           $this->data['Campaign']['nf_campaign_id'] = $nf_campaign_id;

                           $this->Campaign->saveAll($this->data['Campaign'],array('validate' => false));
                           $campaign_id = $this->Campaign->getLastInsertId();

                           foreach ($phone_numbers as $key => $contact) {

                                   $campaign_subscriber = array('phonebook_id' => $nf_phone_book_id, 'contact' => $contact);
                                   $results = $HttpSocket->post($dialer['host'].$dialer['path'].$dialer['campaign_subscriber_POST'], json_encode($campaign_subscriber), $request);

                                   $results = json_decode($results,true);

                                   $header  = $HttpSocket->response['raw']['status-line'];
                                   $status = $this->headerGetStatus($header);

                                   if ( $status == 1) {

                                      $location = explode($dialer['path'].$dialer['campaign_subscriber_POST'], $HttpSocket->response['header']['Location']);
                                      $nf_campaign_subscriber_id = trim($location[1],'/');

                                      $this->data[$key]['Callrequest']['nf_campaign_subscriber_id'] = $nf_campaign_subscriber_id;
                                      $this->data[$key]['Callrequest']['campaign_id'] = $campaign_id;
                                      $this->data[$key]['Callrequest']['status'] = 1;
                                      $this->data[$key]['Callrequest']['state'] = 1;
                                      $this->data[$key]['Callrequest']['epoch'] = time();

	                             $this->Campaign->Callback->create($this->data[$key]['Callrequest']);
	                             $this->Campaign->Callback->saveAll($this->data[$key]['Callrequest'],array('validate' => false));

                                   } else {

                                      if(array_key_exists('chk_contact_no', $results)){ 
                                        $this->_flash($results['chk_contact_no'][0].'<br/>'.__('The following user has not been added to the campaign:',true)." ".$contact, 'error');
                                      }
                                    
                                   }


                           }             

                           $this->_flash(__('The campaign has successfully been created.',true), 'success');                           	 
   	                   $this->redirect(array('action'=>'index'));


                         } elseif( $status == 5){

                             $results = get_object_vars($results);
                              if(array_key_exists('chk_campaign', $results)){ $this->_flash($results['chk_campaign'][0].'<br/>'.__('Please delete a campaign before creating a new.',true), 'error');}
                              elseif(array_key_exists('chk_campaign_name',$results)){ $this->_flash($results['chk_campaign_name'][0].'<br/>'.__('Please select a campaign name that is not in use.',true), 'error');}
			      elseif(array_key_exists('chk_duration',$results)){ $this->_flash($results['chk_duration'][0], 'error');}


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


      $dialer = Configure::read('DIALER');

       if($id && $data = $this->Campaign->find('first', array('conditions' => array('id'=> $id)))){

              $HttpSocket = new HttpSocket();
              $request    = array( 'auth'   => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']), 
                                           'header' => array('Content-Type' =>'application/json')
                                         );

              $results    = $HttpSocket->delete($dialer['host'].$dialer['path'].$dialer['campaign_DELETE'].$data['Campaign']['nf_campaign_id'].'/', false, $request); 


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

              $socket_data = array('status' => $status,'content_type' => $dialer['content_type']);
              $HttpSocket = new HttpSocket();

              $request    = array( 'auth'   => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']), 
                                           'header' => array('Content-Type' =>'application/json')
                                         );


              $results = $HttpSocket->put($dialer['host'].$dialer['path'].$dialer['campaign_PUT'].$nf_campaign_id.'/', json_encode($socket_data), $request); 
              $header = $HttpSocket->response['raw']['status-line'];


              if ($this->headerGetStatus($header) == 4) {           

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
              $request    = array( 'auth'   => array('method' => 'Basic','user' => $dialer['user'],'pass' => $dialer['pwd']), 
                                           'header' => array('Content-Type' =>'application/json')
                                         );

             foreach($this->data['Callback'] as $key => $entry){

	     //Update entry if Status is changed
	     if(array_key_exists('status', $entry)){

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
            $this->_flash(__('Call status successfully updated.',true), 'info');

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
 * Refresh of Campaign status from Newfies
 *
 *
 */

   function newfies_refresh($mode = null){


          $this->autoRender = false;
   	  $dialer = Configure::read('DIALER');
          $result = $this->Campaign->find('all', array('recursive' => false, 'fields' => array('Campaign.id', 'Campaign.nf_campaign_id'), 'conditions' => array('Campaign.end_time >=' => date('Y-m-d G:i:s'))));

          foreach($result as $key => $campaign){

             $HttpSocket = new HttpSocket();
             $request = array('auth' => array('method' => 'Basic', 'user' => $dialer['user'],'pass' => $dialer['pwd']));
             $results = $HttpSocket->get($dialer['host'].$dialer['path'].$dialer['campaign_GET'].$campaign['Campaign']['nf_campaign_id'].'/', false,  $request); 
             $header = $HttpSocket->response['raw']['status-line'];


             if ($this->headerGetStatus($header) == 7) {     
	     	$results = json_decode($results,true);
                $this->Campaign->id = $campaign['Campaign']['id'];
                $this->Campaign->saveField('status',$results['status']);


	     } else {

               $this->log("FAILURE: newfies_refresh; Campaign id: ".$campaign['Campaign']['id']."; Mode: ".$mode, "campaign"); 

	     }

	   }

  }


}


?>
