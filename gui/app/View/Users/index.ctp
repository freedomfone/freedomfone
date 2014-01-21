<?php
/****************************************************************************
 * index.ctp	- List all Freedom Fone Users
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


      echo $this->Form->create('User',array('type' => 'post','action'=> 'add'));
      echo $this->Html->div('frameRightAlone',$this->Form->submit(__('Add user',true),  array('name' =>'submit', 'class' => 'button')));
      echo $this->Form->end();


      echo "<h1>".__("System Users",true)."</h1>";

     echo $this->Session->flash();


   if ($users){

      echo "<table  cellspacing = 0>";
      echo $this->Html->tableHeaders(array(__('Username',true),__('Group',true),__('Actions',true)));


      	      foreach ($users as $key => $user){

      	      	         $name       = $user['User']['username'];
 			 $group      = __($options[$user['User']['group_id']],true);
                         $edit       = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "users", "action" => "edit", $user['User']['id'])));
                         $delete     = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "users", "action" => "delete", $user['User']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this user?',true)."');"));


                         $row[$key] = 
                            array(array($name, array('width' => '150px')), 
                            array($group,array('width' => '50px')),
                            array($edit.' '.$delete, array('align' => 'center','width' => '50px'))
                        );

      		     }

     echo $this->Html->tableCells($row,array('class'=>'darker'));
      echo "</table>";

      }
      else {

         echo $this->Html->div('feedback', __('No users exist. Please add one by clicking the <i>Add User</i> button to the right.',true));

      }

?>