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

        var $hasMany = array('Mapping');	


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

/*
 * Provides next idle $instance_id
 *  
 *
 * @return array(int $id, int $instance_id)
 *
 */
    function nextInstance(){

     	    $lm_settings = Configure::read('LM_SETTINGS');
            $data =  $this->findAll();

          //LAM entries exist  
          if ($data){

                   //Collect all occupied instance_id into $taken[] 
                   foreach ($data as $key => $entry){
                           $taken[] = $entry['LmMenu']['instance_id'];
                   }
            

                   $next = false;
                   $id = false;

                   //Loop through all possible (idle/occupied) instance_id, select the first idle one


                         for ($i = $lm_settings['instance_min']; $i<= $lm_settings['instance_max'] ; $i++){

                             if(!in_array($i,$taken) && !$next){
                                  $next = $i;
                                  $this->set('instance_id',$next);
                                  $this->save();
	                          $id = $this->getLastInsertId();

                                  
                              }

                 }
            }

            else {


              $next = $lm_settings['instance_min'];
              $this->set('instance_id',$next);
              $this->save();
	      $id = $this->getLastInsertId();


            }


            return array('id'=>$id,'instance_id'=>$next);


      }


/*
 * deleteLAM: Deletes LAM with $id, and unlinks associated audio files.
 *
 * @param int $id
 * @return boolean $result 
 *
 */
    
    function deleteLAM($id){



	   //Delete LAM
    	   if($this->delete($id,true)){

		   $this->log("Msg: INFO; Action: LAM deleted; Id: ".$id."; Code: N/A", "lam");
		   //
                   return true;

           } else {

           return false;

           }

      }

/*
 * emptyDir: Delete all files in the given directory 
 *
 * @param string $dir
 * @return boolean result
 *
 */
      function emptyDir($dir){

          $handle=opendir($dir);
          $result = true;

          if($dir && $handle){
               while (($file = readdir($handle))!==false) {
               
                        if(is_file($dir.'/'.$file)){
                    
                               $result = unlink($dir.'/'.$file);

                       }
               }
	       $this->log("Msg: INFO; Action: LAM audio files deleted; Dir: ".$dir."; lam");
               closedir($handle);

           }
               return $result;
      }




/*
 * getInstanceID: Return instance id corresponsing to $id
 *
 * @param int $id
 * @return int $instance_id
 *
 */
  
      function getInstanceID($id){

               $data = $this->findById($id);

               return $data['LmMenu']['instance_id'];
      }




/*
 * restoreConf: Restore LAM conf file with default text messages.
 *
 * @param string $instance_id
 * @return boolean $result
 *
 */

     function restoreConf($instance_id){

     	$lm_default  = Configure::read('LM_DEFAULT');
     	$lm_settings = Configure::read('LM_SETTINGS');

        if(($handle = fopen($lm_settings['path'].$instance_id.'/'.$lm_settings['dir_conf'].'/'.$instance_id.'.conf','w')) === false) { 
  
                return false;

        } else {

	    //$handle = fopen($lm_settings['path'].$iid."/conf/".$iid.".conf","w");

    	    foreach ($lm_default as $key => $default){
	    	   
    	    	    $line = "var ".$key." = \"".$default."\";\n";
	    	    fwrite($handle, $line);

             }
	    
	  fclose($handle);
          return true;
       }
    }

}
?>
