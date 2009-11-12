<?php
App::import("Vendor", "ivr_xml", false, null, 'ivr_xml.php'); 
App::import("Xml");

class IvrMenusController extends AppController{

	var $name = 'IvrMenus';
	var $helpers = array('Flash','Session','Ajax','Formatting');      



   function index(){

   	//Avoid fetching associated data
	$this->IvrMenu->recursive = -1;
	
	//Fetch all data from model IvrMenu, apply pagination
	$this->set('ivr_menus', $this->paginate());

	}

    function update() {

        $this->IvrMenu->id = $this->data['IvrMenu']['parent'];
	$this->IvrMenu->updateParent();

	//Recreate ivr.xml
	$this->IvrMenu->writeIVR();

   	$this->redirect(array('action' => 'index'));

   }



   function add(){

	$iid=IID;

            $ivr_settings = Configure::read('IVR_SETTINGS');
            $ivr_default  = Configure::read('IVR_DEFAULT');

      
	//List all nodes
	$nodes = $this->IvrMenu->Node->find('list');
        $this->set(compact('nodes'));


      //Render empty form
      if (empty($this->data)){

	//Render view
	$this->render();
      }


      //Form data exists. Validate and save form data
      else{

        //set instance_id
	$this->data['IvrMenu']['instance_id']=$iid;

	if ($this->IvrMenu->save($this->data['IvrMenu'],array('validate' => 'only'))){

	   //Retrieve id of saved poll
	   $id = $this->IvrMenu->getLastInsertId();

		foreach($this->data['IvrMenuFile'] as $key => $file){
				
			if ($file['size']){
				$file['fileName']=$id."_".$key;
				$fileData[] = $file;
			}
		   
		   }


                 if(isset($fileData)){

	          //Upload one ore more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].IID."/".$ivr_settings['dir_menu'], $fileData ,false,'wav',true,true);


                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

	                                   // Convert wav to mp3
                       	 	   	   $this->wav2mp3($url);

                                           // Update database field correponding to file 
                                           $filename = $fileOK['files'][$key];
                                           $part = strstr($filename,'_');
   			                   $field=substr($part,1,strlen($part)-5);
                                           $this->IvrMenu->saveField($field,$filename);
		   			   $this->log("Msg: INFO; Action: IVR edit; Type: new audio file; Code: ".$url, "ivr");
				   }
					
				}
                 }

		 $this->IvrMenu->setParent($id);

	        //Recreate ivr.xml
		$this->IvrMenu->writeIVR();
		//Flash message and redirect to index
	 	$this->Session->setFlash(__("The voice menu has been created!",true));
	 	$this->redirect(array('action' => 'index'));


         }

	 } 

  
   }

   function edit($id = null){

	Configure::write('debug', 3);
            $ivr_settings = Configure::read('IVR_SETTINGS');
            $ivr_default  = Configure::read('IVR_DEFAULT');


   	    //Invalid id
	  if (!$id && empty($this->data)){

	     $this->Session->setFlash(__('Invalid option', true)); 
  	     $this->log("Msg: WARNING; Action: IVR edit; Type: incorrect id; Code: ".$id, "ivr");	
	     $this->redirect(array('action'=>'index')); 
	  }


	  //No submitted form data. Fetch data from db and display
    	  elseif(empty($this->data['IvrMenu'])){

		//Set id
		$this->IvrMenu->id = $id;

		//Fetch list of all nodes
		$nodes = $this->IvrMenu->Node->find('list');
        	$this->set(compact('nodes'));

		//Unbind association with nodes
		$this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   
		
		//Fetch single record, and render view
		$this->data = $this->IvrMenu->findById($id);
		$this->render();


          }


	  //Save submitted data.
	  else {


		   foreach($this->data['IvrMenuFile'] as $key => $file){


				
			if ($file['size']){
				$file['fileName']=$id."_".$key;
				$fileData[] = $file;
			}
		   
		   }

		$flashMsg ='';

                 if(isset($fileData)){

		  //Upload one ore more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].IID."/".$ivr_settings['dir_menu'], $fileData ,false,'wav',true,true);

		//  debug($fileOK);
                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

	                                   // Convert wav to mp3
                       	 	   	   $this->wav2mp3($url);

                                           // Update database field correponding to file 
                                           $filename = $fileOK['files'][$key];
                                           $part = strstr($filename,'_');
   			                   $field=substr($part,1,strlen($part)-5);
                                           $this->IvrMenu->saveField($field,$filename);

					   $this->log("Msg: INFO; Action: Edit menu; Type: ".$url."; Code: N/A", "ivr");
				   }
					
			}



			if(array_key_exists('errors',$fileOK)){


				foreach ($fileOK['errors'] as $key => $error){
					$flashMsg.= $error."<br/>";
				}
			}

                     }

          //Save text based form data
         $this->IvrMenu->save($this->data);

	 //Update IVR xml file
	 $this->IvrMenu->writeIVR();

	//Flash message and redirect to index
	 $this->Session->setFlash($flashMsg);
	 $this->redirect(array('action' => 'index'));

	 } 

   }



    function delete ($id){

	     //Check if IVR is parent
    	     $isParent = $this->IvrMenu->isParent($id);

	     
	   //Delete IVR

	   //do not delete demo ivr
	   if($id !=2){

    	     	if($this->IvrMenu->delete($id,true)){
		   $this->log("Msg: INFO; Action: IVR deleted; Type: ".$id."; Code: N/A", "ivr");
		   $this->Session->setFlash(__('The voice menu has been deleted.',true),'default',array('class'=>'message_success'));
		 }

		 //If IVR was parent
		 if($isParent && !$this->IvrMenu->lastIVR()){

			//Get id of new parent (first in the list)       	   
			$this->IvrMenu->id = $this->IvrMenu->nextEntry();
		
			//Set new parent
	     		$this->IvrMenu->setNewParent();
		}	

	   }

	  	$this->redirect(array('action' => '/index'));
      }


}

?>