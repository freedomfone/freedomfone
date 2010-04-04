<?php
/****************************************************************************
 * index.ctp	- List Other SMS
 * version 	- 1.0.362
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

echo $form->create('Bin',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRight',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


echo $form->create('Bin',array('type' => 'post','action'=> 'export'));
echo $html->div('frameRight',$form->submit(__('Export',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();




echo "<h1>".__('Other SMS',true)."</h1>";
echo $html->div("",$paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));

     if ($data){

echo $form->create('Bin',array('type' => 'post','action'=> 'process','name' =>'Bin'));
?>
<input type="button" name="CheckAll" value="<? echo __('Check All',true);?>" onClick="checkAll(document.Bin)">
<input type="button" name="UnCheckAll" value="<? echo __('Uncheck All',true);?>" onClick="uncheckAll(document.Bin)">
<?

echo "<table width='100%'>";

echo $html->tableHeaders(array(
	'',
 	$paginator->sort(__("Body",true), 'body'),
 	$paginator->sort(__("Arrival",true), 'created'),
 	$paginator->sort(__("Type",true), 'mode'),
 	$paginator->sort(__("Protocol",true), 'proto'),
 	$paginator->sort(__("Sender",true), 'sender'),
	__("Delete",true)));

      foreach ($data as $key => $entry){
	$id = "<input name='data[Bin][$key]['Bin']' type='checkbox' value='".$entry['Bin']['id']."' id='check' class='check'>";

	//$id = $form->input($entry['Bin']['id'],array('id' => $entry['Bin']['id'], 'type'=>'checkbox','value'=>$entry['Bin']['id']));
	$body     = $entry['Bin']['body'];
	$created  = $time->niceShort($entry['Bin']['created']);
	$mode     = $entry['Bin']['mode'];
	$proto    = $entry['Bin']['proto'];
	$sender    = $entry['Bin']['sender'];
	$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/bin/delete/{$entry['Bin']['id']}",null, __("Are you sure you want to delete this entry?",true),false);

     	$row[$key] = array($id, $body, $created, $mode, $proto, $sender, array($delete,array('align'=>'center')));


	}


     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>"; 

     echo "<table>";
     echo $html->tableCells(array(
     $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
     $paginator->numbers()));
     echo "</table>";
     echo $form->end();
     }

echo "<span>".__("No of entries per page: ",true);
echo $html->link('25','index/limit:25',null, null, false)." | ";
echo $html->link('50','index/limit:50',null, null, false)." | ";
echo $html->link('100','index/limit:100',null, null, false);
//echo $html->link(__('All',true),'index/limit:all',null, null, false);
echo "</span>";


?>
