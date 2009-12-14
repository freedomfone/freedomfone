<?php
echo $javascript->link("addHTMLControls.js", true); 
$session->flash();
echo "<h1>".__("Create Menu Option",true)."</h1>";

echo $form->create('Node', array('type' => 'post', 'action' => 'add','enctype' => 'multipart/form-data') );


echo "<table>";
echo $html->tableCells(array (
     array(__("Title",true),	$form->input('title',array('label'=>false,'size' =>'50')))));


echo $html->tableCells(array (
     array(__("Audio file",true),	$form->input('file',array('label'=>false,'type'=>'file'))),
     array(array(__("Valid format: wav",true),"colspan='2' class='formComment'"))));


echo "</table>";
echo $form->end('Save');



?>

