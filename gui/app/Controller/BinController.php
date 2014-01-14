<?php
/****************************************************************************
 * bin_controller.php		- Controller for Incoming SMS
 * version 		 	- 3.0.1700
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
      var $helpers = array('Time','Html', 'Session','Form','Csv','Js');
      var $paginate = array('limit' => 10, 'page' => 1, 'order' => array( 'Bin.created' => 'desc')); 

      var $scaffold;


    function refresh(){

             $this->autoRender = false;
             $this->Bin->refresh();

    }

    function index(){

          $this->set('title_for_layout', __('SMS Incoming',true));
          $this->Session->write('Bin.source', 'index');

	  $login = $this->Bin->find('all', array('fields' => 'DISTINCT login','order' => 'login ASC'));

          if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('bin_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
	  } elseif($this->Session->check('bin_sort')) { 
  		$this->paginate['order'] = $this->Session->read('bin_sort');
	  } 

          if(isset($this->params['named']['limit'])) { 
	       $this->Session->write('bin_limit',$this->params['named']['limit']);
	  } elseif($this->Session->check('bin_limit')) { 
	       $this->paginate['limit'] = $this->Session->read('bin_limit');
	  }	

     	  $this->Bin->recursive = 1; 
   	  $bin = $this->paginate();
 	  $this->set(compact('login','bin'));
      }


    function disp(){

    	     $login = $this->request->data['Bin']['login'];
    	     if($login){
		$data   = $this->paginate('Bin', array('Bin.login' => $login));
	     } else { 
	       $data   = $this->paginate('Bin');
	     }

    	     $this->set('bin',$data);  


    }

    function process (){


    	 if(!empty($this->request->data['Bin'])){

    	     $entry = $this->request->data['Bin'];
    	     foreach ($entry as $key => $id){

	       	   $this->Bin->id = $id;
       	           $body = $this->Bin->getBody($id);
  	       	   if ($this->Bin->delete($id)){

                      $this->log('[INFO], SMS DELETED; Id: '.$id.', Body:'.$body, 'bin');
    		      
		   }

	      }
	  }

	  $this->redirect(array('action' => 'index'));

    }




    function delete ($id){

    	     $body = $this->Bin->getBody($id);
    
    	     if($this->Bin->delete($id))
	     {
		$this->Session->setFlash('Entry with message body "'.$body.'" has been deleted.');
                $this->log('[INFO], SMS DELETED; Id: '.$id.", Body:".$body, 'bin');
	     	$this->redirect(array('action' => 'index'));
	     }

    }

    function export(){

    	     Configure::write('debug', 0);
    	     $this->set('data', $this->Bin->find('all')); 


    	     $this->layout = null;
    	     $this->autoLayout = false;

    	     $this->render();    
    }


    function outgoing($id){



    $auth = array(
    	      'database' => 'gammu', 
    	      'user'     => 'gammu', 
	      'host'     => 'localhost', 
	      'password' => 'thefone'
		);

     $message  = "New message ".$id; 
     $sender   = "GM1-240016010774781"; 
     $receiver = "0702867989";
     $sms = new sms('mysql', $auth);
     $id = $sms->sendSMS($message,$receiver,$sender); 

     print_r($id);

    }

}
?>
