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

echo $html->addCrumb(__('SMS Centre',true), '');
echo $html->addCrumb(__('Outboxes',true), '/batches');


$session->flash();
echo $javascript->includeScript('toggle');
$senders = array();

echo "<h1>".__('Outgoing SMS',true)."</h1>";

      //Create list of hardware IDs
      foreach($channels as $entry){
	       $senders[$entry] = $entry;
      }


      //AJAX form
      echo $form->create("Batch");
      $input1 = $form->input('sender', array('id' => 'ServiceType1','type' => 'select', 'options' => $senders, 'label' => false, 'empty' => '-- '.__("Channel",true).' --'));


      echo "<table cellspacing=0 class='none'>";
      echo $html->tableCells(array($input1), array('class' => 'none'), array('class' => 'none'));
      echo "</table>";


      echo $ajax->div("service_div");
      $opt = array("update" => "service_div", "url" => "disp", "frequency" => "0.2");
      echo $ajax->observeForm("BatchIndexForm", $opt);
      echo $form->end();			  
      //END AJAX FORM

     if ($batch){

     echo $html->div("",$paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));



      echo $form->create('Batch',array('type' => 'post','action'=> 'process','name' =>'Batch'));
      echo "<table width='95%' cellspacing=0>";

      echo $html->tableHeaders(array(
 	$paginator->sort(__("Name",true), 'name'),
 	$paginator->sort(__("Message",true), 'body'),
 	$paginator->sort(__("Channel",true), 'sender'),
 	$paginator->sort(__("Time",true), 'created'),
	__('Action',true)));

      foreach ($batch as $key => $entry){
	$name     = $entry['Batch']['name'];
	$message  = array($entry['Batch']['body'], array('width' => '400px'));
	$sender   = $entry['Batch']['sender'];
	$created  = $time->format('Y/m/d H:i',$entry['Batch']['created']);
        $delete   = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "batches", "action" => "delete", $entry['Batch']['id']), "onClick" => "return confirm('".__('Are you sure you want to delete this SMS batch?',true)."');"));


     	$row[$key] = array(
                     $name, 
   		     $message, 
                     $sender, 
                     $created, 
                     array($this->Access->showBlock($authGroup, $delete),array('align'=>'center'))
                     );

	}


     echo $html->tableCells($row);
     echo "</table>"; 


     if($paginator->counter(array('format' => '%pages%'))>1){
           echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $html->div('paginator', __("Entries per page ",true).$html->link('10','index/limit:10',null, null, false)." | ".$html->link('25','index/limit:25',null, null, false)." | ".$html->link('50','index/limit:50',null, null, false));




     } 

     echo $form->end();
     echo $ajax->divEnd('service_div');

?>
