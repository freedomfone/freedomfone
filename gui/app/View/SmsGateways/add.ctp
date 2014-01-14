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
echo $this->Html->addCrumb(__('SMS Centre',true), '');
echo $this->Html->addCrumb(__('SMS gateways',true), '/sms_gateways');
echo $this->Html->addCrumb(__('Create new',true), '/sms_gateways/add');


echo "<h1>".__("Create SMS gateway",true)."</h1>";
echo $this->Form->create('SmsGateway',array('type' => 'post','action'=> 'add', 'enctype' => 'multipart/form-data'));

$gateway_types  = Configure::read('SMS_GATEWAY_TYPES');

echo $this->Html->div('frameLeft');

echo "<table cellpadding=0 class='blue'>";
echo $this->Html->tableCells(array (
     array(__("Name",true),	$this->Form->input('name',array('label'=>false,'size' => '30'))),
     array(array(__("Name of SMS gateway.",true),"colspan='2' class='formComment'")),

     array(__("Comment",true),	$this->Form->input('comment',array('label'=>false,'cols' => 40,'rows' => 8))),
     array(array(__("Comment",true),"colspan='2' class='formComment'")),

     array(__("Type",true),	$this->Form->input('gateway_code',array('label'=>false,'options' => $gateway_types))),
     array(array(__("URL of SMS gateway.",true),"colspan='2' class='formComment'")),



     array(__("URL",true),	$this->Form->input('url',array('label'=>false,'size' => '30'))),
     array(array(__("URL of SMS gateway.",true),"colspan='2' class='formComment'")),

     array(__("Username",true),	$this->Form->input('username',array('label'=>false,'size' => '30'))),
     array(array(__("Username of gateway account.",true),"colspan='2' class='formComment'")),

     array(__("Password",true),	$this->Form->input('password',array('label'=>false,'size' => '30'))),
     array(array(__("Password of gateway account.",true),"colspan='2' class='formComment'")),

     array(__("API key",true),	$this->Form->input('api_key',array('label'=>false,'size' => '30'))),
     array(array(__("API secret key.",true),"colspan='2' class='formComment'")),



     ), array('class'=>'blue'),array('class'=>'blue'));


echo "</table>";


echo $this->Form->end(__('Save',true));
echo "</div>";
?>

