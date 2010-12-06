<?php
/****************************************************************************
 * ivr_menus_controller.php	- Controller for IVR menus. Manages CRUD operations. Creating ivr.xml files.
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
	var $helpers = array('Flash','Session','Ajax','Formatting','Javascript');      


/*
 * Lists all IVR (Voice Menus)
 *
 * 
 *
 */

   function index(){

      	$this->pageTitle = 'Voice menus';           

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

      	$this->pageTitle = 'Voice menus : Add';           
	

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
      if (empty($this->data)){

	//Render view
	$this->render();

      }


      //Form data exists. Validate and save form data
      else{

        //Get instance id
        $instance_id =$this->IvrMenu->nextInstance();
	$this->data['IvrMenu']['instance_id']= $instance_id;

        //Make dir structure for new IVR
        $this->IvrMenu->makeDir($instance_id);

	$this->data['IvrMenuFile']['file_long'] = $this->data['IvrMenu']['file_long'];
	$this->data['IvrMenuFile']['file_short'] = $this->data['IvrMenu']['file_short'];
	$this->data['IvrMenuFile']['file_exit'] = $this->data['IvrMenu']['file_exit'];
	$this->data['IvrMenuFile']['file_invalid'] = $this->data['IvrMenu']['file_invalid']; 

	$this->data['IvrMenu']['file_long']= false;
	$this->data['IvrMenu']['file_short']= false;
	$this->data['IvrMenu']['file_exit']= false;
	$this->data['IvrMenu']['file_invalid']= false;


          //Save text based form data


                foreach($this->data['Mapping'] as $key => $entry){


                if($entry['type']){

                   switch($entry['type']){

                    case 'node':
	            $this->data['Mapping'][$key]['lam_id']= false;
	            $this->data['Mapping'][$key]['ivr_id']= false;

                    break;

                    case 'lam':
	            $this->data['Mapping'][$key]['node_id']= false;
	            $this->data['Mapping'][$key]['ivr_id']= false;
	            $this->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['lam_id'],'lam');                
                    break;

                    case 'ivr':
	            $this->data['Mapping'][$key]['lam_id']= false;
	            $this->data['Mapping'][$key]['node_id']= false;
	            $this->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['ivr_id'],'ivr');                
                    break;

                   }

                  } else {

	            $this->data['Mapping'][$key]['lam_id']= false;
	            $this->data['Mapping'][$key]['node_id']= false;
	            $this->data['Mapping'][$key]['instance_id']= false;
	            $this->data['Mapping'][$key]['type']= false;


                  }

                }


        if ($this->IvrMenu->saveAll($this->data )){


	   //Retrieve id of saved poll
	   $id = $this->IvrMenu->getLastInsertId();

		foreach($this->data['IvrMenuFile'] as $key => $file){


			if ($file['size']){
				$file['fileName'] = $key;
				$fileData[]       = $file;
			} elseif ($file['error']==1 && !$file['size']) {
       	       		   $this->_flash(__('File upload failure (filesize exceeds maximum)',true).' : '.$file['name'], 'error');                           	
		       	   
			   }			  		   
		   }

                 if(isset($fileData)){

	          //Upload one or more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].$instance_id."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);


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

      	$this->pageTitle = 'Language Selector : Add';           
	

        $ivr_settings = Configure::read('IVR_SETTINGS');
        $ivr_default  = Configure::read('IVR_DEFAULT');

     
        if (empty($this->data)){

	   $this->render();

        }  else {

         //Form data exists. Validate and save form data

        //Get instance id
        $instance_id =$this->IvrMenu->nextInstance();
	$this->data['IvrMenu']['instance_id']= $instance_id;

        //Make dir structure for new IVR
        $this->IvrMenu->makeDir($instance_id);

	$this->data['IvrMenuFile']['file_long'] = $this->data['IvrMenu']['file_long'];
	$this->data['IvrMenuFile']['file_invalid'] = $this->data['IvrMenu']['file_invalid']; 
	$this->data['IvrMenu']['file_long']= false;
	$this->data['IvrMenu']['file_invalid']= false;


          //Save text based form data


                foreach($this->data['Mapping'] as $key => $entry){

                if($entry['id']){

                   switch($entry['type']){

                    case 'node':
	            $this->data['Mapping'][$key]['lam_id']= false;
	            $this->data['Mapping'][$key]['ivr_id']= false;

                    break;

                    case 'lam':
	            $this->data['Mapping'][$key]['node_id']= false;
	            $this->data['Mapping'][$key]['ivr_id']= false;
	            $this->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['lam_id'],'lam');                
                    break;

                    case 'ivr':
	            $this->data['Mapping'][$key]['lam_id']= false;
	            $this->data['Mapping'][$key]['node_id']= false;
	            $this->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['ivr_id']);                
                    break;

                   }

                  } else {

	            $this->data['Mapping'][$key]['lam_id']= false;
	            $this->data['Mapping'][$key]['node_id']= false;
	            $this->data['Mapping'][$key]['instance_id']= false;
	            $this->data['Mapping'][$key]['type']= false;


                  }

                }


        if ($this->IvrMenu->saveAll($this->data )){


	   //Retrieve id of saved poll
	   $id = $this->IvrMenu->getLastInsertId();

		foreach($this->data['IvrMenuFile'] as $key => $file){


			if ($file['size']){
				$file['fileName'] = $key;
				$fileData[]       = $file;
			} elseif ($file['error']==1 && !$file['size']) {
       	       		   $this->_flash(__('File upload failure (filesize exceeds maximum)',true).' : '.$file['name'], 'error');                           	
		       	   
			   }			  		   
		   }

                 if(isset($fileData)){

	          //Upload one or more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].$instance_id."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);


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
		$this->data = $this->IvrMenu->findById($id);


        	$this->set(compact('nodes','lam','voicemenu'));
		$this->render();

          }



	  //Save submitted data.
	  else {


		foreach($this->data['IvrMenuFile'] as $key => $file){

			if ($file['error']==1 && !$file['size']) {
                       	        $this->_flash(__('File upload failure (filesize exceeds maximum)',true).' : '.$file['name'], 'error');                           
			   
		        } elseif ($file['size']) {
				$file['fileName'] = $key;
				$fileData[]       = $file;
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
                                           $field = $fileData[$key]['fileName'];
   
                                           $this->IvrMenu->saveField($field,$name);
					   $this->_flash(__('Success',true).' : '.$fileOK['original'][$key], 'success');							
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



                foreach($this->data['Mapping'] as $key => $entry){

                    if (!$entry[$entry['type'].'_id'] ) {

                    unset($this->data['Mapping'][$key]);

                    } else {

                   switch($entry['type']){

                    case 'node':
	            $this->data['Mapping'][$key]['lam_id']= false;
	            $this->data['Mapping'][$key]['ivr_id']= false;
	            $this->data['Mapping'][$key]['instance_id']= false;
                    break;

                    case 'lam':
	            $this->data['Mapping'][$key]['node_id']= false;
	            $this->data['Mapping'][$key]['ivr_id']= false;
	            $this->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['lam_id'],'lam');                
                    break;

                    case 'ivr':
	            $this->data['Mapping'][$key]['lam_id']= false;
	            $this->data['Mapping'][$key]['node_id']= false;
	            $this->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['ivr_id']);                
                    break;

                   }
                  } 

                }



         $this->IvrMenu->saveAll($this->data);

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
            $this->data = $this->IvrMenu->read();
            $instance_id = $this->IvrMenu->getInstanceID($id); 


             //IVR is not active -> delete
             if (!$this->isActive($id,'ivr')){


                //Delete action OK -> success flash
                if($id && $instance_id && $settings['path']){

                       $dir = WWW_ROOT.$settings['path'].$instance_id;         
                       $this->delete_dir($dir);

                       if ($result = $this->IvrMenu->deleteIVR($id,$instance_id)){

                          $this->_flash(__('The selected entry has been deleted.',true),'success');
                   
                       }

                }
             
                //LAM is active -> warning flash
                } else {

                  $this->_flash(__('The selected entry could not be deleted since it is a member of another Voice Menu.',true),'warning');
            
                }


           } else {
   
              $this->_flash(__('No entry with this id exist. Please try again.',true),'error');

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


/*
 *
 * List all IVR (Language selectors
 *
 *
 */

   function selectors(){

      	$this->pageTitle = __('Language Selectors',true);           
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

      	$this->pageTitle = 'Language Selector : Edit';           

            $settings = Configure::read('IVR_SETTINGS');


   	    //Invalid id
	  if (!$id && empty($this->data)){

	     $this->_flash(__('Invalid option', true),'warning'); 
  	     $this->log("WARNING; Action: Edit; Type: Incorrect id (".$id.")", "switcher");	
	     $this->redirect(array('action'=>'selector')); 
	  }


	  //No submitted form data. Fetch data from db and display
    	  elseif(empty($this->data['IvrMenu'])){


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
		$this->data = $this->IvrMenu->findById($id);
		$this->render();


          }


	  //Save submitted data.
	  else {


		   foreach($this->data['SwitcherFile'] as $key => $file){
			if ($file['size']){
				$file['fileName'] = $key;
				$fileData[]       = $file;
			}  elseif ($file['error']==1 && !$file['size']) {
			        $this->log("ERROR; Action: Upload file; Type: filesize (".$file['size'].")", "switcher");								
                                $this->_flash(__('The following file could not be uploaded due to file size restrictions',true).': '.$file['name'],'error');			
		        }		  
		   }
		 
                    //If file(s) exists -> upload 
                    if(isset($fileData)){
                        
                         $fileOK = $this->uploadFiles($settings['path'].$this->data['IvrMenu']['instance_id'].'/'.$settings['dir_menu'], $fileData ,false,'audio',true,true);

                        //If file upload OK -> save to database		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

					   $this->_flash(__('Success',true).' : '.$fileOK['original'][$key], 'success');							
					   $this->log("INFO; Action: Edit switcher; Type: ".$url, "switcher");


                                           $filename = $this->getFilename($fileOK['files'][$key]);
					   $name= $fileData[$key]['name'];
                                           $part = strstr($filename,'_');
   			                   $field=substr($part,1,strlen($part));
                                           $this->IvrMenu->saveField($field,$name);


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


                     if($this->data['Mapping']){ 

                         
	                 $this->data['IvrMenu']['switcher_type'] = $this->data['Mapping'][0]['type'];

                         foreach($this->data['Mapping'] as $key => $entry){

                            if (!$entry[$entry['type'].'_id'] ) {

                                unset($this->data['Mapping'][$key]);

                            } else {

                              switch($entry['type']){

                              case 'node':
	                      $this->data['Mapping'][$key]['lam_id']= false;
	                      $this->data['Mapping'][$key]['ivr_id']= false;
                              break;

                              case 'lam':
	                      $this->data['Mapping'][$key]['node_id']= false;
	                      $this->data['Mapping'][$key]['ivr_id']= false;
	                      $this->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['lam_id'],'lam');                
                              break;

                              case 'ivr':
	                      $this->data['Mapping'][$key]['lam_id']= false;
	                      $this->data['Mapping'][$key]['node_id']= false;
	                      $this->data['Mapping'][$key]['instance_id']= $this->IvrMenu->getInstanceID($entry['ivr_id'],'ivr');                
                              break;
                             
                              }
                            }
                          }
                      }


         $this->IvrMenu->saveAll($this->data);
	 $this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   
	 $this->IvrMenu->writeIVR($id);
	 $this->IvrMenu->writeIVRCommon();

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


   $service = $this->data['IvrMenu']['switcher_type'];


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