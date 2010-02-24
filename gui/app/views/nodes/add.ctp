<?php
/****************************************************************************
 * add.ctp	- Add node (aka Menu Option for Voice Menus)
 * version 	- 1.0.475
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

$session->flash();
echo "<h1>".__("Create Menu Option",true)."</h1>";

echo $form->create('Node', array('type' => 'post', 'action' => 'add','enctype' => 'multipart/form-data') );


echo "<table>";
echo $html->tableCells(array (
     array(__("Title",true),	$form->input('title',array('label'=>false,'size' =>'50')))));


echo $html->tableCells(array (
     array(__("Audio file",true),	$form->input('file',array('label'=>false,'type'=>'file'))),
     array(array(__("Valid formats: wav and mp3",true),"colspan='2' class='formComment'"))));


echo "</table>";
echo $form->end(__('Save',true));



?>

