<?php
/****************************************************************************
 * messages_controller.php	- Controller for Leave-a-message messages. Manages CRUD operations on messages.
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

class MessagesController extends AppController{

      var $name = 'Messages';
      var $helpers = array('Flash','Formatting', 'Ajax', 'Javascript');      
      var $paginate = array('page' => 1, 'limit' => 10, 'order' => array( 'Message.created' => 'desc')); 

      var $components = array('RequestHandler','Session');



      function refresh($method = null){

          $this->autoRender = false;
          $this->logRefresh('message',$method); 
          $this->Message->refresh();

          $this->loadModel('Cdr');
          $this->Cdr->refresh();
          $this->logRefresh('cdr',$method); 
      
      }


      function index(){


         $this->Session->write('messages_tag',false);
         $this->Session->write('messages_category',false);
         $this->Session->write('messages_rate',false);
         $this->Session->write('messages_service',false);
         $this->Session->write('messages_order',false);
         $this->Session->write('messages_dir',false);
         $this->Session->write('messages_limit',false);
         $this->Session->write('messages_page',false);

         $this->set('title_for_layout', __('Leave-a-Message Inbox',true));

		$tags 	    = $this->Message->Tag->find('list');
 		$categories = $this->Message->Category->find('list');
                $instances = $this->Message->find('list', array('fields' => array('Message.instance_id')));
 		$this->set(compact('tags','categories','instances'));


      }


      function disp($page = null){


      $this->Message->recursive = 1; 
      $tag = $category = $rate = $instance_id = $dir = $limit = $id = false;
      $param = $conditions = $order = array();
      $data = $this->data['Message'];
      $no_match = false;


      if($data['tag']){

        $tags = $this->Message->Tag->findById($data['tag']);

           foreach ($tags['Message'] as $key => $message){
                $message_id[] = $message['id'];
           }
           if(isset($message_id)){
              $conditions['Message.id'] = $message_id;
           } else {
             $no_match = true;
           }


      }


      if($data['category']){
         $conditions['Category.id'] = $data['category'];
         $this->Session->write('messages_category',$data['category']);
      } elseif ( $category = $this->Session->read('messages_category')){
        $conditions['Message.category_id']  = $category;
      }

      if($data['rate']){
         $conditions['Message.rate'] = $data['rate'];
         $this->Session->write('messages_rate',$data['rate']);

      } elseif ($rate = $this->Session->read('messages_rate')){

        $conditions['Message.rate'] = $rate;

      }

      if($data['service']){

         $conditions['Message.instance_id'] = $data['service'];
         $this->Session->write('messages_service',$data['service']);

      } elseif ($service  = $this->Session->read('messages_service')) {

        $conditions['Message.instance_id'] = $service;

      }


      if($data['dir']){
         $dir = $data['dir'];
         $this->Session->write('messages_dir',$dir);
      } elseif (!$dir = $this->Session->read('messages_dir')){

        $dir ='desc';
 
	}
     
      if($data['order']){
          if($data['order'] == 'Message.new'){ $dir = 'DESC';}
         $order = $data['order'].' '.$dir;
         $this->Session->write('messages_order',$order);
      } elseif (!$order = $this->Session->read('messages_order')){

        $order = 'Message.created '.$dir;
      }


      if($data['limit']){
         $limit = $data['limit'];
        $this->Session->write('messages_limit',$limit);
     
      } elseif (!$limit = $this->Session->read('messages_limit')) {
        $limit = 10;
      }

      if(!$page){
        $page = 1;
      } 

        
         $this->Session->write('Message.source', 'index');


         $conditions['Message.status'] = 1;
         if(!$no_match){      
             $this->paginate = array('conditions' => $conditions, 'order' => $order,'limit' => $limit, 'page' => $page);
   	     $data = $this->paginate('Message');
	     $this->set('messages',$data);  

             foreach ($data as $key => $message){
                $id[] = $message['Message']['id'];
             }
         } else {

           $this->set('messages',false);  
         }
         $this->Session->write('messages_selected', $id);


      }



      function archive(){

         $this->set('title_for_layout', __('Leave-a-Message Archive',true));
         $this->Session->write('Message.source', 'archive');
     
         if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('messages_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
	 } elseif($this->Session->check('messages_sort')) { 
		if(in_array($this->Session->read('messags_sort'),array('new','title','rate','category','created','modified','length'))){
		   $this->paginate['order'] = $this->Session->read('messages_sort');
		} 
	 } 

         if(isset($this->params['named']['limit'])) { 
	    $this->Session->write('messages_limit',$this->params['named']['limit']);
	 } elseif($this->Session->check('messages_limit')) { 
	   $this->paginate['limit'] = $this->Session->read('messages_limit');
	 }	

         $conditions['Message.status'] = 0;
         $this->paginate = array('conditions' => $conditions);
   	 $data = $this->paginate('Message');
	 $this->set('messages',$data);

        }


     function view($id){


      $this->Message->id = $id;
      $this->set('data',$this->Message->read());       

      }


    function edit($id = null)    {  

            $this->set('title_for_layout', __('Edit Leave-a-Message',true));

	     if(!$id){
		     $this->redirect(array('action' =>'/'));

	     } elseif(empty($this->data['Message'])){

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

                        $data = $this->Message->find('list');
                        $keys = array_keys($data);
			$field = 'id';
			$dir = 'asc';
		}

                
      		$this->Session->write('Message.messages_sort', $dir);
      	  	$neighbors = $this->Message->find('neighbors', array('field' => $field, 'dir' => 'desc','value' => $this->data['Message'][$field], 'conditions' => array('status' => $this->data['Message']['status'] )));	

		$tags 	    = $this->Message->Tag->find('list');
 		$categories = $this->Message->Category->find('list');
 		$this->set(compact('tags','categories','neighbors','keys'));

		}

	else {

	if($this->Message->saveAll($this->data)){

                $title = $this->Message->getTitle($id);
		$this->Message->save($this->data['Tag']);
		$this->_flash(__('The entry has been updated',true),'success');
	        $this->log('[INFO] MESSAGE EDITED, Id: '.$id.', Title: '.$title, 'message');    	     

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

    	     if($this->Message->delete($id))
	     {
	     $this->Session->setFlash('Message with title "'.$title.'" has been deleted.');
             $this->log('[INFO] MESSAGE DELETED, Id: '.$id.', Title: '.$title, 'message');    	     
	    
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
                           $title = $this->Message->getTitle($id);
			   if ($action == __('Delete',true)){
		     	       if ($this->Message->delete($id)){

                                     $this->log('[INFO] MESSAGE DELETED, Id: '.$id.', Title: '.$title, 'message');    	     

			        }
			    } elseif ($action == __('Move to Archive',true)){
				$this->Message->saveField('status',0);
                                $this->log('[INFO] MESSAGE ARCHIVED, Id: '.$id.', Title: '.$title, 'message');    	     

			    }  elseif ($action == __('Activate',true)){
				$this->Message->saveField('status',1);
                                $this->log('[INFO] MESSAGE ACTIVATED, Id: '.$id.', Title: '.$title, 'message');    	     

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
