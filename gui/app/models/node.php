<?php
/****************************************************************************
 * node.php	- Model for nodes (aka 'Menu options') used to compose IVRs (aka Voice menus).
 * version 	- 1.0.353
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

      var $validate = array(
        'title' => array(
            'rule'     => array('minLength', 3),
	    'required' =>  true,
            'message'  => 'A title is required. Minimum 3 characters.' ));



	    function deleteAudio($file, $path, $extensions){

    	    $name=substr($file,0,strlen($file)-3);

	    foreach ($extensions as $ext){

	    	     $unlink=$path.$name.$ext;
	     	     unlink(WWW_ROOT.$unlink);

		     }

	   }


	   function isActive($id){


	  $data = $this->query("select * from ivr_menus where option1_id= $id or option2_id=$id or option3_id=$id or option4_id=$id or option5_id=$id or option6_id=$id or option7_id=$id or option8_id=$id or option9_id=$id");

	   if (sizeof($data)){
	      return true;
	      }

	      else {
	      return false;
	      }

	   }


    function getTitle($id){

    $data = $this->findById($id);
    return $data['Node']['title'];     
    }


}

?>
