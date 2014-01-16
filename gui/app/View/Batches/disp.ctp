<?php
/****************************************************************************
 * disp.ctp	- List all outboing SMS batches by hardware ID
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



     if($batch){

      echo $this->Form->create('Batch',array('type' => 'post','action'=> 'process','name' =>'Batch'));
      echo "<table width='95%' cellspacing=0>";

      echo $this->Html->tableHeaders(array(
 	$this->Paginator->sort('name', __("NameDISP",true)),
 	$this->Paginator->sort('body', __("Message",true)),
 	$this->Paginator->sort('sender', __("Channel",true)),
 	$this->Paginator->sort('created', __("Time",true)),
	__('Action',true)));

      foreach ($batch as $key => $entry){
	$name     = $entry['Batch']['name'];
	$message  = array($entry['Batch']['body'], array('width' => '400px'));
	if(!$channel = $entry['Batch']['sender']){
	 $channel  = $entry['SmsGateway']['name'];
	}

	$created  = $this->Time->format('Y/m/d H:i',$entry['Batch']['created']);
        $delete   = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "batches", "action" => "delete", $entry['Batch']['id']), "onClick" => "return confirm('".__('Are you sure you want to delete this SMS batch?',true)."');"));


     	$row[$key] = array(
                     $name, 
   		     $message, 
                     $channel, 
                     $created, 
                     array($this->Access->showBlock($authGroup, $delete),array('align'=>'center'))
                     );

	}


     echo $this->Html->tableCells($row);
     echo "</table>"; 


     echo $this->Form->end();
    
    }






?>