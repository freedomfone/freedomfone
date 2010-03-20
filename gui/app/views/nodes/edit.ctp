<?php
/****************************************************************************
 * edit.ctp	- Edit node (aka Menu Option for Voice Menu)
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

$ivr = Configure::read('IVR_SETTINGS');
	if($this->data){

		echo "<h1>".__("Edit Menu Option",true)."</h1>";

      		$path = $ivr['path'].$this->data['Node']['instance_id']."/".$ivr['dir_node'];
		$listen =  $this->element('player',array('path'=>$path,'file'=>$this->data['Node']['file'],'title'=>$this->data['Node']['title']));



		$session->flash();
		echo $form->create('Node', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
		echo $form->input('file_old',array('type'=>'hidden','value'=>$this->data['Node']['file']));

		echo "<table border=0>";

		echo $html->tableCells(array (
     		     array(__("Title",true),	$form->input('title',array('label'=>false,'size'=>'50')))));



		echo $html->tableCells(array (
     		     array(__("Audio file",true),	$form->input('file',array('label'=>false,'type'=>'file'))),
     		     array(array(__("If you select a file, the previous one will be deleted. Valid formats: wav and mp3",true),"colspan='2' class='formComment'"))));

		echo $html->tableCells(array (
     		     array(__("Listen to uploaded file",true),	$listen)));

		echo "</table>";
		echo $form->end(__('Save',true));

		}

	else {
    		echo "<h1>".__("No Menu Option with that id exists",true)."</h1>";
	}


?>

