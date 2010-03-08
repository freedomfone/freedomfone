<?php
/****************************************************************************
 * ivr_menus_controller.php	- Controller for IVR menus. Manages CRUD operations. Creating ivr.xml file.
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

App::import("Vendor", "ivr_xml", false, null, 'ivr_xml.php'); 
App::import("Xml");

class IvrMenusController extends AppController{

	var $name = 'IvrMenus';
	var $helpers = array('Flash','Session','Ajax','Formatting');      



   function index(){

      	$this->pageTitle = 'Voice menus';           

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

      	$this->pageTitle = 'Voice menus : Add';           
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

	$this->data['IvrMenuFile']['file_long'] = $this->data['IvrMenu']['file_long'];
	$this->data['IvrMenuFile']['file_short'] = $this->data['IvrMenu']['file_short'];
	$this->data['IvrMenuFile']['file_exit'] = $this->data['IvrMenu']['file_exit'];
	$this->data['IvrMenuFile']['file_invalid'] = $this->data['IvrMenu']['file_invalid'];

	$this->data['IvrMenu']['file_long']= $this->data['IvrMenu']['file_long']['error'];
	$this->data['IvrMenu']['file_short']= $this->data['IvrMenu']['file_short']['error'];
	$this->data['IvrMenu']['file_exit']= $this->data['IvrMenu']['file_exit']['error'];
	$this->data['IvrMenu']['file_invalid']= $this->data['IvrMenu']['file_invalid']['error'];

	if ($this->IvrMenu->save($this->data['IvrMenu'] )){

	   //Retrieve id of saved poll
	   $id = $this->IvrMenu->getLastInsertId();

		foreach($this->data['IvrMenuFile'] as $key => $file){
			
			if ($file['size']){
				$file['fileName']=$id."_".$key;
				$fileData[] = $file;
			} elseif ($file['error']==1 && !$file['size']) {
			       $this->Session->setFlash(__('The following file could not be uploaded due to file size restrictions',true).': '.$file['name'], 'default',array('class' => 'error-message'));							
			   }	
		  
		   
		   }


                 if(isset($fileData)){

	          //Upload one or more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].IID."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);


                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

                                           // Update database field correponding to file 
                                           $filename = $this->getFilename($fileOK['files'][$key]);
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

      	$this->pageTitle = 'Voice menus : Edit';           

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
		$nodes['title']   = $this->IvrMenu->Node->find('list');
		$nodes['file']    = $this->IvrMenu->Node->find('list', array('fields' => array('Node.file')));
	

        	$this->set(compact('nodes'));

		//Unbind association with nodes
		$this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   
		
		//Fetch single record, and render view
		$this->data = $this->IvrMenu->findById($id);
		$this->render();


          }



	  //Save submitted data.
	  else {

		$flashMsg ='';
		   foreach($this->data['IvrMenuFile'] as $key => $file){

			if ($file['size']){
				$file['fileName']=$id."_".$key;
				$fileData[] = $file;
			}  elseif ($file['error']==1 && !$file['size']) {
			   $flashMsg = $flashMsg."<br/>".__('The following file could not be uploaded due to file size restrictions',true).': '.$file['name'];			
			   }	
		  
		   
		   }



                 if(isset($fileData)){

		  //Upload one ore more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].IID."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);

                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

                                                               $filename = $this->getFilename($fileOK['files'][$key]);
					     $name= $fileData[$key]['name'];
                                           $part = strstr($filename,'_');
   			                   $field=substr($part,1,strlen($part));
                                           $this->IvrMenu->saveField($field,$name);

                                           // Update database field correponding to file 

					   $this->log("Msg: INFO; Action: Edit menu; Type: ".$url."; Code: N/A", "ivr");
				   }
					
			}



			if(array_key_exists('errors',$fileOK)){

				foreach ($fileOK['errors'] as $key => $error){
					$flashMsg = $flashMsg."<br/>".$error;
					
				}
			}

                     }



          //Save text based form data

        // $this->IvrMenu->save($this->data);
	$this->IvrMenu->customizeSave($this->data);

	 //Update IVR xml file
	 $this->IvrMenu->writeIVR();

	//Flash message and redirect to index
	 $this->Session->setFlash($flashMsg, 'default',array('class' => 'error-message'));
	    $this->redirect(array('action' => 'index'));


	 } 

   }



    function delete ($id){

	     //Check if IVR is parent
    	     $isParent = $this->IvrMenu->isParent($id);

	     
	   //Delete IVR

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

	  

	  	$this->redirect(array('action' => '/index'));
      }


}

?>