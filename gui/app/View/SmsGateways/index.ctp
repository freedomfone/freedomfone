<?php
/****************************************************************************
 * index.ctp	- List SMS gateways
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


$this->Access->showButton($authGroup, 'SmsGateway', 'add', 'frameRightTrans', __('Create new',true), 'submit', 'button');

echo $this->Session->flash();

$gateway_types  = Configure::read('SMS_GATEWAY_TYPES');

echo "<h1>".__('SMS gateways',true)."</h1>";


     if ($gateways){

     echo $this->Html->div("",$this->Paginator->counter(array('format' => __("Gateway:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));


      echo "<table width='95%' cellspacing=0>";

      echo $this->Html->tableHeaders(array(
 	$this->Paginator->sort('name', __("Name",true)),
 	$this->Paginator->sort('comment', __("Comment",true)),
 	$this->Paginator->sort('gateway_type', __("Type",true)),
 	$this->Paginator->sort('url', __("URL",true)),
 	$this->Paginator->sort('username', __("username",true)),
 	$this->Paginator->sort('created', __("Created",true)),
	__('Action',true)));

      foreach ($gateways as $key => $entry){
	$name     = $entry['SmsGateway']['name'];
	$comment  = array($entry['SmsGateway']['comment'], array('width' => '300px'));
	$type	  = $gateway_types[$entry['SmsGateway']['gateway_code']];
	$url	  = $entry['SmsGateway']['url'];
	$username = $entry['SmsGateway']['username'];
	$created  = $this->Time->format('Y/m/d H:i',$entry['SmsGateway']['created']);
        $delete   = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "sms_gateways", "action" => "delete", $entry['SmsGateway']['id']), "onClick" => "return confirm('".__('Are you sure you want to delete this SMS gateway?',true)."');"));
        $edit     = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "sms_gateways", "action" => "edit", $entry['SmsGateway']['id'])));


     	$row[$key] = array(
                     $name, 
   		     $comment, 
   		     $type, 
   		     $url, 
                     $username, 
                     $created, 
                     array($this->Access->showBlock($authGroup, $edit)." ".$this->Access->showBlock($authGroup, $delete),array('align'=>'center'))
                     );

	}


     echo $this->Html->tableCells($row);
     echo "</table>"; 


     if($this->Paginator->counter(array('format' => '%pages%'))>1){
           echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('10','index/limit:10',null, null, false)." | ".$this->Html->link('25','index/limit:25',null, null, false)." | ".$this->Html->link('50','index/limit:50',null, null, false));


       
     echo $this->Form->end();

     } else {

        echo $this->Html->div('feedback', __('No SMS gateways exist. Please create one by clicking the <i>Create new</i> button to the right.',true));

     }



?>
