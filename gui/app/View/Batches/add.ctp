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
echo $this->Html->addCrumb(__('Batches',true), '/batches');
echo $this->Html->addCrumb(__('Create',true), '/batches/add');


echo "<h1>".__("Create SMS batch",true)."</h1>";
echo $this->Form->create('Batch',array('type' => 'post','action'=> 'add', 'enctype' => 'multipart/form-data'));



echo $this->Html->div('frameLeft');

echo "<table width='600px'  cellpadding=0 class='blue'>";
echo $this->Html->tableCells(array (
     array(__("Name",true),	$this->Form->input('name',array('label'=>false,'size' => '39'))),
     array(array(__("Name of SMS batch.",true),"colspan='2' class='formComment'")),

     array(__("SMS body",true),	$this->Form->input('body',array('label'=>false,'cols' => 55,'rows ' => 3,'maxLength' => 160))),
     array(array(__("Alpha-numeric characters only (maximum 160)",true),"colspan='2' class='formComment'")),

     array(__("Sender number",true),	$this->Form->input('sender_number',array('label'=>false,'size' => '39'))),
     array(array(__("Number to appear as sender of the SMS. Include country prefix but without plus sign (+) and double zeros (00).",true),"colspan='2' class='formComment'")),


     array(__("Receivers",true),	$this->Form->input('file',array('label'=>false, 'type' => 'file'))),
     array(array(__("File containing receivers phone numbers. One number per line. Maximum 100 entries for Clickatell batches.",true),"colspan='2' class='formComment'")),

     ), array('class'=>'blue'),array('class'=>'blue'));

echo "</table>";

echo $this->Form->create("Batch_method");
      $input1 = $this->Form->input('gateway_type', array('id' => 'ServiceType1','type' => 'select', 'options' => array("SMS Gateway", "GSM Channel"), 'label' => false, 'empty' => '-- '.__("Select sending method",true).' --'));
      echo "<table cellspacing=0 class='blue'>";
      echo $this->Html->tableCells(array($input1), array('class' => 'blue'), array('class' => 'blue'));
echo "</table>";

      $this->Js->get('#ServiceType1');
      $this->Js->event('change', $this->Js->request(array('controller'=>'batches','action' => 'method'),array('async' => true,'update' => '#service_div','method' => 'post','dataExpression'=>true,'data'=> $this->Js->serializeForm(array('isForm' => true,'inline' => true)))));

      echo $this->Form->end();	

     echo "<div id='service_div'>";
     echo "</div>";


     echo $this->Form->end(__('Save',true));
     echo "</div>";
?>

