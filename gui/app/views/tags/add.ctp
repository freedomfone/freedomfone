<?php 
echo "<h1>".__("Add Tag",true)."</h1>";

$session->flash();

$options	  = array('label' => false);


echo $form->create('Tag',array('type' => 'post','action'=> 'add'));
echo "<table>";

echo $html->tableCells(array (
     array(__("Tag",true),	        $form->input('name',$options)),
     array(__("Description",true),	$form->input('longname',$options)),
     array('',	$form->end('Save'))
     ));
echo "</table>";

?>
