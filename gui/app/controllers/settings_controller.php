<?php
/****************************************************************************
 * settings_controller.php	- Controller for changing global settings
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

class SettingsController extends AppController {

    var $name = 'Settings';

	function index() {
	

      		$this->pageTitle = 'Environment settings';


		//process data
		if (!empty($this->data)) {
		  
		   foreach($this->data as $id => $entry){


		    $data['id'] = $id; 
		    $data[$entry['field']]=$entry['value']; 
 		    $this->Setting->set( $data );
		    $this->Setting->save();
		    unset($data);

		      //Language setting
		      if($id == 1) { 
			  Configure::write('Config.language', $entry['value']);
			  $this->Session->write('Config.language', $entry['value']);		 
  	              }

		      //Timezone setting
		      elseif($id == 6) { 

		      $this->Session->write('Config.timezone', $entry['value']);		 

  	              }
		   }

		$this->redirect(array('action' =>'/')); 

		}

	}

	function env() {
	

      		$this->pageTitle = 'Environment settings';



		
                //Fetch form data and process
		if (!empty($this->data)) {


                  $data = $this->data;		
	    
		  Configure::write('Config.language', $data['Setting']['language']);
		  $this->Session->write('Config.language', $data['Setting']['language']);		 
  	         
		 
                 Configure::write('Config.timezone', $data['Setting']['timezone']);  
                 $bool = date_default_timezone_set(Configure::read('Config.timezone'));
                 

                 $this->Session->write('Config.timezone', $data['Setting']['timezone']);		 

                  $this->Setting->save($data);  		
 


		}

                //Display form data                
		$this->set('data',$this->Setting->find('first'));   
		$this->render();		



	}


}
?>
