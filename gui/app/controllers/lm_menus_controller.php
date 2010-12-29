<?php
/****************************************************************************
 * lm_menus_controller.php	- Controller for Leave-a-message IVR menu.
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

class LmMenusController extends AppController{

	var $name = 'LmMenus';
	var $helpers = array('Flash','Session','Javascript','Ajax');      


	function demo_reset(){

	 $iid=IID;
	$this->data = $this->LmMenu->find('first', array('conditions' => array('instance_id' => $iid)));
	$this->LmMenu->demoReset();
	$this->redirect(array('action'=>'settings'));
	}

	function settings() {

        $this->pageTitle = 'Leave-a-Message : IVR';           

    	$lm_settings = Configure::read('LM_SETTINGS');

		 $iid=IID;
		 $fileData = array();


		// Invalid entry, or no data exist: redirect to Settings page
		if (!$iid && empty($this->data)) {
			$this->Session->setFlash(__('Invalid Entry', true));
			$this->redirect(array('action'=>'settings'));
		}

		// Data exist, save and redirect to Settings
		if (!empty($this->data)) {

		   foreach($this->data['LmMenuFile'] as $key => $file){
				
			if ($file['size']){
				$file['fileName']=$key;
				$fileData[] = $file;
			} elseif ($file['error']==1 && !$file['size']) {

                       	        $this->_flash(__('File upload failure (filesize exceeds maximum)',true).' : '.$file['name'], 'error');                           

			   }	
		   }

		     //Upload one ore more wav files
		       $fileOK = $this->uploadFiles($lm_settings['path'].IID."/".$lm_settings['dir_menu'], $fileData ,false,'audio',true,true);

	     		$this->data['LmMenu']['instance_id']=$iid;
                        $this->LmMenu->id = $this->data['LmMenu']['id'];

			if ($this->LmMenu->save($this->data['LmMenu'])) {
					
			  if(array_key_exists('urls', $fileOK)) {

				   foreach ($fileOK['urls'] as $key =>  $url ){
					   $this->log("Msg: NEW MENU AUDIO FILE; File: ".$url, "leave_message");
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
			else {
			
				$this->_flash(__('Your data could not be saved. Please, try again.',true),'warning');
			}
		}
		


		if (empty($this->data)) {

		       $this->set(compact($lm_settings));
		       $this->data = $this->LmMenu->find('first');
			
		}


	}


  function download ($id,$message) {

    	Configure::write('debug', 0);

	$this->LmMenu->id = $id;

	$data = $this->LmMenu->read();
	
	$file = 'lm'.$message.'.mp3';
	$name = 'lm'.$message;
	$url  = 'webroot/freedomfone/leave_message/'.IID.'/audio_menu';

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

 function disp($id){


              $lm_settings = Configure::read('LM_SETTINGS');
              $this->set(compact($lm_settings));       
              $this->LmMenu->unbindModel(array('hasMany' => array('Mapping'))); 
              $this->data = $this->LmMenu->findById($id);
              $this->layout = "ajax";

      }



}
?>
