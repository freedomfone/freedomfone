<?php 

      if($this->data){

      echo "<h1>".__("Edit Category",true)."</h1>";
      $session->flash();

      $options	  = array('label' => false);
      $options_category = array('type'=>'select','multiple'=>'true','label'=>false,'empty'=>'-- Use in none --');

      echo $form->create('Category',array('type' => 'post','action'=> 'edit'));
      echo "<table>";

      echo $html->tableCells(array (
      	   array(__("Category",true),	        $form->input('name',$options)),
     	   array(__("Description",true),	$form->input('longname',$options)),
     	   array(__("Use in message",true),	$form->input('Message',$options_category)),
     	   array('',	$form->end('Save'))
     ));
     echo "</table>";

     }
     else {

    echo "<h1>".__("No category with this id exists",true)."</h1>";
     }


?>

