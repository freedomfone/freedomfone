<?php 


      if($this->data){

      echo "<h1>".__("Edit Tag",true)."</h1>";
      $session->flash();

      $options_name = array('label' =>  array('text'=>false,
			  	        'class'=>'formTitleDefault'),
			  		'type'=>'text',
			  		'size'=>'20');

      $options_longname = array('label' =>  array('text'=>false,
			  	        'class'=>'formTitleDefault'),
			  		'type'=>'text',
			  		'size'=>'50');

     $options_message = array('label' =>  array('text'=>false,
			  	        'class'=>'formTitleDefault'));

      echo $form->create('Tag',array('type' => 'post','action'=> 'edit'));
			  		

     echo "<table>";
     echo $html->tableCells(array (
     	  array(__("Tag",true),	        $form->input('name',$options_name)),
     	  array(__("Description",true),	$form->input('longname',$options_longname)),
     	  array(__("Use in",true),		$form->input('Message',array('type'=>'select','multiple'=>'true','label'=>false))),
     	  array('',	$form->end('Save'))
     	  ));
    echo "</table>";

    }
    else {
    
    echo "<h1>".__("No tag with this id exists",true)."</h1>";

    }



?>