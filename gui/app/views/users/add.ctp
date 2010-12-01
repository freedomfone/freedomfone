<?php 
/****************************************************************************
 * add.ctp	- Add new user to system
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



     echo "<h1>".__("Add contact",true)."</h1>";

     echo $form->create('User',array('type' => 'post','action'=> 'add'));
     echo $form->hidden('new',array('value'=>0));


     echo "<div class='frameLeft'>";
     echo "<table>";
     echo $html->tableCells(array (
     array(array($html->div('table_sub_header',__('User data',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom'))),
     array(__("Name",true),			$form->input('name',array('label'=>false))),
     array(__("Surname",true),			$form->input('surname',array('label'=>false))),
     array(__("Email",true),			$form->input('email',array('label'=>false))),
     array(__("Skype",true),			$skype = $form->input('skype',array('label'=>false))),
     array(__("Phone number",true),		$phone1 = $form->input('phone1',array('label'=>false))),
     array(__("Organization",true),		$form->input('organization',array('label'=>false))),
     array(__("ACL",true),			$form->input('acl_id',array('type'=>'select','options'=>$acls, 'label'=>false))),
     array($form->submit(__('Save',true),  array('name' =>'data[Submit]', 'class' => 'button')),'')
     ));
     echo "</table>";
     echo $form->end(); 
     echo "</div>";



 

?>

