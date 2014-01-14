<?php
/****************************************************************************
 * disp.ctp	- List all incoming SMS by hardware ID
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


     echo $this->Html->div("",$this->Paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));

     echo $this->Form->create('Bin',array('type' => 'post','action'=> 'process','name' =>'Bin'));
     echo "<table width='95%' cellspacing=0>";
     echo $this->Html->tableHeaders(array(
	'',
 	$this->Paginator->sort('proto', __("Gateway",true)),
 	$this->Paginator->sort('proto', __("Channel",true)),
 	$this->Paginator->sort('body', __("Message",true)),
 	$this->Paginator->sort('created', __("Time",true)),
 	$this->Paginator->sort('sender', __("Sender",true)),
	__('Action',true)));


      foreach ($bin as $key => $entry){
	$id = "<input name='data[Bin][$key]['Bin']' type='checkbox' value='".$entry['Bin']['id']."' id='check' class='check'>";
	$proto  = $entry['Bin']['proto'];
	$login  = $entry['Bin']['login'];
	$body     = array($entry['Bin']['body'], array('width' => '400px'));
	$created  = $this->Time->format('Y/m/d H:i',$entry['Bin']['created']);
	$sender   = $entry['Bin']['sender'];
        $delete   = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "bin", "action" => "delete", $entry['Bin']['id']), "onClick" => "return confirm('".__('Are you sure you want to delete this entry?',true)."');"));


     	$row[$key] = array(
                     $this->Access->showBlock($authGroup, $id), 
                     $proto, 
                     $login, 
                     $body, 
                     $created, 
                     $this->Access->showBlock($authGroup, $sender,'XXX'), 
                     array($this->Access->showBlock($authGroup, $delete),array('align'=>'center'))
                     );

	  }


     echo $this->Html->tableCells($row);
     echo "</table>"; 

     if($authGroup == 1) {
          echo $this->Html->div('',$this->Form->submit(__('Delete selected',true),  array('name' =>'data[Submit]', 'class' => 'button')));
     }

     if($this->Paginator->counter(array('format' => '%pages%'))>1){
           echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('10','index/limit:10',null, null, false)." | ".$this->Html->link('25','index/limit:25',null, null, false)." | ".$this->Html->link('50','index/limit:50',null, null, false));

     echo $this->Form->end();

?>