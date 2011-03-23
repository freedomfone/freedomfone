<?php
/****************************************************************************
 * callback_controller.php	- Controller for incoming and outgoing callback requests.
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

class CallbacksController extends AppController{

	var $name = 'Callbacks';
	var $helpers = array('Flash','Session','Time');      


	var $paginate = array(
		    	      'limit' => 50,
			      'order' => array('Callback.created' => 'desc'));



        function add(){


        $protocol       = 'SIP';
        $callback_type  = 'OUT';
        $status         = 'pending';

               
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





              //Fetch phone numbers

              $callback = $this->data['Callback'];


              $this->loadModel('User');
  
              $data = $this->User->PhoneBook->findById($callback['phone_book_id']);
              foreach($data['User'] as $entry){
              
                $user_id[] = $entry['id'];

              }
              
              $result = $this->User->PhoneNumber->find('all', array('conditions' => array('user_id' => $user_id)));;

              //FIXME: makes sure only one phone number per user (takes the last one)
              foreach($result as $key => $entry){
              
                $phone_numbers[] = $entry['PhoneNumber']['number'];
                $user_id[] = $entry['PhoneNumber']['user_id'];

              }
              
              $type = $callback['type'];
              $instance_id = $callback[$type.'_instance_id'];
              if($type == 'selector') { $type = 'ivr';}

              $extensions = Configure::read('EXTENSIONS');
              if ($instance_id){ $extension = $extensions[$type].$instance_id;} else { $extension = false;}

               unset($this->data['Callback']);
               $batch_id = rand();

               foreach ($phone_numbers as $key => $phone_number){

                       $this->data[$key]['Callback']['phone_number'] = $phone_number;
                       $this->data[$key]['Callback']['user_id'] = $user_id[$key];
                       $this->data[$key]['Callback']['protocol'] = $protocol;
                       $this->data[$key]['Callback']['status'] = $status;
                       $this->data[$key]['Callback']['type'] = $callback_type;
                       $this->data[$key]['Callback']['extension'] = $extension;
                       $this->data[$key]['Callback']['max_retries'] = $callback['max_retries'] ;
                       $this->data[$key]['Callback']['retry_interval'] = $callback['retry_interval']  ;
                       $this->data[$key]['Callback']['max_duration'] = $callback['max_duration'] ;
                       $this->data[$key]['Callback']['start_time'] = $callback['start_time'] ;
                       $this->data[$key]['Callback']['end_time'] = $callback['end_time'] ;
                       $this->data[$key]['Callback']['batch_id'] = $batch_id;

               }

              $socket_data = array('protocol' => 'SIP','extension' => $extension, 'retry' => $callback['max_retries'], 'retry_interval' => $callback['retry_interval'], 'max_duration' => $callback['max_duration']);
              $socket_data['recipient'] = implode(',',$phone_numbers);

              $socket_data['startTime'] = strtotime($this->dateToString($callback['start_time']));
              $socket_data['endTime']   = strtotime($this->dateToString($callback['end_time']));

              $this->Callback->set( $this->data );

              if($this->Callback->saveAll($this->data, array('validate' => 'only'))){


                        $HttpSocket = new HttpSocket();
                        $results = $HttpSocket->post('http://192.168.1.141/dialer/dummy_dialer/', $socket_data); 
                        $job_id = json_decode($results);
                        
                        foreach ($job_id as $key => $entry) {
                                $this->data[$key]['Callback']['job_id'] = $entry;         
                        }               

                      $this->Callback->saveAll($this->data,array('validate' => false));
       	              $this->_flash(__('Your callback request has successfully been issued',true). '['.__('batch',true).': '.$batch_id.']', 'success');                           	 
   	              $this->redirect(array('action'=>'index'));
             } else {
       	       $this->_flash(__('Please select a service.',true), 'error');                           	
             }


            }        

             $this->render();

        }	



	function index($status = null) {

      	$this->pageTitle = 'Callback';           

        $result = $this->Callback->find('all', array('fields' => array('DISTINCT Callback.batch_id','Callback.id')));

        if($result){
            foreach ($result as $batch){
                $batch_id[$batch['Callback']['batch_id']] = $batch['Callback']['batch_id'];

	     }
        } else {

          $batch_id = false;
        }

	 $this->set('batch_id', $batch_id);  

        }

	function refresh(){


	     $this->autoRender = false;
      	      $array = Configure::read('callback');
      
	       $obj = new ff_event($array);	       

	       if ($obj -> auth != true) {
    	       die(printf("Unable to authenticate\r\n"));
	       }



 	       while ($entry = $obj->getNext('update')){

	       $created = floor($entry['Event-Date-Timestamp']/1000000);
	       

	       if(!$iid = $entry['FF-InstanceID']){ 
	       		$iid = IID;
			}

	       if (!$mode = $entry['Event-Subclass']){
	       	  $mode = 'sms';
		  }

	      if(!$proto = $entry['proto']){
	      		 if(strpos($entry['FF-CallerName'],'GSMopen')===false){
				$proto ='SIP';}

				else {
				$proto ='GSM';
				}

		}

		if (!$sender = $entry['FF-CallerID']){
		   $sender = $entry['from'];

		}

		if(!$receiver = $entry['FF-To']){
			      $receiver = $entry['login'];
			      }

	  $status = $this->Callback->withinLimit($sender);


	       $data= array ('instance_id'      => $iid,
	       	      	      'mode'		=> $mode,
		      	      'created'         => $created, 
      	      	              'sender'          => $sender,
	       	      	      'receiver'        => $entry['FF-To'],
			      'proto'		=> $proto,	       	      	    
	       		      'status'          => $status);

			      print_r($data);

	       $this->Callback->create();
	       $this->Callback->save($data);

	       $id = $this->Callback->getLastInsertId();

 	       $this->Callback->id=$id;
	        $this->data = $this->Callback->read();


	       if($status){

	       $this->log('CALLBACK OK '.$id, 'callback');		       
	       $this->Callback->dial($this->data['Callback']);		 


	       }

	       else {
	       $this->log('CALLBACK DENY '.$id, 'callback');		       

	       }

            }


	}


	function check($id){

 	$this->Callback->id=$id;
        $this->set('data',$this->Callback->read()); 

	$this->Callback->withinLimit('1001');
	}
	



/*
 *
 * AJAX drop-down menu for Callback jobs
 *
 *
 */

   function disp(){

       $status = $batch_id = $data = $order = $dir = false;

       if(array_key_exists('status',$this->data['Callback'])){
         $status = $this->data['Callback']['status'];
        }
       if(array_key_exists('status',$this->data['Callback'])){
         $batch_id = $this->data['Callback']['batch_id'];
       }
       if(array_key_exists('order',$this->data['Callback'])){
         $order = $this->data['Callback']['order'];
       }
       if(array_key_exists('dir',$this->data['Callback'])){
         $dir = $this->data['Callback']['dir'];
       } else {
         $dir = 'DESC';
       }

         $param = array();
         $conditions = array();
         $order_by = array();
        

         if ($status) {
            $conditions['Callback.status'] = $status;
         } 
         if ($batch_id) {
            $conditions['Callback.batch_id'] = $batch_id;
         } 
         if ($order) {
            $order_by[] = 'Callback.'.$order.' '.$dir;
         } 

         $param = array('conditions' => $conditions, 'order' => $order_by);
	$this->Callback->bindModel(array('belongsTo' => array('User' => array('ClassName' => 'user_id'))));   



         $data = $this->Callback->find('all', $param);
	 $this->set('callbacks', $data);  


   }

/*
 *
 * AJAX link to batch details
 *
 *
 */

   function batch($batch_id){

    	$this->layout = null;
    	$this->autoLayout = false;

        Configure::write('debug', 0);
      	
            if($batch_id){

                $result = $this->Callback->find('first',array('conditions' => array('Callback.batch_id' => $batch_id)));

                $this->set('batch',$result);

            } 


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
 * Refresh of callback request from Dialer
 *
 *
 */

   function dialer_refresh(){

   	     $dialer = Configure::read('DIALER');
 
             $result = $this->Callback->find('all', array('fields' => 'Callback.job_id'));
             foreach($result as $key => $entry){
                     $job_id[] = $entry['Callback']['job_id'];
             }

             $HttpSocket = new HttpSocket();
             $results = $HttpSocket->get($dialer['host'].'dummy_status/', $job_id); 
 
            debug($HttpSocket->response['raw']['response']);

            debug($results);
            json_decode($results);
 

   }

}
?>
