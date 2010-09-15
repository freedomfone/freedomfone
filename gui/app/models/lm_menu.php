<?php
/****************************************************************************
 * lm_menu.php		- Model for Leave-a-message IVR menu.
 * version 		- 1.0.359
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
	


/*
 * Before save: Writes fallback text messages to file
 *  
 *
 * @return boolean
 *
 */

    function beforeSave(){

    	$lm_default  = Configure::read('LM_DEFAULT');
     	$lm_settings = Configure::read('LM_SETTINGS');
        $iid = $this->data['LmMenu']['instance_id'];

	    $handle = fopen($lm_settings['path'].$iid."/conf/".$iid.".conf","w");

    	    foreach ($lm_default as $key => $default){

                if(array_key_exists($key , $this->data['LmMenu'])){
            
	    	    $text = $this->data['LmMenu'][$key];
                 
                    if($key == 'lmForceTTS'){

                      if(!$text) {
    	    	        $line = "var ".$key." = false;\n";
                       } else {
                        $line = "var ".$key." = true;\n";
                       }
                     } else {

	    	    if (!$text){
		       $text = $default;
		    }

    	    	    $line = "var ".$key." = \"".$text."\";\n";
	    	   
                    }
                    fwrite($handle, $line);

                } //if key exists	
    }
	    
	    fclose($handle);

    return true;
    }

    function nextInstance(){

     	    $lm_settings = Configure::read('LM_SETTINGS');
            $data =  $this->findAll();
            foreach ($data as $key => $entry){
                    $taken[] = $entry['LmMenu']['instance_id'];
            }

            $next = false;
            $id = false;

            for ($i = $lm_settings['instance_min']; $i<= $lm_settings['instance_max'] ; $i++){

                if(!in_array($i,$taken) && !$next){
                        $next = $i;
                        $this->set('instance_id',$next);
                        $this->save();
	                $id = $this->getLastInsertId();
                        break;
                }

            }

            return array('id'=>$id,'instance_id'=>$next);


      }

    


}
?>
