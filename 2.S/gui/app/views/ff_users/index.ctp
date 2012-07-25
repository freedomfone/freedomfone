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

      echo $html->addCrumb(__('User management',true), '');
      echo $html->addCrumb(__('System Users',true), '/ff_users');


      echo $form->create('FfUser',array('type' => 'post','action'=> 'add'));
      echo $html->div('frameRightAlone',$form->submit(__('Add user',true),  array('name' =>'submit', 'class' => 'button')));
      echo $form->end();


      echo "<h1>".__("System Users",true)."</h1>";

        // Multiple Flash messages
        if ($messages = $this->Session->read('Message')) {
                foreach($messages as $key => $value) {
                 echo $this->Session->flash($key);
                }
        }



   if ($ff_users){

      echo "<table  cellspacing = 0>";
      echo $html->tableHeaders(array(__('Username',true),__('Group',true),__('Actions',true)));


      	      foreach ($ff_users as $key => $ff_user){

      	      	         $name       = $ff_user['FfUser']['username'];
 			 $group      = __($options[$ff_user['FfUser']['group_id']],true);
                         $edit       = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "ff_users", "action" => "edit", $ff_user['FfUser']['id'])));
                         $delete     = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "ff_users", "action" => "delete", $ff_user['FfUser']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this user?',true)."');"));


                         $row[$key] = 
                            array(array($name, array('width' => '150px')), 
                            array($group,array('width' => '50px')),
                            array($edit.' '.$delete, array('align' => 'center','width' => '50px'))
                        );

      		     }

     echo $html->tableCells($row,array('class'=>'darker'));
      echo "</table>";

      }
      else {

         echo $html->div('feedback', __('No users exist. Please add one by clicking the <i>Add User</i> button to the right.',true));

      }

?>