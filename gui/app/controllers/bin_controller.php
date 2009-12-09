<?php

class BinController extends AppController{

      var $name = 'Bin';
      var $helpers = array('Time','Html', 'Session','Form');
      var  $paginate = array('limit' => 10, 'page' => 1, 'order' => array( 'Bin.created' => 'desc')); 

      var $scaffold;


      function index(){

      	    $this->pageTitle = 'Unclassified SMS';

            if(isset($this->params['named']['sort'])) { 
      		
			$this->Session->write('messages_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
		
	     }  elseif($this->Session->check('messages_sort')) { 
  		
			$this->paginate['order'] = $this->Session->read('messages_sort');
	     } 


     	     $this->Bin->recursive = 0; 
 //    	     $this->set('data',$this->Bin->find('all',array('order'=>'Bin.created ASC')));
//	     $this->set('data',$this->paginate());


   	     $data = $this->paginate();
	     $this->set('data',$data);  



      }


    function delete ($id){

    	     $body = $this->Bin->getBody($id);
    
    	     if($this->Bin->del($id))
	     {
		$this->Session->setFlash('Entry with message body "'.$body.'" has been deleted.');
	     	$this->log('Message: MESSAGE DELETED; Id: '.$id."; Body:".$body, 'bin');
	     	$this->redirect(array('action' => 'index'));
	     }

    }



}
?>
