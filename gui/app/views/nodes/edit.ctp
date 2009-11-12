<?php
$ivr = Configure::read('IVR_SETTINGS');
	if($this->data){

		echo "<h1>".__("Edit voice menu node",true)."</h1>";

      		$path = $ivr['path'].$this->data['Node']['instance_id']."/".$ivr['dir_node'];
		$listen =  $this->element('musicplayer_button',array('path'=>$path,'file'=>$formatting->changeExt($this->data['Node']['file'],'mp3'),'title'=>$this->data['Node']['title']));



		$session->flash();
		echo $form->create('Node', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
		echo $form->input('file_old',array('type'=>'hidden','value'=>$this->data['Node']['file']));

		echo "<table border=0>";

		echo $html->tableCells(array (
     		     array(__("Title",true),	$form->input('title',array('label'=>false,'size'=>'50')))));



		echo $html->tableCells(array (
     		     array(__("Audio file",true),	$form->input('file',array('label'=>false,'type'=>'file'))),
     		     array(array(__("If you select a file, the previous one will be deleted. Valid format: wav",true),"colspan='2' class='formComment'"))));

		echo $html->tableCells(array (
     		     array(__("Listen to uploaded file",true),	$listen)));

		echo "</table>";
		echo $form->end('Save');

		}

	else {
    		echo "<h1>".__("No voice menu node with this id exists",true)."</h1>";
	}


?>

