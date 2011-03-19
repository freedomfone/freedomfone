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
	var $helpers = array('Flash','Session');      


	var $paginate = array(
		    	      'limit' => 50,
			      'order' => array('Callback.created' => 'desc'));


        function add(){

        $protocol       = 'SIP';
        $callback_type  = 'OUT';
        $status         = 'pending';

	   if (empty($this->data)){ 
               
               $this->loadModel('PhoneBook');
               $phonebooks = $this->PhoneBook->find('list');

               $this->loadModel('IvrMenu');
               $ivr = $this->IvrMenu->find('list',array('conditions' => array('ivr_type' => 'ivr'), 'fields' => array('instance_id','title'),'recursive' => 0));
               $selector = $this->IvrMenu->find('list',array('conditions' => array('ivr_type' => 'switcher'), 'fields' => array('instance_id','title'),'recursive' => 0));
               
               $this->loadModel('LmMenu');
               $lam = $this->LmMenu->find('list',array('fields' => array('instance_id','title'),'recursive' => 0));

               $this->loadModel('CallbackSetting');
               $settings = $this->CallbackSetting->find('first');

               $this->data['Callback']['max_duration']   = $settings['CallbackSetting']['max_duration'];
               $this->data['Callback']['retry_interval'] = $settings['CallbackSetting']['retry_interval'];
               $this->data['Callback']['max_retries']        = $settings['CallbackSetting']['max_retries'];
               $this->data['Callback']['phone_book_id']  = false;
	
               $this->set(compact(array('phonebooks','ivr','selector','lam')));

            } else {

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
              
                $phone_numbers[$entry['PhoneNumber']['user_id']] = $entry['PhoneNumber']['number'];

              }
              
              $type = $callback['type'];
              $instance_id = $callback[$type.'_instance_id'];
              if($type == 'selector') { $type = 'ivr';}

              $extensions = Configure::read('EXTENSIONS');
              $extension = $extensions[$type].$instance_id;


              $socket_data = array('protocol' => 'SIP','extension' => $extension, 'retry' => $callback['max_retries'], 'retry_interval' => $callback['retry_interval'], 'max_duration' => $callback['max_duration']);
           
               unset($data);

               $batch_id = rand();

               foreach ($phone_numbers as $key => $phone_number){

                       $data[$key]['phone_number'] = $phone_number;
                       $data[$key]['user_id'] = $key;
                       $data[$key]['protocol'] = $protocol;
                       $data[$key]['status'] = $status;
                       $data[$key]['type'] = $callback_type;
                       $data[$key]['extension'] = $extension;
                       $data[$key]['max_retries'] = $callback['max_retries'] ;
                       $data[$key]['retry_interval'] = $callback['retry_interval']  ;
                       $data[$key]['max_duration'] = $callback['max_duration'] ;
                       $data[$key]['start_time'] = $callback['start_time'] ;
                       $data[$key]['end_time'] = $callback['end_time'] ;
                       $data[$key]['batch_id'] = $batch_id;

               }

               $this->Callback->saveAll($data);

               //Fetch batch data and create JSON object
               $job = $this->Callback->find('first', array('fields' => array('start_time','end_time'), 'conditions' => array('batch_id' => $batch_id)));

               $socket_data['startTime'] = strtotime($job['Callback']['start_time']);
               $socket_data['endTime'] = strtotime($job['Callback']['end_time']);
               $socket_data['recipient'] = $phone_numbers;
               //debug($socket_data);
               $json = json_encode($socket_data);
               //debug($json);

               //$HttpSocket = new HttpSocket();
               //$results = $HttpSocket->post('localhost/api/callrequest/', $json, array('method' => 'POST')); 

               //debug($HttpSocket->results);


              /* var $request = array(
                   'method' => 'POST',
                   'uri' => array('scheme' => 'http','host' => localhost,'port' => 80, 'user' => null,'pass' => null,'path' => null, 'query' => null, 'fragment' => nul),
                   'auth' => array('method' => 'Basic','user' => null, 'pass' => null),
                   'version' => '1.1',
                   'body' => '',
                   'line' => null,
                   'header' => array('Connection' => 'close','User-Agent' => 'CakePHP'),
                   'raw' => null,
                   'cookies' => array()
                   );*/


     	     $this->redirect(array('action'=>'index'));

            }     

        }	

/*
 Parameters :
        Mandatory
            protocol : SIP/SKYPE/GSM (this could be a list separate by semicolons)
            recipient : set the phonenumber, contact info of the recipient (this could be a list separate by semicolons)
            extension : set the extension where to brigde the call on the user freeswitch server
            startTime : Work in Epoch | UTC
        
        Optional
            retryMax: 3 - 20 (default 5)
            retryInterval: 60 - 3600 (default 60)
            durationMax : 1
            endTime : Set the time when the dialer should not process this request anymore
            timeout : 

*/


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


	function dialout($id){

		 $this->Callback->id = $id;
		 $this->data = $this->Callback->read();
		 $this->Callback->dial($this->data['Callback']);		 


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

       $status = $batch_id = $data = false;

       if(array_key_exists('status',$this->data['Callback'])){
         $status = $this->data['Callback']['status'];
        }
       if(array_key_exists('status',$this->data['Callback'])){
         $batch_id = $this->data['Callback']['batch_id'];
       }
	 $this->Callback->recursive = 0;

         if ($status && $batch_id) { 
   	    $data = $this->paginate('Callback', array('Callback.status' => $status,'Callback.batch_id' => $batch_id));
         }  elseif ($status && !$batch_id) { 
   	    $data = $this->paginate('Callback', array('Callback.status' => $status));
         } elseif (!$status && $batch_id) { 
   	    $data = $this->paginate('Callback', array('Callback.batch_id' => $batch_id));
         } else {
   	    $data = $this->paginate('Callback');
         }

	 $this->set('callbacks', $data);  
        

   }

   function batch($batch_id){

    	$this->layout = null;
    	$this->autoLayout = false;

        Configure::write('debug', 0);
      	
            if($batch_id){

                $result = $this->Callback->find('first',array('conditions' => array('Callback.batch_id' => $batch_id)));

                $this->set('batch',$result);

            } 


   }


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

}
?>
