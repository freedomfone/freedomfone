<?php
/****************************************************************************
 * bin_controller.php		- Controller for Other SMS
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

class BinController extends AppController{

      var $name = 'Bin';
      var $helpers = array('Time','Html', 'Session','Form','Csv','Javascript');
      var  $paginate = array('limit' => 10, 'page' => 1, 'order' => array( 'Bin.created' => 'desc')); 

      var $scaffold;


      function index(){

      	    $this->pageTitle = 'Unclassified SMS';

     	if(isset($this->params['form']['submit'])) {
		if ($this->params['form']['submit']==__('Refresh',true)){
	   	   $this->requestAction('/bin/refresh');
   	   	   $this->requestAction('/polls/refresh');
     	   	   }
	}	   

            if(isset($this->params['named']['sort'])) { 
      		
			$this->Session->write('messages_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
		
	     }  elseif($this->Session->check('messages_sort')){
		     if(in_array($this->Session->read('messags_sort'),array('body','created','mode','proto','sender'))){
			$this->paginate['order'] = $this->Session->read('messages_sort');
			} 
	     } 

     	     $this->Bin->recursive = 0; 
   	     $data = $this->paginate();
	     $this->set('data',$data);  

      }


    function process (){


    	 if(!empty($this->data['Bin'])){

    	     $entry = $this->data['Bin'];

    	     foreach ($entry as $key => $id){

	       	   $this->Bin->id = $id;
  	       	   if ($this->Bin->del($id)){
	       	      $body = $this->Bin->getBody($id);
    		      $this->log('Message: BIN ENTRY DELETED; Id: '.$id."; Body:".$body, 'bin');
		      }

	      }
	  }
	  $this->redirect(array('action' => 'index'));

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

    function export(){

    	     Configure::write('debug', 0);
    	     $this->set('data', $this->Bin->findAll()); 

    	     $this->layout = null;
    	     $this->autoLayout = false;

    	     $this->render();    
    }



      function refresh(){

      $this->autoRender = false;
 
      $this->Bin->refresh();

      }


}
?>
