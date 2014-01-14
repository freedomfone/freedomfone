<?php 
/****************************************************************************
 * add.ctp	- Add new user to system
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
echo $this->Html->addCrumb(__('Callers',true), '/users');
echo $this->Html->addCrumb(__('Add',true), '/users/add');


     echo "<h1>".__("Add Caller",true)."</h1>";

     echo $this->Form->create('User',array('type' => 'post','action'=> 'add'));
     echo $this->Form->hidden('new',array('value'=>0));


     echo "<div class='frameLeft'>";
     echo "<table width='500px' cellspacing='0' class='blue'>";
     echo $this->Html->tableCells(array (
     array(__("Name",true),			$this->Form->input('name',array('label'=>false))),
     array(__("Surname",true),			$this->Form->input('surname',array('label'=>false))),
     array(__("Email",true),			$this->Form->input('email',array('label'=>false))),
     array(__("Skype",true),			$skype = $this->Form->input('skype',array('label'=>false))),
     array(__("Phone number",true),		$this->Form->input('PhoneNumber.number',array('label'=>false))),
     array(__("Organization",true),		$this->Form->input('organization',array('label'=>false))),
     array(__("ACL",true),			$this->Form->input('acl_id',array('type'=>'select','options'=>$acls, 'label'=>false))),
     array(__("Add to phone book", true),       $this->Form->input('PhoneBook.id',array('id'=>'ServiceType','type'=>'select','options'=>$options,'label'=> false,'empty'=>'-- '.__('Phone books',true).' --'))),
     array($this->Form->submit(__('Save',true),  array('name' =>'data[Submit]', 'class' => 'save_button')),'')
     ),array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo $this->Form->end(); 
     echo "</div>";
 

?>

