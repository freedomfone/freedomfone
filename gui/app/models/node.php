<?php
/****************************************************************************
 * node.php	- Model for nodes (aka 'Menu options') used to compose IVRs (aka Voice menus).
 * version 	- 1.0.359
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


class Node extends AppModel{

      var $name = 'Node';

//      var $belongsTo = array('IvrMenu');

function __construct($id = false, $table = null, $ds = null) {
        parent::__construct($id, $table, $ds);

    $this->validate = array(
      'title' => array(
                        'minLength' => array(
                                       'rule' => array('minLength', 3),
                                       'message' => __('Minimum 3 characters.',true)
                                       ),
                        'isUnique' => array(
                                       'rule' => 'isUnique',
                                       'message' => __('This title is already in use.',true)
                                       ),

                        'validText' => array(
                                       'rule' => array('validText','title'),
                                       'message' => __('No hyperlinks allowed.',true)
                                       )),
      'file' => array(
			'validFileSize' =>array(
					'rule' => array('validFileSize'),
					'message' => __('The file size exceeds the maximum limit (10MB).',true)
					),
			'validFileType' =>array(
					'rule' => array('validFileType'),
					'message' => __('Invalid file type (valid formats: mp3 and wav).',true)
					),
			'validFile' =>array(
					'rule' => array('validFile'),
					'message' => __('No file selected.',true)
					)
					));


}


 function validText($data,$field)
    {

    if(stripos($data[$field],'href')){ return false;}
    else { return true;}

    }

 function validFile($data)    {

    if($data['file']['error']!=4){ return true;}
    else { return false;}
    }


 function validFileSize($data){

    if($data['file']['error']!=1){ return true;}
    else { return false;
    }

    }

 function validFileType($data)
    {

	$type = $data['file']['type'];

	//allowed file types
	$types = array('audio/x-wav','audio/wav','audio/mpeg','audio/mp3');

	if(in_array($type,$types)){ return true;}
	else { return false;}

   }

/*
 * Delete audio files (with several extensions)
 *  
 * @param string $file, string $path, string $extensions
 *
 */

     function deleteAudio($name, $path, $extensions){

    	    //$name=substr($file,0,strlen($file)-3);
	    
	    foreach ($extensions as $ext){

	    	     $unlink=$path.$name.'.'.$ext;
	     	     unlink(WWW_ROOT.$unlink);

		     }

     }


/*
 * Checks if a node is active in an existig IVR.
 *  
 * @param int $id
 * @return bool
 *
 */

      function isActive($id){

	  $data = $this->query("select * from ivr_menus where option1_id= $id or option2_id=$id or option3_id=$id or option4_id=$id or option5_id=$id or option6_id=$id or option7_id=$id or option8_id=$id or option9_id=$id");

	   if (sizeof($data)){
	      return true;
	      } else {
	      return false;
	      }
      }


/*
 * Get node title
 *  
 * @param int $id
 * @return sting $title
 *
 */

    function getTitle($id){

    	     $data = $this->findById($id);
    	     return $data['Node']['title'];     
    }


}

?>
