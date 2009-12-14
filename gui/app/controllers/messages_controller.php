<?php

class MessagesController extends AppController{

      var $name = 'Messages';

      var $helpers = array('Flash','Formatting','Session');      

      var  $paginate = array('limit' => 10, 'page' => 1, 'order' => array( 'Message.created' => 'desc')); 




      function index(){

      $this->pageTitle = 'Leave-a-Message : Inbox';

      //Source: http://www.muszek.com/cakephp-how-to-remember-pagination-sort-order-session

      if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('messages_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
		}
	elseif($this->Session->check('messages_sort')) { 
  		$this->paginate['order'] = $this->Session->read('messages_sort');
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

      if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('messages_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
		}
	elseif($this->Session->check('messages_sort')) { 
  		$this->paginate['order'] = $this->Session->read('messages_sort');
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

      	  	$neighbors = $this->Message->find('neighbors', array('field' => 'id', 'value' => $id));	

		$tags 	    = $this->Message->Tag->find('list');
 		$categories = $this->Message->Category->find('list');
 		$this->set(compact('tags','categories','neighbors'));

		     

		}

	else {

	if($this->Message->save($this->data['Message'])){

		$this->Message->save($this->data['Tag']);
		$this->Session->setFlash('Your message has been updated');
    	     
		$submit = $this->params['data']['Submit'];

		if ($submit == 'Save & Next' ){
		   $redirect = 'edit/'.$this->data['Message']['next'];
		   }

		   else {
		   $redirect = 'index';
		   }

		$this->redirect(array('action' => $redirect));
		}

	}
    }


    function delete ($id){


     	     $title = $this->Message->getTitle($id);

    	     if($this->Message->del($id))
	     {
	     $this->Session->setFlash('Message with title "'.$title.'" has been deleted.');
	     $this->log('Msg: MESSAGE  DELETED; Id:title: '.$id.":".$title, 'leave_message');
	     $this->redirect(array('action' => 'index'));
	     }

    }


    function process (){

    	     if(!empty($this->data['Message'])){

	    $entries = $this->params['form']['message'];
    	    $action = $this->params['data']['Submit'];
    	     	    foreach ($entries as $key => $id){

	     	     	    if ($id) {

			       $this->Message->id = $id;
			 
			       if ($action == __('Delete',true)){

		     	       	  	   if ($this->Message->del($id)){
				     	        $title = $this->Message->getTitle($id);
						$this->log('Msg: MESSAGE  DELETED; Id:title: '.$id.":".$title, 'leave_message');

	
					    }
			       }

			       elseif ($action == __('Move to Archive',true)){

				      $this->Message->saveField('status',0);
 	      			      $this->log('ARCHIVE Message '.$id, 'leave_message');		       

			       }

			       elseif ($action == __('Activate',true)){

	
				      $this->Message->saveField('status',1);
 	      			      $this->log('Msg: MESSAGE ACTIVATED '.$id, 'leave_message');		       

			       }

	     
			    }

	             }



		     if (!$redirect = $this->data['Message']['source']){

		     	$redirect = 'index';

		     }

		     $this->redirect(array('action' => $redirect));
    	     } //empty

	     else {

		 $this->redirect(array('action' => 'index'));
             }

    }


      function refresh(){

      $this->autoRender = false;

      $array = Configure::read('lm_in');

	      
	       $obj = new ff_event($array);	       

	       if ($obj -> auth != true) {
    	       die(printf("Unable to authenticate\r\n"));
	       }


 	       while ($entry = $obj->getNext('update')){


	       $created = floor($entry['Event-Date-Timestamp']/1000000);
	       $length  = floor(($entry['FF-FinishTimeEpoch']-$entry['FF-StartTimeEpoch'])/1000);
	       
	       $data= array ( 'sender'  =>$entry['FF-CallerID'],
	       	      	      'file'    =>$entry['FF-FileID'].'.'.AUDIO_FORMAT,
	       	      	      'created' =>$created,
			      'length'  =>$length,
	       		      'url'     => $entry['FF-URI']);

		$this->log('Msg: NEW Message', 'leave_message');	

	       $this->Message->create();
	       $this->Message->save($data);

               }



     	 

     
     }


}
?>
