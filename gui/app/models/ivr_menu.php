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


class IvrMenu extends AppModel{

      var $name = 'IvrMenu';

      var $hasMany = array('Node');

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
    function setParent($id){

	 $count = $this->find('count', array('conditions' => array('IvrMenu.parent' => '1')));     

	 if (!$count){

	 $this->unbindModel(array('hasMany' => array('Node')));   
	 $this->saveField('parent', 1);

	 }    	 

	 return true;
	 }


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
 * Write IVR xml file (curl_xml)
 * All existing IVRs for an instance is written. The default IVR is set to parent.
 *
 */
     function writeIVR(){


	$data = $this->query("select * from ivr_menus where instance_id=100 order by parent desc");

	//Instanciate class	
	 $obj = new ivr_xml();	       

	 //Create header
	$obj->ivr_header();      

	//write each IVR
	foreach($data as $key => $ivr){

	      $ivr = $ivr['ivr_menus'];

	      //Create xml menu
	      $obj->write_menu($ivr);

	      for($i=1;$i<=9;$i++){
	      
		$type ='option'.$i.'_type';
		$id   ='option'.$i.'_id';

		if ($ivr[$type]=='node' && $ivr[$id]){ 
		      $obj->write_entry($ivr[$type],$ivr[$id],$i,$key,$ivr['title'],$ivr['file_invalid']);
		   } elseif ($ivr[$type] =='lam') {
		      $obj->write_entry($ivr[$type],$ivr[$id],$i,$key,$ivr['title'],$ivr['file_invalid']);
		   }
	      }
	      $obj->write_entry_common($key);
	  
	    }

    	    //Write to file
	    $obj->write_file();
	    $obj->close_file();

      }	    

      function customizeSave($data){

      	   for($i=1;$i<=8;$i++){
		unset($type);
		unset($id);
		$id   = 'option'.$i.'_id';
		$type = 'option'.$i.'_type';
		if ($data['IvrMenu'][$type] == 'lam'){
		   $data['IvrMenu'][$id]='';
		}
      
	}

        $this->save($data);


	return true;

      }



/*
 * Provides next idle $instance_id
 *  
 *
 * @return array(int $id, int $instance_id)
 *
 */
    function nextInstance($ivr_type){

     	    $ivr_settings = Configure::read('IVR_SETTINGS');

	    $this->unbindModel(array('hasMany' => array('Node')));   
            $data =  $this->findAll();


          //IVR entries exist  
          if ($data){

                   //Collect all occupied instance_id into $taken[] 
                   foreach ($data as $key => $entry){
                           $taken[] = $entry['IvrMenu']['instance_id'];
                   }
            

                   $next = false;
                   $id = false;

                   //Loop through all possible (idle/occupied) instance_id, select the first idle one

                         for ($i = $ivr_settings['instance_min']; $i<= $ivr_settings['instance_max'] ; $i++){

                             if(!in_array($i,$taken) && !$next){
                                  $next = $i;
                                  $this->set('instance_id',$next);
                                  $this->set('ivr_type',$ivr_type);

                                  switch($ivr_type){

                                  case 'ivr':

                                  $this->set('switcher_type',false);
                                  $this->set('title','IVR '.$next);
                                  $this->set('option1_type','node');
                                  $this->set('option2_type','node');
                                  $this->set('option3_type','node');
                                  $this->set('option4_type','node');
                                  $this->set('option5_type','node');
                                  $this->set('option6_type','node');
                                  $this->set('option7_type','node');
                                  $this->set('option8_type','node');
                                  $this->set('option9_type','node');
                                  break;

                                  case 'switcher':
                                  $this->set('switcher_type','ivr');
                                  $this->set('title','SWITCHER '.$next);
                                  break;

                                  }

                                  $this->save();
	                          $id = $this->getLastInsertId();

                                  
                              }

                 }
            }

            else {


              $next = $ivr_settings['instance_min'];
              $this->set('instance_id',$next);
              $this->save();
	      $id = $this->getLastInsertId();


            }


            return array('id'=>$id,'instance_id'=>$next);


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
  
      function getInstanceID($id){

               $this->unbindModel(array('hasMany' => array('Node')));      
               $data = $this->findById($id);
               return $data['IvrMenu']['instance_id'];
      }



/*
 * deleteIVR: Deletes IVR with $id
 *
 * @param int $id
 * @return boolean $result 
 *
 */
    
    function deleteIVR($id){

           $this->unbindModel(array('hasMany' => array('Node')));
   
    	   if($this->delete($id,true)){

		   $this->log("Msg: INFO; Action: IVR deleted; Id: ".$id."; Code: N/A", "ivr");
                   return true;

           } else {

                  return false;

           }

      }

}

?>
