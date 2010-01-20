<?php
/****************************************************************************
 * index.ctp	- List monitoring data for Voice Menus
 * version 	- 1.0.353
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


$session->flash();
echo $javascript->includeScript('toggle');

echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRightAlone',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'output'));
echo $html->div('frameRight',$form->submit(__('Export all',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'export'));
echo $html->div('frameRight',$form->submit(__('Export',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'erase'));
echo $html->div('frameRight',$form->submit(__('Erase',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


echo "<h1>".__('Monitoring of Voice Menus',true)."</h1>";


     if ($data){

     echo $html->div("",$paginator->counter(array('format' => __("Entries:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
     echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'process','name'  => 'MonitorIvr'));
     
     ?>
     <input type="button" name="CheckAll" value="<?php echo __("Check All",true);?>" onClick="checkAll(document.MonitorIvr)">
     <input type="button" name="UnCheckAll" value="<? echo __("Uncheck All",true);?>" onClick="uncheckAll(document.MonitorIvr)">
     <?


     echo "<table width='100%'>";
     echo $html->tableHeaders(array(
	'',
 	$paginator->sort(__("Date (YMD)",true), 'epoch'),
 	$paginator->sort(__("Time",true), 'epoch'),
 	$paginator->sort(__("Call ID",true), 'call_id'),
 	$paginator->sort(__("IVR Code",true), 'ivr_code'),
 	$paginator->sort(__("Digit",true), 'digit'),
 	$paginator->sort(__("Node ID",true), 'node_id'),
 	$paginator->sort(__("Caller number",true), 'caller_number'),
 	$paginator->sort(__("Type",true), 'type'),
	__("Delete",true)));

	$call_id_old=false;
	$class='lighter';

      foreach ($data as $key => $entry){

	$id = "<input name='monitor_ivr[$key][MonitorIvr]' type='checkbox' value='".$entry['MonitorIvr']['id']."' id='check' class='check'>";

	$date  	     = date('Y-m-d',$entry['MonitorIvr']['epoch']);
	$time  	     = date('H:i:s',$entry['MonitorIvr']['epoch']);
	$ivr_code     = $entry['MonitorIvr']['ivr_code'];
	$call_id     = $entry['MonitorIvr']['call_id'];
	$digit     = $entry['MonitorIvr']['digit'];
	$node_id     = $entry['MonitorIvr']['node_id'];
	$caller_number     = $entry['MonitorIvr']['caller_number'];
	//$extension = $entry['MonitorIvr']['extension'];

	$type = $entry['MonitorIvr']['type'];
	if($type =='CS_ROUTING'){ $type=__("start",true);}
	elseif($type =='CS_DESTROY'){ $type=__("end",true);}


	if (!$caller_number = $entry['MonitorIvr']['caller_number']) {  $caller_number='';}
	$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/monitor_ivr/delete/{$entry['MonitorIvr']['id']}",null, __("Are you sure you want to delete this entry?",true),false);

		//change class
		if($call_id_old != $call_id){ 
				if($class=='darker'){ $class='lighter';}
				else { $class='darker';}
		$call_id_old=$call_id;
		}

     $row = array($id,
		$date,
		$time,
		$call_id,
		$ivr_code,
		array($digit,array('align'=>'center')),
		array($node_id,array('align'=>'center')),
		$caller_number,
		array($type,array('align'=>'center')),
		array($delete,array('align'=>'center'))
		);

		
 	echo $html->tableCells($row,array('class'=>$class),null,null,null);
	
	}


     echo "</table>";

     echo "<table>";
     echo $html->tableCells(array(
     $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
     $paginator->numbers()));
     echo "</table>";
     echo $form->end();


echo "<span>".__("No of entries per page: ",true);
echo $html->link('50','index/limit:50',null, null, false)." | ";
echo $html->link('100','index/limit:100',null, null, false)." | ";
echo $html->link('250','index/limit:250',null, null, false);
echo "</span>";
     }

?>
