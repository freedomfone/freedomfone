<?php

class LmMenusController extends AppController{

	var $name = 'LmMenus';
	var $helpers = array('Flash','Session');      

	function settings() {

        

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
			}
		   
		   }

		     //Upload one ore more wav files
		       $fileOK = $this->uploadFiles($lm_settings['path'].IID."/".$lm_settings['dir_menu'], $fileData ,false,'wav',true,true);
		      


	     		$this->data['LmMenu']['instance_id']=$iid;
                         $this->LmMenu->id = $this->data['LmMenu']['id'];


			if ($this->LmMenu->save($this->data['LmMenu'])) {
					
			if(array_key_exists('urls', $fileOK)) {


				   foreach ($fileOK['urls'] as $url ){

	               	 	   	   $this->wav2mp3($url);			
					   $this->log("Msg: NEW MENU AUDIO FILE; File: ".$url, "leave_message");
				   }
					
				}

				elseif(array_key_exists('errors', $fileOK)) {

				   foreach ($fileOK['errors'] as $error ){
				   	   $this->log("Msg: UPLOAD  ERROR, Error: ".$error, 'leave_message');	
				  	   
				    }
				}




		               $this->Session->setFlash(__('Your data has been saved',true));							
			       //$this->redirect(array('action'=>'settings'));


			}
			else {
			
				$this->Session->setFlash(__('Your data could not be saved. Please, try again.',true));
			}
		}
		


		if (empty($this->data)) {


		       $this->set(compact($lm_settings));
		       $this->data = $this->LmMenu->find('first', array('conditions' => array('instance_id' => $iid)));

		}


	}


}
?>
