<?php



class NodesController extends AppController{

      var $name = 'Nodes';
      var $helpers = array('Html', 'Session','Form','CssMenu','Formatting','Flash');


      
     	

      function index(){

      	     $this->pageTitle = 'Voice menus : Audio files';           
             $this->paginate['limit'] = 10;
	     $this->Node->recursive = 0; 

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
	   if ($title) { 
	   
             $fileOK = $this->uploadFiles($path, $files ,false,'wav',false,false);

		//File upload OK
		if(array_key_exists('urls', $fileOK)){

		      //Set db fields
	              $this->data['Node']['file']        = $fileOK['files'][0];
		      $this->data['Node']['instance_id'] = $iid;

	              // Convert wav to mp3
                      $this->wav2mp3($fileOK['urls'][0]);

		      //Save node in db
		      $this->Node->save($this->data);

		      //Log new node
		      $this->log('Msg: NEW NODE AUDIO FILE; File: '.$fileOK['files'][0], 'ivr');
		      
		      //Flash message and redirect	
		      $this->Session->setFlash(__('The voice menu node has been created.', true));
		      $this->redirect(array('action'=>'index'));
		}

		//File upload NOT OK
		elseif(array_key_exists('errors', $fileOK)) {
		
		      //Flash messsage, log error
		      $this->Session->setFlash($fileOK['errors'][0], true);
    		 
		}
		else {
	
	         $this->Session->setFlash(__('No file selected', true));
		 $this->log("Msg: ERROR; Action: file upload; Type: no file; Code: ".$fileOK['errors'][0],"ivr");
   	         
	         }
	    }

	    else {

      $this->Node->save($this->data);
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

			$this->Session->setFlash('The selected voice menu node has been deleted.','default',array('class'=>'message_success'));
	     		$this->log('Msg: Node deleted, ID: '.$id, 'node');	
	     		$this->redirect(array('action' => '/index'));
	     		}
	     }

	     else {
		$this->Session->setFlash('The selected voice menu node could not be deleted as it is present in one or more Voice menus.','default',array('class'=>'message_success'));
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
	//	$this->set('data',$this->Node->read());       
          }


	  else {


	       $files = array();

	       $files[0] = $this->data['Node']['file'];

	       if ($files[0]['size']){

	       $fileOK = $this->uploadFiles($path, $files ,false,'wav', false, false);
       
		       	if(array_key_exists('urls', $fileOK)) {

	                        // Convert wav to mp3
                       	 	$this->wav2mp3($fileOK['urls'][0]);


				$this->data['Node']['file']        = $fileOK['files'][0];
				$this->data['Node']['instance_id'] = $iid;		
				$this->log('Msg: NEW NODE AUDIO FILE; File: '.$fileOK['files'][0], 'ivr');	
			        $this->Node->save($this->data);

				$this->Node->deleteAudio($this->data['Node']['file_old'],$path,array('mp3','wav'));

				$this->Session->setFlash(__('The settings has been saved', true));
				$this->redirect(array('action'=>'index'));


			 }

			elseif(array_key_exists('errors', $fileOK)) {

				$this->log('Msg: NODE UPLOAD ERROR; Type: '.$fileOK['errors'][0], 'ivr');
				$this->Node->save($this->data,array('fieldList'=>array('title','modified')));	
				$this->Session->setFlash(__($fileOK['errors'][0], true));
			 }


		}

		//no file to upload, save text

		else {

	        $this->Node->save($this->data,array('fieldList'=>array('title','modified')));	
		$this->redirect(array('action'=>'index'));
		}

		}

	}

}

?>
