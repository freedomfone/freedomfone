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
	$this->IvrMenu->recursive = 0;

   	$ivr_menus = $this->paginate('IvrMenu', array('IvrMenu.ivr_type' => 'ivr'));


	//Fetch all data from model IvrMenu, apply pagination
	$this->set('ivr_menus',$ivr_menus);


	}

    function update() {

        $this->IvrMenu->id = $this->data['IvrMenu']['parent'];
	$this->IvrMenu->updateParent();

	//Recreate ivr.xml
	$this->IvrMenu->writeIVR();

   	$this->redirect(array('action' => 'index'));

   }


    function reserve($ivr_type) {

         $lm_settings = Configure::read('IVR_SETTINGS');
         $fileData = array();

         //Show form
         if  (empty($this->data)) {

             $entry = $this->IvrMenu->nextInstance($ivr_type);


             if($ivr_type=='ivr'){ $method = 'edit/';}
             elseif ($ivr_type=='switcher'){ $method = 'edit_switcher/';}

             if(!$entry['id']){
                    $this->_flash(__('There are no idle instance for a new Voice menu. Please delete an existing Voice  menu, and try again. Maximum Voice menus: 10.',true), 'warning');
                    $this->redirect(array('action' =>'/'));
              } else {
 
                    $this->redirect(array('action' => $method.$entry['id']));
                   
              }
         } 
      }



   function add(){

      	$this->pageTitle = 'Voice menus : Add';           
	

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



	$this->data['IvrMenuFile']['file_long'] = $this->data['IvrMenu']['file_long'];
	$this->data['IvrMenuFile']['file_short'] = $this->data['IvrMenu']['file_short'];
	$this->data['IvrMenuFile']['file_exit'] = $this->data['IvrMenu']['file_exit'];
	$this->data['IvrMenuFile']['file_invalid'] = $this->data['IvrMenu']['file_invalid']; 

	$this->data['IvrMenu']['file_long']= false;
	$this->data['IvrMenu']['file_short']= false;
	$this->data['IvrMenu']['file_exit']= false;
	$this->data['IvrMenu']['file_invalid']= false;


	if ($this->IvrMenu->save($this->data['IvrMenu'] )){

	   //Retrieve id of saved poll
	   $id = $this->IvrMenu->getLastInsertId();

		foreach($this->data['IvrMenuFile'] as $key => $file){


			if ($file['size']){
				$file['fileName']=$id."_".$key;
				$fileData[] = $file;
			} elseif ($file['error']==1 && !$file['size']) {
       	       		   $this->_flash(__('File upload failure (filesize exceeds maximum)',true).' : '.$file['name'], 'error');                           	
		       	   
			   }			  		   
		   }

                 if(isset($fileData)){

	          //Upload one or more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].$instace_id."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);


                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

                                           $filename = $this->getFilename($fileOK['files'][$key]);
					   $name= $fileData[$key]['name'];
                                           $part = strstr($filename,'_');
   			                   $field=substr($part,1,strlen($part));
                                           $this->IvrMenu->saveField($field,$name);
		   			   $this->log("Msg: INFO; Action: IVR edit; Type: new audio file; Code: ".$url, "ivr");
					   $this->_flash(__('Success',true).' : '.$fileOK['original'][$key], 'success');							
				   }
					
				}

			if(array_key_exists('errors', $fileOK)) {

				   foreach ($fileOK['errors'] as $key => $error ){
				   	   $this->log("Msg: UPLOAD  ERROR, Error: ".$error, 'leave_message');	
					   $this->_flash($error, 'error');

				    }
			}

                 }

		 $this->IvrMenu->setParent($id);

	        //Recreate ivr.xml
		$this->IvrMenu->writeIVR();
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

	     $this->_flash(__('Invalid option', true),'warning'); 
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


		foreach($this->data['IvrMenuFile'] as $key => $file){

			if ($file['error']==1 && !$file['size']) {
                       	        $this->_flash(__('File upload failure (filesize exceeds maximum)',true).' : '.$file['name'], 'error');                           
			   
		        } elseif ($file['size']) {
				$file['fileName']=$id."_".$key;
				$fileData[] = $file;
			}  		  
		   }

                 if(isset($fileData)){

		  //Upload one ore more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].$this->data['IvrMenu']['instance_id']."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);

                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

                                           $filename = $this->getFilename($fileOK['files'][$key]);
					   $name= $fileData[$key]['name'];
                                           $part = strstr($filename,'_');
   			                   $field=substr($part,1,strlen($part));
                                           $this->IvrMenu->saveField($field,$name);
					   $this->_flash(__('Success',true).' : '.$fileOK['original'][$key], 'success');							

                                           // Update database field correponding to file 

					   $this->log("Msg: INFO; Action: Edit menu; Type: ".$url."; Code: N/A", "ivr");
				   }
					
			}


			if(array_key_exists('errors',$fileOK)){

				foreach ($fileOK['errors'] as $key => $error){
					$this->_flash(__('Success',true).' : '.$error, 'error');												

				}
			}

                     }



          //Save text based form data

        // $this->IvrMenu->save($this->data);
	$this->IvrMenu->customizeSave($this->data);

	 //Update IVR xml file
	 $this->IvrMenu->writeIVR();

	//Redirect to index
	    $this->redirect(array('action' => 'index'));


	 } 

   }


    function delete ($id){
         
         if($id){

             $ivr_settings = Configure::read('IVR_SETTINGS');
             $instance_id = $this->IvrMenu->getInstanceID($id); 
             $dir = WWW_ROOT.$ivr_settings['path'].$instance_id.'/'.$ivr_settings['dir_menu'];


             //FIXME ! Check if IVR is active
             $isActive = false; 

             //LAM is not active -> delete
             if (!$isActive){

                //Delete action OK -> success flash
                if ($result = $this->IvrMenu->deleteIVR($id)){

                   $this->_flash(__('The selected menu has been deleted.',true),'success');
                   $result = $this->IvrMenu->emptyDir($dir);

                }

             //LAM is active -> warning flash
             } else {

               $this->_flash(__('The selected menu could not be deleted since it is a member of another IVR.',true),'warning');
            
             }


           } else {
   
              $this->_flash(__('No entry with this id exist. Please try again.',true),'error');

           }
           
           $this->redirect(array('action' => '/index'));
      }


    function delete_old ($id){


	     
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


  function download ($id,$type) {

    	Configure::write('debug', 0);
	
	$file = $id.'_file_'.$type.'.mp3';
	$url  = 'webroot/freedomfone/ivr/'.$instance_id.'/ivr';

        $this->view = 'Media';

    	$params = array(
		'id' => $file,
 		'name' => $type,
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


   function switchers(){

      	$this->pageTitle = 'Switchers';           
        $this->IvrMenu->recursive = 0; 
   	$ivr_menus = $this->paginate('IvrMenu', array('IvrMenu.ivr_type' => 'switcher'));
	$this->set('ivr_menus',$ivr_menus);



	}


    function add_switcher(){

      	$this->pageTitle = 'Language switcher : Add';           

            if (empty($this->data)){

               $this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   
	       $lam = $this->IvrMenu->query('select * from lm_menus');
	       $ivr = $this->IvrMenu->findByIvrType('ivr');
               $this->set(compact('lam','ivr'));
	       $this->render();

            } else {

            //Save data

/*
	$this->data['SwitcherFile']['file_long'] = $this->data['Switcher']['file_long'];
	$this->data['SwitcherFile']['file_invalid'] = $this->data['Switcher']['file_invalid']; 

	$this->unset(data['IvrMenu']['file_long']);
	$this->unset(data['IvrMenu']['file_invalid']);*/

	$this->IvrMenu->save($this->data);

        $this->redirect(array('action' => '/'));   
         }

        }



/*
 *
 * @param int $id
 *
 * Updates database entry, and uploads new files.
 *
 */


   function edit_switcher($id = null){

      	$this->pageTitle = 'Language switcher : Edit';           

            $settings = Configure::read('IVR_SETTINGS');


   	    //Invalid id
	  if (!$id && empty($this->data)){

	     $this->_flash(__('Invalid option', true),'warning'); 
  	     $this->log("WARNING; Action: Edit; Type: Incorrect id (".$id.")", "switcher");	
	     $this->redirect(array('action'=>'switchers')); 
	  }


	  //No submitted form data. Fetch data from db and display
    	  elseif(empty($this->data['IvrMenu'])){

		//Set id
		$this->IvrMenu->id = $id;
                $this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   

		//Fetch list of all nodes

	       $lam = $this->IvrMenu->query('select * from lm_menus');
	       $ivr = $this->IvrMenu->findByIvrType('ivr');
               $this->set(compact('lam','ivr'));


		//Unbind association with nodes
		$this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   

	
		//Fetch single record, and render view
		$this->data = $this->IvrMenu->findById($id);
		$this->render();


          }


	  //Save submitted data.
	  else {


		   foreach($this->data['SwitcherFile'] as $key => $file){
			if ($file['size']){
				$file['fileName']=$id."_".$key;
				$fileData[] = $file;
			}  elseif ($file['error']==1 && !$file['size']) {
			        $this->log("ERROR; Action: Upload file; Type: filesize (".$file['size'].")", "switcher");								
                                $this->_flash(__('The following file could not be uploaded due to file size restrictions',true).': '.$file['name'],'error');			
		        }		  
		   }
		 
                    //If file(s) exists -> upload 
                    if(isset($fileData)){
                        
                         $fileOK = $this->uploadFiles($settings['path'].$settings['dir_menu'], $fileData ,false,'audio',true,true);

                        //If file upload OK -> save to database		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

					   $this->_flash(__('Success',true).' : '.$fileOK['original'][$key], 'success');							
					   $this->log("INFO; Action: Edit switcher; Type: ".$url, "switcher");
				   }
					
			}

                        //If errors exists -> flash
			if(array_key_exists('errors',$fileOK)){

				foreach ($fileOK['errors'] as $key => $error){
					$this->_flash(__('Success',true).' : '.$error, 'error');				
					$this->log("ERROR; Action: Upload file; Type: ".$error, "switcher");								
				}
			}

                     }


	$file_long = $this->data['SwitcherFile']['file_long']; 
	$file_invalid     = $this->data['SwitcherFile']['file_invalid']; 

        //unset($this->data['Switcher']['file_long']); 
        //unset($this->data['Switcher']['file_invalid']);


        $this->data['IvrMenu']['file_long'] = $file_long['name'];
        $this->data['IvrMenu']['file_invalid'] = $file_invalid['name'];


        $model = $this->data['Switcher']['type'];
        $this->data['IvrMenu']['id_1']= $this->data['Services'][$model][1];
        $this->data['IvrMenu']['id_2']= $this->data['Services'][$model][2];
        $this->data['IvrMenu']['id_3']= $this->data['Services'][$model][3];


        $this->IvrMenu->save($this->data['Switcher']);



         //Save text based form data

	 //$this->IvrMenu->customizeSave($this->data);

	 //Update IVR xml file
	 //$this->IvrMenu->writeIVR();

	 //Redirect to index

	 $this->redirect(array('action' => 'switchers'));


	 } 

   }



}

?>