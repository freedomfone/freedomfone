<?php


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
