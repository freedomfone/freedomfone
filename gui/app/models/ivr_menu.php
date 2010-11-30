<?php
/****************************************************************************
 * ivr_menu.php		- Model for IVRs (aka 'Voice menus') Manages updates of default IVR (aka 'parent').
 * version 		- 1.0.360
 * 
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either expres or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 *
 * The Initial Developer of the Original Code is
 *   Louise Berthilson <louise@it46.se>
 *
 *
 ***************************************************************************/


class IvrMenu extends AppModel{

      var $name = 'IvrMenu';

      var $hasMany = array('Mapping');	



function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

	$this->validate = array(
        'title' => array(
                        'minLength' => array(
                                        'rule'     => array('minLength', 3),
                                        'required' =>  true,
                                        'message'  => __('A title is required. Minimum 3 characters.',true)
                                        )),
      'message_long' => array(
                        'validText' => array(
                                       'rule' => array('validText','message_long'),
                                       'message' => __('No hyperlinks allowed.',true)
                                       )),
      'message_short' => array(
                        'validText' => array(
                                       'rule' => array('validText','message_short'),
                                       'message' => __('No hyperlinks allowed.',true)
                                       )),
      'message_invalid' => array(
                        'validText' => array(
                                       'rule' => array('validText','message_invalid'),
                                       'message' => __('No hyperlinks allowed.',true)
                                       )),
      'message_exit' => array(
                        'validText' => array(
                                       'rule' => array('validText','message_exit'),
                                       'message' => __('No hyperlinks allowed.',true)
                                       )),

      'file_long' => array(
                        'validFileSize' =>array(
								'rule' => array('validFileSize','file_long'),
                                        'message' => __('The file size exceeds the maximum limit (10MB).',true),
						     	     	  )),
      'file_short' => array(
                        'validFileSize' =>array(
                                        'rule' => array('validFileSize','file_short'),
                                        'message' => __('The file size exceeds the maximum limit (10MB).',true),
                                        )),
      'file_exit' => array(
                        'validFileSize' =>array(
                                        'rule' => array('validFileSize','file_exit'),
								'message' => __('The file size exceeds the maximum limit (10MB).',true),
                                        )),
      'file_invalid' => array(
                        'validFileSize' =>array(
                                        'rule' => array('validFileSize','file_invalid'),
								'message' => __('The file size exceeds the maximum limit (10MB).',true),
                                        )),

                                        );



}

 function validText($data,$field)
    {

    $blacklist = array('href','url=','http');

    $status = true;
    foreach($blacklist as $string){
        if(stripos($data[$field],$string)){
          $status =false;
        }
    }
    return $status;
    }


 function validFileSize($data,$field)
    {
    if($data[$field]!=1){ return true;}
    else { return false;}

    }

 function validFileType($data)
    {

	$type = $data['file_long_type'];

	//allowed file types
	$types = array('audio/x-wav','audio/wav','audio/mpeg');

	if(in_array($type,$types)){ return true;}
	else { return false;}

   }

/*
 * Check if parent exist. If not, set current to parent
 * 
 *
 */
/*    function setParent($id){

	 $count = $this->find('count', array('conditions' => array('IvrMenu.parent' => '1')));     

	 if (!$count){

	 $this->unbindModel(array('hasMany' => array('Node')));   
	 $this->saveField('parent', 1);

	 }    	 

	 return true;
	 }*/


/*
 * 
 * Check if any IVR entry exists
 * 
 * @return bool 
 *
 */

	function lastIVR(){

	 $total = $this->find('count');

	 if ($total){
	    return false;
	    }

	    else {
	    return true;
	    }

}

/*
 * Update parent status of IVR menus. 
 * update ivr_menus set status = 0;
 * update ivr_menus set status = 1 where id = $id
 *
 */
    function updateParent(){
    
    	     $this->updateAll(array('IvrMenu.parent' => 0));
    	     $this->saveField('parent', 1);
    }


/*
 * Check if IVR is parent
 * return true| false
 *
 */
    function isParent($id){

	 $this->unbindModel(array('hasMany' => array('Node')));   
    	 $data = $this->findByParent(1);     
    	 
	 if($data['IvrMenu']['id']==$id){
	    return 1;
	  }
	   else {
	    return 0;
	  }
    	    
    }



/**
 * Fetch next IVR that is not parent(order by id)
 * return $id 
 *
 */
    function nextEntry(){

    $this->unbindModel(array('hasMany' => array('Node')));      
    $data= $this->find('first', array('conditions' => array('IvrMenu.instance_id' => IID)));
    $id = $data['IvrMenu']['id'];

    return $id;

    }


/**
 * Set parent flag =1 of selected IVR
 * update ivr_menus set parent = 1 where id = $id
 *
 */
    function setNewParent(){

    $this->unbindModel(array('hasMany' => array('Node')));   
    $this->saveField('parent',1);

    }


/**
 * Write IVR xml file for selected ivr (/webroot/freedomfone/ivr/{instance_id}/conf/ivr.xml)

 * @params int $id: id of ivr
 *
 */
     function writeIVR($id){

        $data = $this->findById($id);
        $instance_id = $data['IvrMenu']['instance_id'];

	//Instanciate class	
	$obj = new ivr_xml($instance_id);	       

	//Create header
	$obj->ivr_header();      

	switch ($data['IvrMenu']['ivr_type']){

	       case "ivr":

	       $obj->write_ivr_menu($data);
               break;

	       case "switcher":

	       $obj->write_switcher_menu($data);
               break;

        }

       foreach($data['Mapping'] as $key => $entry){

                        $ivr_type = $data['IvrMenu']['ivr_type'];	      
                        $type = $entry['type'];
                        $digit = $entry['digit'];
	                $id   = $entry[$type.'_id'];        
                        $instance_id =  $entry['instance_id'];

		      	$obj->write_ivr_entry($ivr_type, $type, $digit, $id, $instance_id, $data['IvrMenu']['title'] , $data['IvrMenu']['file_invalid'] );

		}
       
       $obj->write_entry_common(0);

        //Write to file
	$obj->write_file_individual();
	
		 

    }



/* Composes ivr.xml (/webroot/xml_curl/ivr.xml) based on all existing IVR menus
 *  
 *
 */
      function writeIVRCommon(){

	//Instanciate class	
	$obj = new ivr_xml();	       

	//Create header
	//$obj->ivr_header();      

        $ivr_settings = Configure::read('IVR_SETTINGS');
           
        $data =  $this->find('all');

          foreach ($data as $key => $entry){
          
                  $instance_id = $entry['IvrMenu']['instance_id'];
                  $filename[]	   = WWW_ROOT.$ivr_settings['path'].'/'.$instance_id.'/'.$ivr_settings['dir_conf']."/ivr.xml";         

          }

        //Write one or more individual Menus to the common ivr.xml
        $obj->write_menu($filename);

      }	    




/*
 * Provides next idle $instance_id
 *  
 *
 * @return int $instance_id
 *
 */
    function nextInstance(){

     	    $ivr_settings = Configure::read('IVR_SETTINGS');

	    $this->unbindModel(array('hasMany' => array('Node')));   
            $data =  $this->findAll();

            $i = $ivr_settings['instance_start'];
            $instance_id = false;

            //IVR entries exist  
            if ($data){

                   //Collect all occupied instance_id into $taken[] 
                   foreach ($data as $key => $entry){
                           $taken[] = $entry['IvrMenu']['instance_id'];
                   }
            
                   while(!$instance_id){

                        if(!in_array($i,$taken)){

                           $instance_id = $i;

                        }

                        $i++;

                   }

                   return $instance_id;

            } else {

              return $i;

            }
                
      }


/*
 * makeDir: Create directory for new IVR instance
 *
 * @param string int $instance_id
 * @return boolean result
 *
 */

        function makeDir($instance_id){

        $ivr_settings = Configure::read('IVR_SETTINGS');

                 $old = umask(0);

                 $dir_root =  WWW_ROOT.$ivr_settings['path'].'/'.$instance_id;
                 $dir_conf =  $dir_root.'/conf';
                 $dir_ivr =   $dir_root.'/ivr';

                 if(!is_dir($dir_root)){

                       $status =  mkdir($dir_conf,0755,true);
                       
                       if($status){
                        
                        mkdir($dir_ivr, 0755,true);
                        umask($old); 
                        return true;

                        } else {
 
                       return false;

                        }

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
      function deleteDirXZXX($instance_id){

          $dir = WWW_ROOT.$settings['path'].$instance_id.'/'.$settings['dir_menu'];

          $handle=opendir($dir);
          $result = true;



          if($dir && $handle){
               while (($file = readdir($handle))!==false) {
               
                        if(is_file($dir.'/'.$file)){
                    
                               $result = unlink($dir.'/'.$file);

                       }
               }
	       $this->log("Msg: INFO; Action: IVR audio files deleted; Dir: ".$dir."; lam");
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
  
      function getInstanceID($id, $type = null){

       if ($type == 'lam'){

          $data = $this->query('select instance_id from lm_menus where id = '.$id);
          return $data[0]['lm_menus']['instance_id'];

        } else {
               $this->unbindModel(array('hasMany' => array('Node')));      
               $data = $this->findById($id);
               return   $data['IvrMenu']['instance_id'];

       }

      }



/*
 * deleteIVR: Deletes IVR with $id
 *
 * @param int $id
 * @return boolean $result 
 *
 */
    
    function deleteIVR($id, $instance_id){


        $settings = Configure::read('IVR_SETTINGS');

         if($id && $instance_id){

          $dir = WWW_ROOT.$settings['path'].$instance_id;
         
          $this->deleteDir($dir);

           //FIXME: delete all mapping to the IVR
           /* foreach($this->data['Mapping'] as $key => $mapping){

    	   $this->Mapping->delete($mapping['id']);

           }*/

//    	   $this->Mapping->deleteAll(array('Mapping.ivr_menu_id' => $id),true);
   
    	   if($this->deleteAll($id,true)){

		   $this->log("Msg: INFO; Action: IVR deleted; Id: ".$id."; Code: N/A", "ivr");
                   return true;

           } else {

                  return false;

           }
           } else{


           return false;

           }

      }



      function deleteDir($directory ){

               if(substr($directory,-1) == "/") {
                      $directory = substr($directory,0,-1);
                }

                if(!file_exists($directory) || !is_dir($directory)) {
                           return false;
                } elseif(!is_readable($directory)) {
                          return false;
                } else {
                          $directoryHandle = opendir($directory);
       
                while ($contents = readdir($directoryHandle)) {
                      if($contents != '.' && $contents != '..') {
                                   $path = $directory . "/" . $contents;
              
                        if(is_dir($path)) {
                             deleteDir($path);
                        } else {
                        unlink($path);
                        }
                      }
                }
       
                closedir($directoryHandle);

                if($empty == false) {
                          if(!rmdir($directory)) {
                          return false;
                          }             
                }
       
                return true;
              }
     } 



}

?>
