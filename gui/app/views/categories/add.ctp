<?php 
echo "<h1>".__("Add Category",true)."</h1>";

$session->flash();

$options	  = array('label' => false);


echo $form->create('Category',array('type' => 'post','action'=> 'add'));
echo "<table>";

echo $html->tableCells(array (
     array(__("Category",true),	        $form->input('name',$options)),
     array(__("Description",true),	$form->input('longname',$options)),
     array('',	$form->end('Save'))
     ));
echo "</table>";



?>