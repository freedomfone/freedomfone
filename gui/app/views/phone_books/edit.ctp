<?php 
/****************************************************************************
 * edit.ctp	- Edit existing phone books (used in Contacts)
 * version 	- 1.0.362
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



      if($this->data){

      echo "<h1>".__("Phone book : Edit",true)."</h1>";
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

      echo $form->create('PhoneBook',array('type' => 'post','action'=> 'edit'));
			  		

     echo "<table>";
     echo $html->tableCells(array (
     	  array(__("Name",true),	        $form->input('name',$options_name)),
     	  array(__("Description",true),		$form->input('description',$options_longname)),
     	  array(__("Use in",true),		$form->input('Users',array('type'=>'select','multiple'=>'true','label'=>false,'empty'=>__('-- Use in none --',true)))),
     	  array('',	$form->end(__('Save',true)))
     	  ));
    echo "</table>";

    }
    else {
    
    echo "<h1>".__("No phone book with this id exists",true)."</h1>";

    }



?>