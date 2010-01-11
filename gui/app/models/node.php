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
            'rule'     => array('minLength', 3),
	    'required' =>  true,
            'message'  => __('A title is required. Minimum 3 characters.',true)));

}

/*
 * Delete audio files (with several extensions)
 *  
 * @param string $file, string $path, string $extensions
 *
 */

     function deleteAudio($file, $path, $extensions){

    	    $name=substr($file,0,strlen($file)-3);

	    foreach ($extensions as $ext){

	    	     $unlink=$path.$name.$ext;
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
