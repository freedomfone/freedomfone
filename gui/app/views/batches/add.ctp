<?php
/****************************************************************************
 * add.ctp	- Create new SMS batch
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
echo $html->addCrumb(__('Batches',true), '/batches');
echo $html->addCrumb(__('Create',true), '/batches/add');


echo "<h1>".__("Create batch of outgoing SMS",true)."</h1>";
echo $form->create('Batch',array('type' => 'post','action'=> 'add', 'enctype' => 'multipart/form-data'));

      foreach($channels as $entry){
	       $_channels[$entry] = $entry;
      }


echo $html->div('frameLeft');

echo "<table cellpadding=0 class='blue'>";
echo $html->tableCells(array (
     array(__("Name",true),	$form->input('name',array('label'=>false,'size' => '10'))),
     array(array(__("Name of SMS batch.",true),"colspan='2' class='formComment'")),

     array(__("SMS body",true),	$form->input('body',array('label'=>false,'cols' => 40,'rows' => 8))),
     array(array(__("Alpha-numeric characters only (maximum 160)",true),"colspan='2' class='formComment'")),

     array(__("Channel",true),	$form->input('sender',array('label'=>false, 'options' => $_channels))),
     array(array(__("SIM card to use for sending SMS.",true),"colspan='2' class='formComment'")),

     array(__("Receivers",true),	$form->input('file',array('label'=>false, 'type' => 'file'))),
     array(array(__("File containing receivers phone numbers. One number per line.",true),"colspan='2' class='formComment'")),

     ), array('class'=>'blue'),array('class'=>'blue'));


echo "</table>";


echo $form->end(__('Save',true));
echo "</div>";
?>

