<?php 
/****************************************************************************
 * add.ctp	- Add Freedom Fone user
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


      echo $this->Html->addCrumb(__('Authentication',true), '/users');
      echo $this->Html->addCrumb(__('Add',true), '/users/add');


      echo "<h1>".__("Add System User",true)."</h1>";

     echo $this->Session->flash();


      echo $this->Form->create('User',array('type' => 'post','action'=> 'add'));
      echo "<table cellspacing=0 'class'='stand-alone'>";

      echo $this->Html->tableCells(array (
           array(__("Username",true),	        $this->Form->input('username', array('label' => false))),
           array(__("Password",true),	        $this->Form->input('pwd', array('type' => 'password', 'label' => false, 'value' => ''))),
           array(__("Repeat password",true),	$this->Form->input('pwd_repeat', array('type' => 'password','label' => false, 'value' => ''))),
           array(__("Group", true),             $this->Form->input('group_id',array('type'=>'select','options'=>$options,'label'=> false))),
           array('',	$this->Form->end(__('Save',true)))),
           array('class'=>'stand-alone'),array('class'=>'stand-alone'));
     echo "</table>";

?>