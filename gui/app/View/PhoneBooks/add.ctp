<?php 
/****************************************************************************
 * add.ctp	- Create new phone book (used for Contacts)
 * version 	- 3.0.1500
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

echo $this->Html->addCrumb(__('User Management',true), '');
echo $this->Html->addCrumb(__('Phone books',true), '/phone_books');
echo $this->Html->addCrumb(__('Add',true), '/phone_books/add');

echo "<h1>".__("Create Phone book",true)."</h1>";

   // Multiple Flash messages
   if ($messages = $this->Session->read('Message')) {
       foreach($messages as $key => $value) {
              echo $this->Session->flash($key);
       }
    }



$options	  = array('label' => false);


echo $this->Form->create('PhoneBook',array('type' => 'post','action'=> 'add'));
echo "<table width='500px' cellspacing='0'>";



echo $this->Html->tableCells(array (
     array(__("Name",true),	        $this->Form->input('name',$options)),
     array(__("Description",true),	$this->Form->input('description',$options)),
     array('',	$this->Form->end(__('Save',true)))
     ),array('class' => 'stand-alone'),array('class' => 'stand-alone'));
echo "</table>";

?>
