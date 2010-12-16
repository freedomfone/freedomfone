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

	      //Fetch form data and process
              if (!empty($this->data)) {
				
		  if(array_key_exists('Setting', $this->data)){
		     $ip_radio = $this->data['Setting']['ip_radio'];
		     unset($this->data['Setting']);
		     }

		      $i=false;	
		 foreach ($this->data as $id => $entry){


		 if ($id==1){ $lang = $entry['value'];}
		 if ($id==6){ $timezone = $entry['value'];}

		 //IP address
		 if ($id==5 ) {

		     if ( !isset($entry['value'])){
		        $entry['value'] = $ip_radio;
		     }
		     $ip_addr = $entry['value'];
		     
		 }

		 $data[$id]= array('id'=>$id,'value_string'=>$entry['value']);

		 }

		 $data= array('Settings' => $data);

	           Configure::write('Config.language', $lang);
                   $this->Session->write('Config.language', $lang);         
             
                   Configure::write('Config.timezone', $timezone); 
                   $bool = date_default_timezone_set(Configure::read('Config.timezone'));
                   $this->Session->write('Config.timezone', $timezone); 

		   if($this->Setting->validIP($ip_addr)){

		   $file = new File(APP.'/config/ip_addr.php',true);
		   $string = "<?php \$config['Setting']['ip_addr']= '$ip_addr'; ?>";
		   $file->write($string);
		   $file->close();

		   } else {

		   unset($data['Settings'][5]);
		   $this->_flash(__('Invalid IP address. Please try again.',true),'error');
		   }

		   $this->Setting->saveAll($data['Settings']);															            

		}
		 
              //Display form data               

	      $external = $this->Setting->getIP('external');
	      $internal = $this->Setting->getIP('internal');

	      $this->set('data',$this->Setting->findAllByType('env'));
 	      $this->set(compact('external','internal'));
	      $this->render();       
         
	 }

}
?>
