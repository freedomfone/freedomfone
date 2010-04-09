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


				$lang = $this->data['Setting']['language'];
				$id = $this->data['Setting']['id'];
				
				$this->data['Setting']['id']=$id; 
				$this->data['Setting']['value_string']=$lang; 

				$this->Setting->set( $this->data );
				$this->Setting->save();

				Configure::write('Config.language', $lang);
				$this->Session->write('Config.language', $lang);
		 
		}

		$data = $this->Setting->findByName('language');
 		$this->set(compact('data'));
		$this->render();		
	}

}
?>
