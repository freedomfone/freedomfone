<?php 
/****************************************************************************
 * add.ctp	- Add Freedom Fone Group
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
      echo $html->addCrumb(__('Add',true), '/groups/add');


      echo "<h1>".__("Add Group",true)."</h1>";
      $options	  = array('label' => false);


      echo $form->create('Group',array('type' => 'post','action'=> 'add'));
      echo "<table cellspacing=0 'class'='stand-alone'>";

      echo $html->tableCells(array (
           array(__("Name",true),	        $form->input('name',$options)),
           array('',	$form->end(__('Save',true)))),
           array('class'=>'stand-alone'),array('class'=>'stand-alone'));
     echo "</table>";

?>