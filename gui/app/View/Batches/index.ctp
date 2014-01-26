<?php
/****************************************************************************
 * index.ctp	- List SMS batches
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
echo $this->Html->addCrumb(__('SMS Batches',true), '/batches');


echo $this->Session->flash();

$senders = array();

echo "<h1>".__('SMS Batches',true)."</h1>";

  $this->Access->showButton($authGroup, 'Batch', 'add', 'frameRightTrans', __('Create new',true), 'submit', 'button');
  echo $this->Html->script('toggle');
  echo $this->Access->showCheckbox($authGroup, 'document.Batch','frameRightTrans');   


   //Create list of hardware IDs
      foreach($gsm_gateways as $entry){
	       $senders[$entry] = $entry;
      }

     $senders = $sms_gateways+$senders;


      //AJAX form
      echo $this->Form->create("Batch");
      $input1 = $this->Form->input('sender', array('id' => 'BatchIndex','type' => 'select', 'options' => $senders, 'label' => false, 'empty' => '-- '.__("Channel",true).' --'));
      echo "<table cellspacing=0 class='none'>";
      echo $this->Html->tableCells(array($input1), array('class' => 'none'), array('class' => 'none'));
      echo "</table>";

      $this->Js->get('#BatchIndex');
      $this->Js->event('change', $this->Js->request(array('controller'=>'batches','action' => 'disp'),array('async' => true,'update' => '#batch_div','method' => 'post','dataExpression'=>true,'data'=> $this->Js->serializeForm(array('isForm' => true,'inline' => true)))));
      echo $this->Form->end();
      echo "<div id='batch_div'>";
      //END AJAX FORM

	


     if ($batch){

     echo $this->Html->div("",$this->Paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));

      echo $this->Form->create('Batch',array('type' => 'post','action'=> 'process','name' =>'Batch'));
      echo "<table width='95%' cellspacing=0>";

      echo $this->Html->tableHeaders(array(
        false,
 	$this->Paginator->sort('status', __("Status",true)),
 	$this->Paginator->sort('name', __("Name",true)),
 	$this->Paginator->sort('body', __("Message",true)),
 	$this->Paginator->sort('sender', __("Channel",true)),
 	$this->Paginator->sort('created', __("Time",true)),
	__('Action',true)));

      foreach ($batch as $key => $entry){
        $id = $this->Access->showBlock($authGroup, "<input name='batch[$key]['Batch']' type='checkbox' value='".$entry['Batch']['id']."' id='check' class='check'>");


	$status	  =  $this->element('process_status',array('status'=>$entry['Batch']['status'],'mode'=>'image'));
	$name     = array($entry['Batch']['name'], array('width' => '200px'));
	$message  = array($entry['Batch']['body'], array('width' => '400px'));
	if(!$channel = $entry['Batch']['sender']){
	 $channel  = $entry['SmsGateway']['name'];
	}
	$created  = $this->Time->format('Y/m/d H:i',$entry['Batch']['created']);
        $delete   = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "batches", "action" => "delete", $entry['Batch']['id']), "onClick" => "return confirm('".__('Are you sure you want to delete this SMS batch?',true)."');"));

        $view   = $this->Html->image("icons/view.png", array("alt" => __("View receivers",true), "title" => __("View receivers",true), "url" => array("controller" => "batches", "action" => "view", $entry['Batch']['id'])));

     	$row[$key] = array(
		     $id,
		     $status,
                     $name, 
   		     $message, 
                     $channel, 
                     $created, 
                     array($view." ".$this->Access->showBlock($authGroup, $delete) , array('align'=>'center'))
                     );

	}


     echo $this->Html->tableCells($row);
     echo "</table>"; 

     if($authGroup == 1) {
                   echo "<table cellspacing = 0 class = 'none' border=0>";
                   echo $this->Html->tableCells(array(__('Perform action on selected',true).': ',
                   $this->Form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button'))));
                   echo "</table>";
     }


     if($this->Paginator->counter(array('format' => '%pages%'))>1){
           echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('10','index/limit:10',null, null, false)." | ".$this->Html->link('25','index/limit:25',null, null, false)." | ".$this->Html->link('50','index/limit:50',null, null, false));




     } 




     echo $this->Form->end();



     echo "</div>";




?>
