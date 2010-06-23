<?php
/****************************************************************************
 * nodes_controller.php		- Controller for nodes (aka Menu options). Used in IVR's (voice menus).
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

class NodesController extends AppController{

      var $name = 'Nodes';
      var $helpers = array('Html', 'Session','Form','Formatting','Flash');

    
     	

      function index(){


      	     $this->pageTitle = 'Voice menus : Audio files';           
             $this->paginate['limit'] = 10;
	     $this->Node->recursive = 0; 

      if(isset($this->params['named']['limit'])) { 
	$this->Session->write('messages_limit',$this->params['named']['limit']);
	}
	elseif($this->Session->check('messages_limit')) { 
	$this->paginate['limit'] = $this->Session->read('messages_limit');
	}	


     	     $this->set('nodes',$this->Node->find('all',array('order'=>'Node.created ASC')));
	     $this->set('nodes',$this->paginate());
     }



   function add(){

      	     $this->pageTitle = 'Voice menus : Audio files : Add';           

   	$iid = IID;
   	$ivr_settings = Configure::read('IVR_SETTINGS');
	$path = $ivr_settings['path'].$iid."/".$ivr_settings['dir_node'];

	// Form data exist, save and redirect to Index
	if (!empty($this->data)) {



	   //Fetch form data
	   $files = array();


	   $files[0] = $this->data['Node']['file'];
           $title = $this->data['Node']['title'];
	   

	   //If title exists, upload file (wav)

   	   $this->Node->set( $this->data );

  	   if ($this->Node->validates()){

             $fileOK = $this->uploadFiles($path, $files ,false,'audio',false,false);

		//File upload OK
		if(array_key_exists('urls', $fileOK)){

		      //Set db fields
	              $this->data['Node']['file']        = $this->getFilename($fileOK['files'][0]);
		      $this->data['Node']['instance_id'] = $iid;
	      	
		      //Save node in db

		      $this->Node->save($this->data, array('validate' => false));
		
		      //Log new node
		      $this->log('Msg: NEW NODE AUDIO FILE; File: '.$fileOK['files'][0], 'ivr');
		      
		      //Flash message and redirect	
		      $this->Session->setFlash(__('The voice menu node has been created.', true));
		      $this->redirect(array('action'=>'index'));


		}

		//File upload NOT OK
		elseif(array_key_exists('errors', $fileOK)) {
		
		      //Flash messsage, log error
		      $this->Session->setFlash($fileOK['errors'][0], 'default',array('class' => 'error-message'));

		}
		else {
	
	         $this->Session->setFlash(__('No file selected', true));
		 $this->log("Msg: ERROR; Action: file upload; Type: no file; Code: ".$fileOK['errors'][0],"ivr");
   	         
	         }
	    }


	}
			

      //Render empty form
      if (empty($this->data)){


	 }


}


    function delete ($id){

      	     $iid = IID;
    	     $ivr_settings = Configure::read('IVR_SETTINGS');
      	     $path = '/'.$ivr_settings['path'].$iid."/".$ivr_settings['dir_node'];

	     if(!$this->Node->isActive($id)){
	     
		$this->data = $this->Node->findById($id);
  	     	$this->Node->deleteAudio($this->data['Node']['file'],$path,array('mp3','wav'));

    	     	if($this->Node->delete($id,true)){

			$this->Session->setFlash(__('The selected voice menu node has been deleted.',true),'default',array('class'=>'message_success'));
	     		$this->log('Msg: Node deleted, ID: '.$id, 'node');	
	     		$this->redirect(array('action' => '/index'));
	     		}
	     }

	     else {
		$this->Session->setFlash(__('The selected voice menu node could not be deleted as it is present in one or more Voice menus.',true),'default',array('class'=>'message_success'));
		$this->redirect(array('action' => '/index'));
	     }

    }



   function edit($id=null){

      	$this->pageTitle = 'Voice menus : Audio files : Edit';           
   	$iid = IID;
   	$ivr_settings = Configure::read('IVR_SETTINGS');
	$path = $ivr_settings['path'].$iid."/".$ivr_settings['dir_node'];

	// Non-existing id, or empty form

	  if (!$id && empty($this->data)){

	     $this->Session->setFlash(__('Invalid audio file', true)); 
	     $this->redirect(array('action'=>'index')); 
	  }

    	  elseif(empty($this->data['Node'])){

		$this->Node->id = $id;
		$this->data = $this->Node->read(null,$id);
   	   	//$this->Node->set( $this->data );

          }


	  else {


	       $files = array();

	       $files[0] = $this->data['Node']['file'];

	       if ($files[0]['size']){

	       $fileOK = $this->uploadFiles($path, $files ,false,'audio', false, false);
	       
		       	if(array_key_exists('urls', $fileOK)) {


				$this->data['Node']['file']        = $this->getFilename($fileOK['files'][0]);
				$this->data['Node']['instance_id'] = $iid;		
				$this->log('Msg: NEW NODE AUDIO FILE; File: '.$fileOK['files'][0], 'ivr');	
			        //$this->Node->save($this->data);

     				$this->Node->save($this->data, array('validate' => false));

				$this->Node->deleteAudio($this->data['Node']['file_old'],$path,array('mp3','wav'));

				$this->Session->setFlash(__('The settings has been saved', true));
				$this->redirect(array('action'=>'index'));


			 }

			elseif(array_key_exists('errors', $fileOK)) {

				$this->log('Msg: NODE UPLOAD ERROR; Type: '.$fileOK['errors'][0], 'ivr');
				$this->Node->save($this->data,array('fieldList'=>array('title','modified')));	
				$this->Session->setFlash($fileOK['errors'][0]);
			 }


		}

		//no file to upload, save text

		else {

		    $this->Node->save($this->data,array('fieldList'=>array('title','modified'),'validate'=>true));
		    $this->redirect(array('action'=>'index'));


		}

		}

	}


  function download ($id) {


    	Configure::write('debug', 0);

	$this->Node->id = $id;
	$data = $this->Node->read();
	
	$file = $data['Node']['file'].'.mp3';
	$name = $data['Node']['title'];
	$url  = 'webroot/freedomfone/ivr/'.IID.'/nodes';

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
