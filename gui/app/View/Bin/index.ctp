<?php
/****************************************************************************
 * index.ctp	- List Incoming SMS
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

echo $this->Html->addCrumb(__('Message Centre',true), '');
echo $this->Html->addCrumb(__('Incoming SMS',true), '/bin');


$this->Session->flash();
echo $this->Html->script('toggle');
$channels =  false;

   echo $this->Form->create('Bin',array('type' => 'post','action'=> 'index'));
   echo $this->Html->div('frameRightAlone', $this->Form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
   echo $this->Form->end();


echo $this->Access->showButton($authGroup, 'Bin', 'export', 'frameRightTrans', __('Export',true), 'submit', 'button');
echo $this->Access->showCheckbox($authGroup, 'document.Bin','frameRightTrans');

echo "<h1>".__('Incoming SMS',true)."</h1>";
      //Create list of hardware IDs
      foreach($login as $entry){
	       $channels[$entry['Bin']['login']] = $entry['Bin']['login'];
      }

      echo $this->Form->create("Bin");
      $input1 = $this->Form->input('login', array('id' => 'ServiceType1','type' => 'select', 'options' => $channels, 'label' => false, 'empty' => '-- '.__("Channel",true).' --'));

      echo "<table cellspacing=0 class='none'>";
      echo $this->Html->tableCells(array($input1), array('class' => 'none'), array('class' => 'none'));
      echo "</table>";

      $this->Js->get('#ServiceType1');
      $this->Js->event('change', $this->Js->request(array('controller'=>'bin','action' => 'disp'),array('async' => true,'update' => '#service_div','method' => 'post','dataExpression'=>true,'data'=> $this->Js->serializeForm(array('isForm' => true,'inline' => true)))));

      echo $this->Form->end();	

     echo "<div id='service_div'>";

     if ($bin){

     echo $this->Html->div("",$this->Paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));

      echo $this->Form->create('Bin',array('type' => 'post','action'=> 'process','name' =>'Bin'));
      echo "<table width='95%' cellspacing=0>";

      echo $this->Html->tableHeaders(array(
	'',
 	$this->Paginator->sort('proto',__("Gateway")),
 	$this->Paginator->sort('login',__("Channel",true)),
 	$this->Paginator->sort('body',__("Message",true)),
 	$this->Paginator->sort('created',__("Time",true)),
 	$this->Paginator->sort('sender',__("Sender",true)),
	__('Action',true)));

      foreach ($bin as $key => $entry){
	$id = "<input name='data[Bin][$key]['Bin']' type='checkbox' value='".$entry['Bin']['id']."' id='check' class='check'>";
	$proto    = $entry['Bin']['proto'];
	$login    = $entry['Bin']['login'];
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




     } 

     echo $this->Form->end();
     echo "</div>";
?>