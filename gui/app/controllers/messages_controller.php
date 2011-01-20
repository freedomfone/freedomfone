<?php
/****************************************************************************
 * messages_controller.php	- Controller for Leave-a-message messages. Manages CRUD operations on messages.
 * version 		 	- 1.0.408
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

class MessagesController extends AppController{

      var $name = 'Messages';

      var $helpers = array('Flash','Formatting','Session');      

      var  $paginate = array('page' => 1, 'order' => array( 'Message.created' => 'desc')); 




      function index(){


      $this->requestAction('/messages/refresh');
      $this->requestAction('/cdr/refresh');

      $this->pageTitle = __('Leave-a-Message',true)." : ".__('Inbox',true);
      $this->Session->write('Message.source', 'index');
   
        if(isset($this->params['form']['submit'])) {
	   if ($this->params['form']['submit']==__('Refresh',true)){
                   $this->requestAction('/messages/refresh');
                   }
       }


      //Source: http://www.muszek.com/cakephp-how-to-remember-pagination-sort-order-session

      if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('messages_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
		}
	elseif($this->Session->check('messages_sort')) { 
		if(in_array($this->Session->read('messags_sort'),array('new','title','rate','category','created','modified','length'))){
		   $this->paginate['order'] = $this->Session->read('messages_sort');
		} 
	} 

      if(isset($this->params['named']['limit'])) { 

	$this->Session->write('messages_limit',$this->params['named']['limit']);
	}
	elseif($this->Session->check('messages_limit')) { 
	$this->paginate['limit'] = $this->Session->read('messages_limit');
	}	

	     $this->Message->recursive = 0; 
   	     $data = $this->paginate('Message', array('Message.status' => '1'));

	     $this->set('messages',$data);  

	     if(!isset($checked)){
	     $this->set('checked','');
	     }


	     }


      function archive(){


      $this->pageTitle = 'Leave-a-Message : Archive';
      $this->Session->write('Message.source', 'archive');
     
      if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('messages_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
		}
	elseif($this->Session->check('messages_sort')) { 
		if(in_array($this->Session->read('messags_sort'),array('new','title','rate','category','created','modified','length'))){
		   $this->paginate['order'] = $this->Session->read('messages_sort');
		} 
	} 

      if(isset($this->params['named']['limit'])) { 
	$this->Session->write('messages_limit',$this->params['named']['limit']);
	}
	elseif($this->Session->check('messages_limit')) { 
	$this->paginate['limit'] = $this->Session->read('messages_limit');
	}	


	     $this->Message->recursive = 0; 
   	     $data = $this->paginate('Message', array('Message.status' => '0'));
	     $this->set('messages',$data);       

	     }


     function view($id){


      $this->Message->id = $id;
      $this->set('data',$this->Message->read());       

      }


    function edit($id = null)    {  



    	     $this->pageTitle = 'Leave-a-Message : Edit';   

	     if(!$id){
		     $this->redirect(array('action' =>'/'));

		     }

    	     elseif(empty($this->data['Message'])){

		$this->referer();

		$this->Message->id = $id;
		$this->data = $this->Message->read();
		$this->set('data',$this->Message->read());       


      		if($this->Session->check('messages_sort')){
			$data = $this->Session->read('messages_sort');
			$keys = array_keys($data);
			$field = $keys[0];
			$dir = $data[$field];
		} else {
			$field = 'id';
			$dir = 'asc';
		}


      		$this->Session->write('Message.messages_sort', $dir);
      	  	$neighbors = $this->Message->find('neighbors', array('field' => $field, 'dir' => 'desc','value' => $this->data['Message'][$field], 'conditions' => array('status' => $this->data['Message']['status'] )));	

		$tags 	    = $this->Message->Tag->find('list');
 		$categories = $this->Message->Category->find('list');
 		$this->set(compact('tags','categories','neighbors'));

		     

		}

	else {

	if($this->Message->saveAll($this->data)){

		$this->Message->save($this->data['Tag']);
		$this->_flash(__('The entry has been updated',true),'success');
    	     
		$submit   = $this->params['data']['Submit'];

		if ($submit == __('Save',true) ){		   
                    $redirect = 'edit/'.$id;
                   }
		}

		$this->redirect(array('action' => $redirect));
	}
    }


    function delete ($id){

    	     $source = $this->Session->read('Message.source');


     	     $title = $this->Message->getTitle($id);

    	     if($this->Message->del($id))
	     {
	     $this->Session->setFlash('Message with title "'.$title.'" has been deleted.');
	     $this->log('Msg: MESSAGE  DELETED; Id:title: '.$id.":".$title, 'leave_message');
	    
	     }


 	     if (!$redirect = $source){
                        $redirect = 'index';
              }
             $this->redirect(array('action' => $redirect));


    }


    function process (){

	if (!$redirect = $this->data['Message']['source']){
	   	$redirect = 'index';
	}  


    	//Data to process
    	if(!empty($this->data['Message'])){

	    //One or more messages selected
	    if(array_key_exists('message',$this->params['form'])){

		$entries = $this->params['form']['message'];
    	    	$action = $this->params['data']['Submit'];

		//Loop through messages
    	     	foreach ($entries as $key => $id){
	     	     if ($id) {
			   $this->Message->id = $id;
			   if ($action == __('Delete',true)){
		     	       if ($this->Message->del($id)){
				     $title = $this->Message->getTitle($id);
				     $this->log('Msg: MESSAGE  DELETED; Id:title: '.$id.":".$title, 'leave_message');
			        }
			    } elseif ($action == __('Move to Archive',true)){
				$this->Message->saveField('status',0);
 	      			$this->log('ARCHIVE Message '.$id, 'leave_message');		       
			    }  elseif ($action == __('Activate',true)){
				$this->Message->saveField('status',1);
 	      			$this->log('Msg: MESSAGE ACTIVATED '.$id, 'leave_message');		       
			    }
		        }
	             } //foreach

		     $this->redirect(array('action' => $redirect));
		 } //array_key_exists 
		 else {
		     
		     $this->redirect(array('action' => $redirect));
		 }

    	     } // data to process

	     else {
		 $this->redirect(array('action' => $redirect));
             }
    }


      function refresh($method = null){


      $this->autoRender = false;
      $this->logRefresh('message',$method); 
      $this->Message->refresh();

      }

  function download ($id) {


    	Configure::write('debug', 0);

	$this->Message->id = $id;
	$data = $this->Message->read();
	
	$file        = $data['Message']['file'].'.mp3';
	$name        = $data['Message']['title'];
        $instance_id = $data['Message']['instance_id'];

	$url  = 'webroot/freedomfone/leave_message/'.$instance_id.'/messages';

        $this->view = 'Media';

    	$params = array(
		'id' => $file,
 		'name' => $name,
 		'download' => true,
 		'cache' => true,
 		'extension' => 'mp3',
 		'path' => APP . $url . DS
 		);
	$this->set($params);

    	$this->layout = null;
    	$this->autoLayout = false;
  	$this->render();    


    }


}
?>
