<?php

class CdrController extends AppController{

      var $name = 'Cdr';
      var $helpers = array('Csv','Javascript');

      var  $paginate = array('limit' => 10, 'page' => 1, 'order' => array( 'Cdr.epoch' => 'desc')); 


      function refresh(){

      $this->autoRender = false;
 
      $this->Cdr->refresh();

      }


      function index(){


        if(isset($this->params['form']['submit'])) {
		if ($this->params['form']['submit']==__('Refresh',true)){
                   $this->requestAction('/cdr/refresh');
                   }
       }


      $this->pageTitle = 'Call Data Records';

      $this->Session->write('Cdr.source', 'index');
   
      //Source: http://www.muszek.com/cakephp-how-to-remember-pagination-sort-order-session

      if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('cdr_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
		}
	elseif($this->Session->check('cdr_sort')) { 
  		$this->paginate['order'] = $this->Session->read('cdr_sort');
		} 

      if(isset($this->params['named']['limit'])) { 
	$this->Session->write('cdr_limit',$this->params['named']['limit']);
	}
	elseif($this->Session->check('cdr_limit')) { 
	$this->paginate['limit'] = $this->Session->read('cdr_limit');
	}	

	     $this->Cdr->recursive = 0; 

   	     $data = $this->paginate('Cdr');

	     $this->set('cdr',$data);  

	     }



    function delete ($id){

    	     $call_id = $this->Cdr->getCallId($id);

    	     if($this->Cdr->del($id))
	     {
	     $this->Session->setFlash('CDR with Call ID "'.$call_id.'" has been deleted.');
	     $this->log("Action: entry deleted; Call-ID: ".$call_id, "cdr"); 
	     }

             $this->redirect(array('action' => 'index'));


    }

    function process (){

    	    if(!empty($this->params['form']['cdr'])){
	   
	      $entries = $this->params['form']['cdr'];
    	      $action = $this->params['data']['Submit'];
    	      foreach ($entries as $key => $id){
    	     	    if ($id) {
		       $this->Cdr->id = $id;
		       if ($action == __('Delete',true)){
    	     	       	   $call_id = $this->Cdr->getCallId($id);
     	       	  	   if ($this->Cdr->del($id)){
	     		      $this->log("Action: entry deleted; Call-ID: ".$call_id, "cdr"); 
			    }
			}
		    }
	      }
	     }
	  $this->redirect(array('action' => 'index'));

    }

    function output(){

    debug($this->data);
    	     Configure::write('debug', 0);
    	     $this->set('data', $this->Cdr->findAll()); 

    	     $this->layout = null;
    	     $this->autoLayout = false;

    	     $this->render();    
    }


      function export(){

      $start	  = $this->data['Cdr']['start_time'];
      $end 	  = $this->data['Cdr']['start_time'];
 
      $start = $start['year'].'-'.$start['month'].'-'.$start['day'];
      $end   = $end['year'].'-'.$end['month'].'-'.$end['day'];

      $start_epoch = strtotime($start);
      $end_epoch = strtotime($end);

    	     $this->render();  
  
     }


}
?>
