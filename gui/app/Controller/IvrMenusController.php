<?php
/****************************************************************************
 * ivr_menus_controller.php	- Controller for IVR menus. Manages CRUD operations. Creating ivr.xml files.
 * version 		 	- 3.0.1500
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
	var $helpers = array('Flash','Session','Formatting','Js','Text');      
	var $layout  = 'jquery';

/*
 * Lists all IVR (Voice Menus)
 *
 * 
 *
 */

   function index(){

        $this->set('title_for_layout', __('Voice menus',true));           

   	//Avoid fetching associated data
	$this->IvrMenu->recursive = 0;

   	$ivr_menus = $this->paginate('IvrMenu', array('IvrMenu.ivr_type' => 'ivr'));


	//Fetch all data from model IvrMenu, apply pagination
	$this->set('ivr_menus',$ivr_menus);



	}



/*
 * Create new IVR (Voice Menu)
 *
 * 
 *
 */
   function add(){

        $this->set('title_for_layout', __('Add Voice Menu',true));           
	

            $ivr_settings = Configure::read('IVR_SETTINGS');
            $ivr_default  = Configure::read('IVR_DEFAULT');

      
		//Fetch list of all IVR
		$voicemenu = $this->IvrMenu->find('list', array('conditions' => array('IvrMenu.ivr_type' => 'ivr')));


	        //Fetch list of all nodes
                $this->loadModel('Node');
		$nodes['title']   = $this->Node->find('list');
		$nodes['file']    = $this->Node->find('list', array('fields' => array('Node.file')));


		//Fetch list of all lam
                $this->loadModel('LmMenu');
		$lam  = $this->LmMenu->find('list');


        	$this->set(compact('nodes','lam','voicemenu'));


      //Render empty form
      if (!array_key_exists('IvrMenu', $this->request->data)){

        //Get instance id
        $instance_id =$this->IvrMenu->nextInstance();


        if($instance_id <= $ivr_settings['instance_end']){

                //Render view
	        $this->render();
        
        } else {
       	       $this->Session->setFlash(__('There are no more Voice Menus available. Please delete an inactive Voice Menu, and try again.',true), 'warning');                           	
	       $this->redirect(array('action' => 'index'));
        }


      }


      //Form data exists. Validate and save form data
      else{

        //Get instance id
        $instance_id =$this->IvrMenu->nextInstance();
	$this->request->data['IvrMenu']['instance_id']= $instance_id;

        //Make dir structure for new IVR
        $this->IvrMenu->makeDir($instance_id);

	$this->request->data['IvrMenuFile']['file_long'] = $this->request->data['IvrMenu']['file_long'];
	$this->request->data['IvrMenuFile']['file_short'] = $this->request->data['IvrMenu']['file_short'];
	$this->request->data['IvrMenuFile']['file_exit'] = $this->request->data['IvrMenu']['file_exit'];
	$this->request->data['IvrMenuFile']['file_invalid'] = $this->request->data['IvrMenu']['file_invalid']; 

	$this->request->data['IvrMenu']['file_long']= false;
	$this->request->data['IvrMenu']['file_short']= false;
	$this->request->data['IvrMenu']['file_exit']= false;
	$this->request->data['IvrMenu']['file_invalid']= false;



          //Save text based form data


           foreach($this->request->data['Mapping'] as $key => $entry){

	if(array_key_exists('type', $entry)){
		
                $index = $entry[$entry['type'].'_id'];

                if($index){

                   switch($entry['type']){

                    case 'node':
	            $this->request->data['Mapping'][$key]['lam_id']= false;
	            $this->request->data['Mapping'][$key]['ivr_id']= false;

                    break;

                    case 'lam':
	            $this->request->data['Mapping'][$key]['node_id']= false;
	            $this->request->data['Mapping'][$key]['ivr_id']= false;
	            $this->request->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['lam_id'],'lam');                
                    break;

                    case 'ivr':
	            $this->request->data['Mapping'][$key]['lam_id']= false;
	            $this->request->data['Mapping'][$key]['node_id']= false;
	            $this->request->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['ivr_id'],'ivr');                
                    break;

                   }

                  } else {

	            $this->request->data['Mapping'][$key]['lam_id']= false;
	            $this->request->data['Mapping'][$key]['node_id']= false;
	            $this->request->data['Mapping'][$key]['instance_id']= false;
	            $this->request->data['Mapping'][$key]['type']= false;

                  }

		  } //key exists
                } //foreach



        if ($this->IvrMenu->saveAll($this->request->data )){


	   //Retrieve id of saved IVR
	   $id = $this->IvrMenu->getLastInsertId();
           $this->log("[INFO] ADD IVR, Id: ".$id, "ivr");	


		foreach($this->request->data['IvrMenuFile'] as $key => $file){


			if ($file['size']){
				$file['fileName'] = $key;
				$fileData[]       = $file;
			} elseif ($file['error']==1 && !$file['size']) {
 			       $this->Session->setFlash(__('The file %s could not be uploaded due to file size restrictions',$file['name']), 'error', array(), $key);
		       	   
			   }			  		   
		   }

                 if(isset($fileData)){

	          //Upload one or more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].$instance_id."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);


                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

					   $name= $fileData[$key]['name'];
                                           $field = $fileData[$key]['fileName'];
                                           $this->IvrMenu->saveField($field,$name);

		   			   $this->log("[INFO] ADD IVR, New audio file: ".$url, "ivr");
                   			   $this->Session->setFlash(__('The file %s was successfully uploaded.', $fileOK['original'][$key]), 'success', array(), $key);
				   }
					
				}

			if(array_key_exists('errors', $fileOK)) {

				   foreach ($fileOK['errors'] as $key => $error ){
				   	   $this->log("[ERROR] ADD IVR, File upload: ".$error, 'ivr');	
					   $this->Session->setFlash(__('The file %s could not be uploaded (error: %s)', array($fileOK['original'][$key], $error)), 'error', array(), $key);

				    }
			}

                 }


	        //Recreate ivr.xml
		$this->IvrMenu->writeIVR($id);
		$this->IvrMenu->writeIVRCommon();
	 	$this->redirect(array('action' => 'index'));


         }

	 } 

  
   }



/*
 * Create new IVR (Voice Menu)
 *
 * 
 *
 */
   function add_selector(){

        $this->set('title_for_layout',  __('Add Language Selector',true));           
	

        $ivr_settings = Configure::read('IVR_SETTINGS');
        $ivr_default  = Configure::read('IVR_DEFAULT');

     
        if (!array_key_exists('IvrMenu',$this->request->data)){

           //Get instance id
           $instance_id =$this->IvrMenu->nextInstance();

           if($instance_id <= $ivr_settings['instance_end']){

                //Render view
	        $this->render();
        
            } else {
       	       $this->Session->setFlash(__('There are no more Selectors available. Please delete an inactive Selector, and try again.',true), 'warning');                           	
	       $this->redirect(array('action' => 'selectors'));
           }



        }  else {

         //Form data exists. Validate and save form data

        //Get instance id
        $instance_id =$this->IvrMenu->nextInstance();
	$this->request->data['IvrMenu']['instance_id']= $instance_id;

        //Make dir structure for new IVR
        $this->IvrMenu->makeDir($instance_id);

	$this->request->data['IvrMenuFile']['file_long'] = $this->request->data['IvrMenu']['file_long'];
	$this->request->data['IvrMenuFile']['file_invalid'] = $this->request->data['IvrMenu']['file_invalid']; 
	$this->request->data['IvrMenu']['file_long']= false;
	$this->request->data['IvrMenu']['file_invalid']= false;


          //Save text based form data

          $this->request->data['IvrMenu']['switcher_type'] = $this->request->data['Mapping'][1]['type'];

                foreach($this->request->data['Mapping'] as $key => $entry){

                $index = $entry[$entry['type'].'_id'];

                if($index){


                   switch($entry['type']){

                    case 'node':
	            $this->request->data['Mapping'][$key]['lam_id']= false;
	            $this->request->data['Mapping'][$key]['ivr_id']= false;

                    break;

                    case 'lam':
	            $this->request->data['Mapping'][$key]['node_id']= false;
	            $this->request->data['Mapping'][$key]['ivr_id']= false;
	            $this->request->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['lam_id'],'lam');                
                    break;

                    case 'ivr':
	            $this->request->data['Mapping'][$key]['lam_id']= false;
	            $this->request->data['Mapping'][$key]['node_id']= false;
	            $this->request->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['ivr_id']);                
                    break;

                   }

                  } else {


	            $this->request->data['Mapping'][$key]['lam_id']= false;
	            $this->request->data['Mapping'][$key]['node_id']= false;
	            $this->request->data['Mapping'][$key]['instance_id']= false;
	            $this->request->data['Mapping'][$key]['type']= false;


                  }

                }


        if ($this->IvrMenu->saveAll($this->request->data )){


	   //Retrieve id of saved poll
	   $id = $this->IvrMenu->getLastInsertId();
           $this->log("[INFO] ADD SELECTOR, Id: ".$id, "ivr");	
		foreach($this->request->data['IvrMenuFile'] as $key => $file){


			if ($file['size']){
				$file['fileName'] = $key;
				$fileData[]       = $file;
			} elseif ($file['error']==1 && !$file['size']) {
	       		   $this->Session->setFlash(__('The file %s could not be uploaded due to file size restrictions',$file['name']), 'error', array(), $key);      	   
			   }			  		   
		   }

                 if(isset($fileData)){

	          //Upload one or more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].$instance_id."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);


                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

					   $name= $fileData[$key]['name'];
                                           $field = $fileData[$key]['fileName'];
                                           $this->IvrMenu->saveField($field,$name);

		   			   $this->log("[INFO] EDIT SELECTOR, New audio file: ".$url, "ivr");
		  			    $this->Session->setFlash(__('The file %s was successfully uploaded.', $fileOK['original'][$key]), 'success', array(), $key);
				   }
					
				}

			if(array_key_exists('errors', $fileOK)) {

				   foreach ($fileOK['errors'] as $key => $error ){
				   	   $this->log("[ERROR] UPLOAD ERROR, Error: ".$error, 'ivr');	
					   $this->Session->setFlash(__('The file %s could not be uploaded (error: %s)', array($fileOK['original'][$key], $error)), 'error', array(), $key);


				    }
			}

                 }


	        //Recreate ivr.xml
		$this->IvrMenu->writeIVR($id);
		$this->IvrMenu->writeIVRCommon();
	 	$this->redirect(array('action' => 'selectors'));


         }

	 } 

  
   }


/*
 * Edit IVR (Voice Menu)
 *
 * 
 *
 */
  
   function edit($id = null){

        $this->set('title_for_layout',  __('Edit Voice menu',true));           

            $ivr_settings = Configure::read('IVR_SETTINGS');
            $ivr_default  = Configure::read('IVR_DEFAULT');



   	    //Invalid id
	  if (!$id && empty($this->request->data)){

	     $this->Session->setFlash(__('Invalid option', true),'warning'); 
  	     $this->log("[WARNING] EDIT IVR, Incorrect id: ".$id, "ivr");	
	     $this->redirect(array('action'=>'index')); 
	  }


	  //No submitted form data. Fetch data from db and display
    	  elseif(empty($this->request->data['IvrMenu'])){


		//Set id
		$this->IvrMenu->id = $id;

		//Fetch list of all IVR
		$voicemenu = $this->IvrMenu->find('list', array('conditions' => array('IvrMenu.ivr_type' => 'ivr')));


	        //Fetch list of all nodes
                $this->loadModel('Node');
		$nodes['title']   = $this->Node->find('list');
		$nodes['file']    = $this->Node->find('list', array('fields' => array('Node.file')));


		//Fetch list of all lam
                $this->loadModel('LmMenu');
		$lam  = $this->LmMenu->find('list');

		//Fetch single record, and render view
		$this->request->data = $this->IvrMenu->findById($id);


        	$this->set(compact('nodes','lam','voicemenu'));
		$this->render();

          }



	  //Save submitted data.
	  else {


		foreach($this->request->data['IvrMenuFile'] as $key => $file){

			if ($file['error']==1 && !$file['size']) {

       	       			$this->Session->setFlash(__('The file %s could not be uploaded due to file size restrictions',$file['name']), 'error', array(), $key);
			   
		        } elseif ($file['size']) {
				$file['fileName'] = $key;
				$fileData[]       = $file;
			}  		  
		   }

                 if(isset($fileData)){

		  //Upload one ore more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].$this->request->data['IvrMenu']['instance_id']."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);

                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

				           $this->IvrMenu->id = $id;
                                           $filename = $this->getFilename($fileOK['files'][$key]);
					   $name= $fileData[$key]['name'];
                                           $field = $fileData[$key]['fileName'];
   
                                           $this->IvrMenu->saveField($field,$name);
		    			   $this->Session->setFlash(__('The file %s was successfully uploaded.', $fileOK['original'][$key]), 'success', array(), $key);
					   $this->log("[INFO] EDIT IVR, New file uploaded: ".$url, "ivr");
				   }
					
			}


			if(array_key_exists('errors',$fileOK)){

				foreach ($fileOK['errors'] as $key => $error){
					$this->Session->setFlash(__('The file %s could not be uploaded (error: %s)', array($fileOK['original'][$key], $error)), 'error', array(), $key);				
				}
			}

                     }



          //Save text based form data

               //Edit existing mappings
                foreach($this->request->data['Mapping'] as $key => $entry){


                  //Add new mappings
                  if(!$entry['type'] && ($entry['node_id'] || $entry['lam_id'] || $entry['ivr_id'])){

                     if($entry['node_id']){ 
                            $type == 'node';
                     } elseif ($entry['lam_id']) { 
                            $type = 'lam';
                     } elseif ($entry['ivr_id']) {
                            $type = 'ivr';
                     }
	            $this->request->data['Mapping'][$key]['type']= $type;                                     
		    $entry['type'] = $type;
                }



		 if(array_key_exists('type', $entry)){


                   switch($entry['type']){

                    case 'node':
	            $this->request->data['Mapping'][$key]['lam_id']= false;
	            $this->request->data['Mapping'][$key]['ivr_id']= false;
	            $this->request->data['Mapping'][$key]['instance_id']= false;
		    if(!$entry['node_id']){
		    	   $this->request->data['Mapping'][$key]['type']= false;
		    }
                    break;

                    case 'lam':

	            $this->request->data['Mapping'][$key]['node_id']= false;
	            $this->request->data['Mapping'][$key]['ivr_id']= false;
		    
		    if($lam_id = $entry['lam_id']){
		           $this->loadModel('LmMenu');

		    	   $this->request->data['Mapping'][$key]['instance_id']= $this->LmMenu->getInstanceID($lam_id);
	             } else {
	   	           $this->request->data['Mapping'][$key]['instance_id']= false;
		    	   $this->request->data['Mapping'][$key]['type']= false;		    	   
		     }

                    break;

                    case 'ivr':
	            $this->request->data['Mapping'][$key]['lam_id']= false;
	            $this->request->data['Mapping'][$key]['node_id']= false;

		    if($ivr_id = $entry['ivr_id']){
		    	   $this->request->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($ivr_id);

	             } else {
	   	           $this->request->data['Mapping'][$key]['instance_id']= false;
			   $this->request->data['Mapping'][$key]['type']= false;
		     }

                    break;

                   } //switch



                   
		   } //array_key_exists
                }



         if(array_key_exists('IvrMenuFile', $this->request->data)){
         	unset($this->request->data['IvrMenuFile']);
		}



         $this->IvrMenu->saveAll($this->request->data);
         $this->log("[INFO] EDIT IVR, Id: ".$id, "ivr");	

	 //Update IVR xml file
	 $this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   
	 $this->IvrMenu->writeIVR($id);
	 $this->IvrMenu->writeIVRCommon();


	//Redirect to index
	$this->redirect(array('action' => 'index'));
       

	 } 

   }


/*
 * Delete IVR (Voice Menu and Language Switcher) and correspondent web directories (webroot/freedomfone/ivr/{instance_id})
 *
 * @param int $id, string $type {ivr,switcher}
 *
 */
  
    function delete ($id,$type){
         
         if($id && $type){

             $settings = Configure::read('IVR_SETTINGS');                

             switch($type){

                case 'ivr':               
                $redirect = 'index';
                break;

                case 'switcher':               
                $redirect = 'selectors';
                break;

             }

	    $this->IvrMenu->id = $id;
            $this->request->data = $this->IvrMenu->read();
            $instance_id = $this->IvrMenu->getInstanceID($id); 


             //IVR is not active -> delete
             if (!$this->isActive($id,'ivr')){


                //Delete action OK -> success flash
                if($id && $instance_id && $settings['path']){

        
                       //Empty directory of files (keep directories)
                       $dir = WWW_ROOT.$settings['path'].$instance_id; 
                       $this->emptyDir($dir,true,true);


                       if ($result = $this->IvrMenu->deleteIVR($id,$instance_id)){

                          $this->IvrMenu->writeIVRCommon();
                          $this->Session->setFlash(__('The selected entry has been deleted.',true),'success');
  	                  $this->log("[INFO] DELETE ".$type.", Id: ".$id, "ivr");	                   

                       }

                }
             
                //LAM is active -> warning flash
                } else {

  	          $this->log("[WARNING] DELETE IVR, IVR member of other voice menu: ".$id, "ivr");	
                  $this->Session->setFlash(__('The selected entry could not be deleted since it is a member of another Voice Menu.',true),'warning');
            
                }


           } else {
   
              $this->log("[WARNING] DELETE IVR, Id does not exists: ".$id, "ivr");	
              $this->Session->setFlash(__('No entry with this id exist. Please try again.',true),'error');

           }
           
           $this->redirect(array('action' => $redirect));
      }


/*
 * Download IVR (Voice Menu or Language Selector) instruction files
 *
 *  @param int $instance_id, string $type {long,short, exit, invalid}
 *
 */
  



  function download ($instance_id,$type) {

    	Configure::write('debug', 0);
	
	$file = 'file_'.$type.'.mp3';
	$path  = 'webroot/freedomfone/ivr/'.$instance_id.'/ivr/';

	$this->response->file($path . DS . $file, array(
		'download' => true, 
		'name' => $file,
		));

		return $this->response;

    }


/*
 *
 * List all IVR (Language selectors
 *
 *
 */

   function selectors(){

        $this->set('title_for_layout', __('Language Selectors',true));           
        $this->IvrMenu->recursive = 0; 
   	$ivr_menus = $this->paginate('IvrMenu', array('IvrMenu.ivr_type' => 'switcher'));
	$this->set('ivr_menus',$ivr_menus);



	}



/*
 *
 * Edit language selector
 *
 *
 */

   function edit_selector($id = null){

        $this->set('title_for_layout', __('Edit Language Selector',true));           

            $settings = Configure::read('IVR_SETTINGS');


   	    //Invalid id
	  if (!$id && !array_key_exists('IvrMenu', $this->request->data)){

	     $this->Session->setFlash(__('Invalid option', true),'warning'); 
  	     $this->log("[WARNING] EDIT SELECTOR, Incorrect id: ".$id, "ivr");	
	     $this->redirect(array('action'=>'selector')); 
	  }


	  //No submitted form data. Fetch data from db and display
    	  elseif(empty($this->request->data['IvrMenu'])){


		//Set id
		$this->IvrMenu->id = $id;
                $this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   

		//Fetch list of all IVR
		$voicemenu = $this->IvrMenu->find('list', array('conditions' => array('IvrMenu.ivr_type' => 'ivr')));


	        //Fetch list of all nodes
                $this->loadModel('Node');
		$nodes['title']   = $this->Node->find('list');
		$nodes['file']    = $this->Node->find('list', array('fields' => array('Node.file')));


		//Fetch list of all lam
                $this->loadModel('LmMenu');
		$lam  = $this->LmMenu->find('list');
	
        	$this->set(compact('nodes','lam','voicemenu'));
		

		//Fetch single record, and render view
		$this->request->data = $this->IvrMenu->findById($id);
		$this->render();


          }


	  //Save submitted data.
	  else {


		   foreach($this->request->data['SwitcherFile'] as $key => $file){
			if ($file['size']){
				$file['fileName'] = $key;
				$fileData[]       = $file;
			}  elseif ($file['error']==1 && !$file['size']) {
			        $this->log("[ERROR] EDIT SELECTOR, Upload file, Type: filesize (".$file['size'].")", "ivr");
				$this->Session->setFlash(__('The file %s could not be uploaded due to file size restrictions',$file['name']), 'error', array(), $key);
		        }		  
		   }
		 
                    //If file(s) exists -> upload 
                    if(isset($fileData)){
                        
                         $fileOK = $this->uploadFiles($settings['path'].$this->request->data['IvrMenu']['instance_id'].'/'.$settings['dir_menu'], $fileData ,false,'audio',true,true);

                        //If file upload OK -> save to database		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){
				           $this->IvrMenu->id = $id;

                   			   $this->Session->setFlash(__('The file %s was successfully uploaded.', $fileOK['original'][$key]), 'success', array(), $key);

					   $this->log("[INFO] EDIT SELECTOR, File uploaded: ".$url, "ivr");
					   $name= $fileData[$key]['name'];
                                           $field = $fileData[$key]['fileName'];
                                           $this->IvrMenu->saveField($field,$name);

				   }
					
			}

                        //If errors exists -> flash
			if(array_key_exists('errors',$fileOK)){

				foreach ($fileOK['errors'] as $key => $error){
					$this->Session->setFlash(__('The file %s could not be uploaded (error: %s)', array($fileOK['original'][$key], $error)), 'error', array(), $key);				
					$this->log("[ERROR] EDIT SELECTOR, File upload: ".$error, "ivr");								
				}
			}

                     }


                     if($this->request->data['Mapping']){ 

                         
	                 $this->request->data['IvrMenu']['switcher_type'] = $this->request->data['Mapping'][0]['type'];

                         foreach($this->request->data['Mapping'] as $key => $entry){

                              switch($entry['type']){

                               case 'node':
	                       $this->request->data['Mapping'][$key]['lam_id']= false;
	                       $this->request->data['Mapping'][$key]['ivr_id']= false;
		    	       if(!$entry['node_id']){
				$this->request->data['Mapping'][$key]['type']= false;
		               }

                               break;

                               case 'lam':
	                       $this->request->data['Mapping'][$key]['node_id']= false;
	                       $this->request->data['Mapping'][$key]['ivr_id']= false;
		    	       if($lam_id = $entry['lam_id']){
		    	      	$this->request->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($lam_id);
	         	       } else {
	   	              	$this->request->data['Mapping'][$key]['instance_id']= false;
		    	   	$this->request->data['Mapping'][$key]['type']= false;		    	   
		     	       }
                               break;

                               case 'ivr':
	                       $this->request->data['Mapping'][$key]['lam_id']= false;
	                       $this->request->data['Mapping'][$key]['node_id']= false;
		    	       if($ivr_id = $entry['ivr_id']){
		    	         $this->request->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($ivr_id);
	                        } else {
	   	                  $this->request->data['Mapping'][$key]['instance_id']= false;
			   	  $this->request->data['Mapping'][$key]['type']= false;
		                }
                                break;                             
                              }
                          }
                      }

         if(array_key_exists('SwitcherFile', $this->request->data)){
         	unset($this->request->data['SwitcherFile']);
		}

         $this->IvrMenu->saveAll($this->request->data);
	 $this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   
	 $this->IvrMenu->writeIVR($id);
	 $this->IvrMenu->writeIVRCommon();


         $this->log("[INFO] EDIT SELECTOR, Id: ".$id, "ivr");	
	 $this->redirect(array('action' => 'selectors'));


	 } 

   }

/*
 *
 * AJAX drop-down menu for Menu Options
 *
 *
 */

   function disp(){


   $service = $this->request->data['IvrMenu']['type'];


   if($service =='ivr'){ 

	$this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   
	$data = $voicemenu = $this->IvrMenu->find('list', array('conditions' => array('IvrMenu.ivr_type' => 'ivr')));


        
   } elseif($service =='lam'){
        
        $this->loadModel('LmMenu');
	$data  = $this->LmMenu->find('list');
          

   } else {

        $this->loadModel('Node');
	$data  = $this->Node->find('list');
        $field = 'Node';

   }

  $this->set(compact('data','service'));

   }

}

?>