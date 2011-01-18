<?php 
/****************************************************************************
 * add.ctp	- Create new phone book (used for Contacts)
 * version 	- 2.0.1139
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

echo $html->addCrumb('User Management', '');
echo $html->addCrumb('Phone books', '/phone_books');
echo $html->addCrumb('Add', '/phone_books/add');

echo "<h1>".__("Create Phone book",true)."</h1>";

   if ($messages = $session->read('Message.multiFlash')) {
   
       foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
   
   }



$options	  = array('label' => false);


echo $form->create('PhoneBook',array('type' => 'post','action'=> 'add'));
echo "<table width='500px' cellspacing='0'>";



echo $html->tableCells(array (
     array(__("Name",true),	        $form->input('name',$options)),
     array(__("Description",true),	$form->input('description',$options)),
     array('',	$form->end(__('Save',true)))
     ),array('class' => 'stand-alone'),array('class' => 'stand-alone'));
echo "</table>";

?>
