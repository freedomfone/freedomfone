<?php

	if($this->data){

		echo "<h1>".__("Edit node",true)."</h1>";

		$session->flash();
		echo $form->create('Node', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
		echo $form->input('file_old',array('type'=>'hidden','value'=>$this->data['Node']['file']));

		echo "<table>";
		echo $html->tableCells(array (
     		     array(__("Title",true),	$form->input('title',array('label'=>false)))));
		echo $html->tableCells(array (
     		     array(__("Audio file",true),	$form->input('file',array('label'=>false,'type'=>'file'))),
     		     array(array(__("If you select a file, the previous one will be deleted. Valid format: wav",true),"colspan='2' class='formComment'"))));
		echo "</table>";
		echo $form->end('Save');

		}

	else {
    		echo "<h1>".__("No node with this id exists",true)."</h1>";
	}


?>

