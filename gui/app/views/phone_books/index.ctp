<?php
/****************************************************************************
 * index.ctp	- List all phone books (used for Contacts)
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

   echo $form->create('PhoneBook',array('type' => 'post','action'=> 'add'));
   echo $html->div('frameRight',$form->submit(__('Create new',true),  array('name' =>'submit', 'class' => 'button')));
   echo $form->end();
   echo "<h1>".__("PhoneBook",true)."</h1>";

   if ($messages = $session->read('Message.multiFlash')) {
   
       foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
   
   }


   if ($data){

      echo "<table width='100%'>";
      echo $html->tableHeaders(array(__('PhoneBook',true),__('Description',true),__('Edit',true),__('Delete',true),__('Export',true)));


      	   foreach ($data as $key => $phone_book){

      	      $title 	= $phone_book['PhoneBook']['name'];
      	      $description = $phone_book['PhoneBook']['description'];		   
  	      $edit 	= $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/phone_books/edit/{$phone_book['PhoneBook']['id']}",null, null, false);
      	      $delete 	= $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/phone_books/delete/{$phone_book['PhoneBook']['id']}",array('class'=>'confirm_delete'), __("Are you sure you want to delete this phone book?",true),false);
	      $export 	= $html->link($html->image("icons/export-16.png", array("title" => __("Export",true))),"/phone_books/export/{$phone_book['PhoneBook']['id']}",null, null, false);
              $row[$key] = array($title, $description,$edit,$delete, $export);

         }

         echo $html->tableCells($row,array('class'=>'darker'));
         echo "</table>";

   }   else {
      
      echo "<div class='instruction'>".__("No phone books exist. Please create one by clicking the 'Create new' button to the right.")."</div>";

   }

?>