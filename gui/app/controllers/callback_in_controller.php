<?php
/****************************************************************************
 * callback_in_controller.php	- Controller for incoming callback requests..
 * version 		 	- 1.0.368
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

class CallbackInController extends AppController{

	var $name = 'CallbackIn';
	var $helpers = array('Flash','Session');      


	var $paginate = array(
		    	      'limit' => 25,
			      'order' => array('CallbackIn.created' => 'desc'));

	

	function index() {

      	$this->pageTitle = 'Callback';           

	$iid = IID;
     	$callback_settings = Configure::read('CALLBACK_SETTINGS');


		// Invalid entry, or no data exist
		if (!$iid && empty($this->data)) {
			$this->Session->setFlash(__('Invalid page', true));
			$this->redirect(array('action'=>'index'));
		}


		if (empty($this->data)) {

	     	   $this->CallbackIn->recursive = 0; 
   	     	   $data = $this->paginate('CallbackIn',array('CallbackIn.instance_id' => $iid));
	     	   $this->set('callbacks',$data);  



		}


	}


	function refresh(){


	     $this->autoRender = false;

      	      $array = Configure::read('callback_in');
	      
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

	  $status = $this->CallbackIn->withinLimit($sender);


	       $data= array ('instance_id'      => $iid,
	       	      	      'mode'		=> $mode,
		      	      'created'         => $created, 
      	      	              'sender'          => $sender,
	       	      	      'receiver'        => $entry['FF-To'],
			      'proto'		=> $proto,	       	      	    
	       		      'status'          => $status);

			      print_r($data);

	       $this->CallbackIn->create();
	       $this->CallbackIn->save($data);

	       $id = $this->CallbackIn->getLastInsertId();

 	       $this->CallbackIn->id=$id;
	        $this->data = $this->CallbackIn->read();


	       if($status){

	       $this->log('CALLBACK OK '.$id, 'callback');		       
	       $this->CallbackIn->dial($this->data['CallbackIn']);		 


	       }

	       else {
	       $this->log('CALLBACK DENY '.$id, 'callback');		       

	       }

            }


	}


	function dialout($id){

		 $this->CallbackIn->id = $id;
		 $this->data = $this->CallbackIn->read();
		 $this->CallbackIn->dial($this->data['CallbackIn']);		 


	}


	function check($id){

 	$this->CallbackIn->id=$id;
        $this->set('data',$this->CallbackIn->read()); 

	$this->CallbackIn->withinLimit('1001');
	}
	

}
?>