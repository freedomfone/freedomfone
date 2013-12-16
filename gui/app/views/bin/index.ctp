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

echo $html->addCrumb(__('Message Centre',true), '');
echo $html->addCrumb(__('Incoming SMS',true), '/bin');


$session->flash();
echo $javascript->includeScript('toggle');
$channels =  false;

/*
echo $form->create('Bin',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRightAlone',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();
*/



echo $this->Access->showButton($authGroup, 'Bin', 'export', 'frameRightTrans', __('Export',true), 'submit', 'button');
echo $this->Access->showCheckbox($authGroup, 'document.Bin','frameRightTrans');




echo "<h1>".__('Incoming SMS',true)."</h1>";


      //Create list of hardware IDs
      foreach($login as $entry){
	       $channels[$entry['Bin']['login']] = $entry['Bin']['login'];
      }

      //AJAX form
      echo $form->create("Bin");
      $input1 = $form->input('login', array('id' => 'ServiceType1','type' => 'select', 'options' => $channels, 'label' => false, 'empty' => '-- '.__("Channel",true).' --'));


      echo "<table cellspacing=0 class='none'>";
      echo $html->tableCells(array($input1), array('class' => 'none'), array('class' => 'none'));
      echo "</table>";


      echo $ajax->div("service_div");
      $opt = array("update" => "service_div", "url" => "disp", "frequency" => "0.2");
      echo $ajax->observeForm("BinIndexForm", $opt);
      echo $form->end();			  
      //END AJAX FORM

     if ($bin){

     echo $html->div("",$paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));

      echo $form->create('Bin',array('type' => 'post','action'=> 'process','name' =>'Bin'));
      echo "<table width='95%' cellspacing=0>";

      echo $html->tableHeaders(array(
	'',
 	$paginator->sort(__("Gateway",true), 'proto'),
 	$paginator->sort(__("Channel",true), 'proto'),
 	$paginator->sort(__("Message",true), 'body'),
 	$paginator->sort(__("Time",true), 'created'),

 	$paginator->sort(__("Sender",true), 'sender'),
	__('Action',true)));

      foreach ($bin as $key => $entry){
	$id = "<input name='data[Bin][$key]['Bin']' type='checkbox' value='".$entry['Bin']['id']."' id='check' class='check'>";
	$proto    = $entry['Bin']['proto'];
	$login    = $entry['Bin']['login'];
	$body     = array($entry['Bin']['body'], array('width' => '400px'));
	$created  = $time->format('Y/m/d H:i',$entry['Bin']['created']);
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


     echo $html->tableCells($row);
     echo "</table>"; 

     if($authGroup == 1) {
          echo $html->div('',$form->submit(__('Delete selected',true),  array('name' =>'data[Submit]', 'class' => 'button')));
     }

     if($paginator->counter(array('format' => '%pages%'))>1){
           echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $html->div('paginator', __("Entries per page ",true).$html->link('10','index/limit:10',null, null, false)." | ".$html->link('25','index/limit:25',null, null, false)." | ".$html->link('50','index/limit:50',null, null, false));




     } 

     echo $form->end();
     echo $ajax->divEnd('service_div');

?>