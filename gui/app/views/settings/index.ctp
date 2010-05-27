<?php 
/****************************************************************************
 * index.ctp	- Set environment settings
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

echo "<h1>".__("Language settings",true)."</h1>";

$session->flash();
echo $form->create('Setting',array('type' => 'post','action'=> 'index'));
$empty = '- '.__('Select language',true).' -';

	foreach ($data as $key => $unit){

	  $entry = $unit['Setting'];

	  if ($entry['name']=='language'){

	     $lang_selected = $entry['value_string'];
	     $languages = Configure::read('LANGUAGES');
	     $rows[] = array(__("Language",true), $form->input($entry['id'].'.value',array('options'=>$languages,'label'=>false,'empty'=>$empty,'selected'=>$lang_selected)));
	     echo $form->hidden($entry['id'].'.field',array('value'=>'value_string'));


	  } 
	  

	}

	$rows[] = array(array($form->end(__('Save',true)),array('colspan'=>2,'align'=>'center')));


	echo "<table>";
	echo $html->tableCells($rows);
	echo "</table>";


?>
