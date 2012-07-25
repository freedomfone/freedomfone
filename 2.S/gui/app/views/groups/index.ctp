<?php
/****************************************************************************
 * index.ctp	- List all Freedom Fone Groups
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

      echo $html->addCrumb(__('Authentication',true), '/groups');


      echo $form->create('Group',array('type' => 'post','action'=> 'add'));
      echo $html->div('frameRightAlone',$form->submit(__('Add group',true),  array('name' =>'submit', 'class' => 'button')));
      echo $form->end();


      echo "<h1>".__("Freedom Fone Groups",true)."</h1>";

       // Multiple Flash messages
       if ($messages = $this->Session->read('Message')) {
            foreach($messages as $key => $value) {
                       echo $this->Session->flash($key);
            }
       }


   if ($groups){

      echo "<table width='400px' cellspacing = 0>";
      echo $html->tableHeaders(array(__('Group', true),__('Edit',true),__('Delete',true)));

      	      foreach ($groups as $key => $group){

      	      	         $name       = $group['Group']['name'];
                         $edit       = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "groups", "action" => "edit", $group['Group']['id'])));
                         $delete     = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "groups", "action" => "delete", $group['Group']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this group?',true)."');"));

     $row[$key] = array($name, $edit,$delete);

      		     }

     echo $html->tableCells($row,array('class'=>'darker'));
      echo "</table>";

      }
      else {

         echo $html->div('feedback', __('No groups exist. Please add one by clicking the <i>Add Group</i> button to the right.',true));

      }

?>