<?php
/****************************************************************************
 * index.ctp	- List all CDR
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


echo $this->Html->addCrumb(__('System data',true), '');
echo $this->Html->addCrumb(__('Call data records',true), '/cdr');

$this->Session->flash();

$msg = 'return confirmSubmit("'.__("Are you sure that you want to delete the selected entries?",true).'")';

echo $this->Html->script('toggle');

echo $this->Form->create('Cdr',array('type' => 'post','action'=> 'index'));
echo $this->Html->div('frameRightAlone',$this->Form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $this->Form->end();

$this->Access->showButton($authGroup, 'Cdr', 'output', 'frameRightTrans', __('Export all',true), 'all', 'button');
$this->Access->showButton($authGroup, 'Cdr', 'export', 'frameRightTrans', __('Export',true), 'submit', 'button');
$this->Access->showButton($authGroup, 'Cdr', 'delete', 'frameRightTrans', __('Delete',true), 'submit', 'button');




echo "<h1>".__('Call Data Records',true)."</h1>";


     if ($cdr){


     echo $this->Html->div("",$this->Paginator->counter(array('format' => __("CDR:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
     echo $this->Form->create('Cdr',array('type' => 'post','action'=> 'process','name'  => 'Cdr'));


     echo "<table width='800px' cellspacing = 0>";
     echo $this->Html->tableHeaders(array(
	'',
 	$this->Paginator->sort('epoch', __("Date (YMD)",true)),
 	$this->Paginator->sort('epoch', __("Time",true)),
 	$this->Paginator->sort('channel_state', __("Type",true)),
 	$this->Paginator->sort('call_id', __("Call ID",true)),
 	$this->Paginator->sort('caller_number', __("Caller",true)),
 	$this->Paginator->sort('title', __("Title",true)),
 	$this->Paginator->sort('application', __("Application",true)),
	));



 
      foreach ($cdr as $key => $entry){

	$id = $this->Access->showBlock($authGroup, "<input name='cdr[$key]['Cdr']' type='checkbox' value='".$entry['Cdr']['id']."' id='check' class='check'>");

	$date  	     = date('Y-m-d',$entry['Cdr']['epoch']);
	$time  	     = date('H:i:s A',$entry['Cdr']['epoch']);
	$type	     = $entry['Cdr']['channel_state'];
	$title	     = $this->Text->truncate($entry['Cdr']['title'],20, array('ending' => false, 'exact' => true,'html' => false));
	$application = $this->Formatting->appMatch($entry['Cdr']['application']);
	$call_id     = $this->Text->truncate($entry['Cdr']['call_id'],8,array('ending' => false, 'exact' => true,'html' => false));




	if (!$caller_number = $entry['Cdr']['caller_number']) {  $caller_number='';}


	$delete   = $this->Html->link($this->Html->image("icons/delete.png", array("title" => __("Delete",true))),"/cdr/del/{$entry['Cdr']['id']}",null, __("Are you sure you want to delete this CDR?",true),false);



     $row[$key] = array($id,
     		$date,
		$time,
		$type,		
		$call_id,
		$this->Access->showBlock($authGroup, $caller_number, 'XXX'),
		$title,
                $application
		);

	
	}


     echo $this->Html->tableCells($row);
     echo "</table>";

     echo $this->Access->showCheckbox($authGroup, 'document.Cdr', 'frameLeftTrans');
     echo $this->Access->showBlock($authGroup, $this->Html->div('frameLeftTrans', $this->Form->submit(__('Delete selected',true),  array('name' =>'data[Submit]', 'class' => 'button','onClick'=>$msg))));

     echo $this->Form->end();


     if($this->Paginator->counter(array('format' => '%pages%'))>1){
           echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('25','index/limit:25',null, null, false)." | ".$this->Html->link('50','index/limit:50',null, null, false)." | ".$this->Html->link('100','index/limit:100',null, null, false));



     } else {

	     echo $this->Html->div('feedback',__('No records found',true));
     }

?>
