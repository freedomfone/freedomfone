<?php
/****************************************************************************
 * lm_menu.php		- Model for Leave-a-message IVR menu.
 * version 		- 1.0.353
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

class LmMenu extends AppModel {

	var $name = 'LmMenu';
	


    function beforeSave(){

    //DEMO FIX
    if($this->data['LmMenu']['id']!=1){

    	$lm_default  = Configure::read('LM_DEFAULT');
     	$lm_settings = Configure::read('LM_SETTINGS');

	    $handle = fopen($lm_settings['path'].IID."/conf/".IID.".conf","w");

    	    foreach ($lm_default as $key => $default){


	    	    $text = $this->data['LmMenu'][$key];
	    	    if (!$text){
		       $text = $default;
		    }
    	    	    $line = "var ".$key." = \"".$text."\";\n";
	    	    fwrite($handle, $line);

	    }
	    
	    fclose($handle);

	    }

    return true;
    }

   // DEMO FIX
    function demoReset(){


        $lm_default  = Configure::read('LM_DEFAULT');

            $data = file("http://localhost/freedomfone/app/webroot/defaults/lm/conf/100.conf");

            foreach($data as $line){

            $_line = explode(";",$line);

            $this->data['LmMenu'][$_line[0]]= $_line[1];

            }
            $this->data['LmMenu']['id']= 1;

            $this->updateAll($this->data['LmMenu']);
    return true;
    }


}
?>
