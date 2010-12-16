<?php
/****************************************************************************
 * index.ctp	- List all CDR
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

$msg = 'return confirmSubmit("'.__("Are you sure that you want to delete the selected entries?",true).'")';

echo $javascript->includeScript('toggle');

echo $form->create('Cdr',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRightAlone',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('Cdr',array('type' => 'post','action'=> 'output'));
echo $html->div('frameRight',$form->submit(__('Export all',true),  array('name' =>'all', 'class' => 'button')));
echo $form->end();


echo $form->create('Cdr',array('type' => 'post','action'=> 'export'));
echo $html->div('frameRight',$form->submit(__('Export',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('Cdr',array('type' => 'post','action'=> 'delete'));
echo $html->div('frameRight',$form->submit(__('Delete',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


echo "<h1>".__('Call Data Records',true)."</h1>";



     if ($cdr){

     echo $html->div('paginator',$paginator->counter(array('format' => __("Entry",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
     echo $form->create('Cdr',array('type' => 'post','action'=> 'process','name'  => 'Cdr'));

     
     ?>
     <input type="button" name="CheckAll" value="<?php echo __("Check All",true);?>" onClick="checkAll(document.Cdr)">
     <input type="button" name="UnCheckAll" value="<? echo __("Uncheck All",true);?>" onClick="uncheckAll(document.Cdr)">
     <?
     echo $form->submit(__('Delete selected',true),  array('name' =>'data[Submit]', 'class' => 'button','onClick'=>$msg));

     echo "<table width='100%'>";
     echo $html->tableHeaders(array(
	'',
 	$paginator->sort(__("Date (YMD)",true), 'epoch'),
 	$paginator->sort(__("Time",true), 'epoch'),
 	$paginator->sort(__("Type",true), 'channel_state'),
 	$paginator->sort(__("Call ID",true), 'call_id'),
 	$paginator->sort(__("Caller",true), 'caller_number'),
 	$paginator->sort(__("Application",true), 'application'),
 	$paginator->sort(__("Protocol",true), 'proto')));


 
      foreach ($cdr as $key => $entry){

	$id = "<input name='cdr[$key]['Cdr']' type='checkbox' value='".$entry['Cdr']['id']."' id='check' class='check'>";

	$date  	     = date('Y-m-d',$entry['Cdr']['epoch']);
	$time  	     = date('H:i:s A',$entry['Cdr']['epoch']);
	$type	     = $entry['Cdr']['channel_state'];
	$application = $formatting->appMatch($entry['Cdr']['application']);
	$call_id     = $entry['Cdr']['call_id'];
	$proto     = $entry['Cdr']['proto'];


	if (!$caller_number = $entry['Cdr']['caller_number']) {  $caller_number='';}
	$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/cdr/del/{$entry['Cdr']['id']}",null, __("Are you sure you want to delete this CDR?",true),false);


     $row[$key] = array($id,
     		$date,
		$time,
		$type,		
		$call_id,
		$caller_number,
		$application,
		$proto );

	
	}


     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";

     echo $form->end();


     if($paginator->counter(array('format' => '%pages%'))>1){
         echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));  

     }
     echo $html->div('paginator', __("Entries per page ",true).$html->link('50','index/limit:50',null, null, false)." | ".$html->link('100','index/limit:100',null, null, false)." | ".$html->link('250','index/limit:250',null, null, false));

     
     } else {

	     echo $html->div('feedback',__('No records found',true));
     }

?>
