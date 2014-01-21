<?php 
/****************************************************************************
 * edit.ctp	- Edit System Users
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

      echo $this->Html->addCrumb(__('User management',true), '');
      echo $this->Html->addCrumb(__('System Users',true), '/users');

      if($this->data){

        echo $this->Html->addCrumb(__('Edit',true), '/users/edit/'.$this->data['User']['id']);
        echo "<h1>".__("Edit System User",true)."</h1>";

        echo $this->Session->flash();


        $options    = array('label' =>  false, 'value' => '','type' => 'password');


        echo $this->Form->create('User', array('type' => 'post','action'=> 'edit'));   				       			 
        echo $this->Form->hidden('id');
        echo $this->Form->hidden('username');

        echo "<table cellspacing = 0 class = 'stand-alone'>";
        echo $this->Html->tableCells(array (
     	    array(__("Username",true),        $this->data['User']['username']),
     	    array(__("Group",true),           $this->Form->input('group_id',array('type'=>'select','options'=>$groups,'label'=> false,'selected' => $this->data['User']['group_id']))),
     	    array(__("New password",true),    $this->Form->input('pwd',$options)),
     	    array(__("Repeat password",true), $this->Form->input('pwd_repeat',$options)),
            array('',   $this->Form->end(__('Save',true)))
                                ),
            array('class' => 'stand-alone'),array('class' => 'stand-alone'));
        echo "</table>";


      } else {

         echo $this->Html->div("invalid_entry", __("This page does not exist.",true));

      }



?>