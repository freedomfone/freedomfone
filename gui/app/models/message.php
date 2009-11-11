<?php
class Message extends AppModel {

	var $name = 'Message';
	


	var $belongsTo = array('Category'); 

	var $hasAndBelongsToMany = array('Tag');



    function getTitle($id){

    $data = $this->findById($id);
    return $data['Message']['title'];     
    }


}
?>