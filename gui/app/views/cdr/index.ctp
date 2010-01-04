<?php
$session->flash();
echo $javascript->includeScript('toggle');

echo $html->div("frameRight");
echo $form->create('Cdr',array('type' => 'post','action'=> 'index'));
echo $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button'));
echo $form->end();
echo "</div>";


echo "<h1>".__('Call Data Records',true)."</h1>";


     if ($cdr){

     echo $html->div("",$paginator->counter(array('format' => __("CDR:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));

     echo $form->create('Cdr',array('type' => 'post','action'=> 'process','name'  => 'Cdr'));
     
     ?>
     <input type="button" name="CheckAll" value="Check All" onClick="checkAll(document.Cdr)">
     <input type="button" name="UnCheckAll" value="Uncheck All" onClick="uncheckAll(document.Cdr)">
     <?


     echo "<table width='100%'>";
     echo $html->tableHeaders(array(
	'',
 	$paginator->sort(__("Time",true), 'epoch'),
 	$paginator->sort(__("Type",true), 'channel_state'),
 	$paginator->sort(__("Call ID",true), 'call_id'),
 	$paginator->sort(__("Caller number",true), 'caller_number'),
 	$paginator->sort(__("Extension",true), 'extension'),
	__("Delete",true)));


 
      foreach ($cdr as $key => $entry){

	$id = "<input name='cdr[$key]['Cdr']' type='checkbox' value='".$entry['Cdr']['id']."' id='check' class='check'>";

	$time  	     = date('Y-m-d H:i A',$entry['Cdr']['epoch']);
	$type	     = $entry['Cdr']['channel_state'];
	$extension   = $entry['Cdr']['extension'];
	$call_id     = $entry['Cdr']['call_id'];

	if (!$caller_number = $entry['Cdr']['caller_number']) {  $caller_number='';}
	$delete   = $html->link($html->image("icons/delete.png", array("alt" => "Delete")),"/cdr/delete/{$entry['Cdr']['id']}",null, __("Are you sure you want to delete this CDR?",true),false);

     $row[$key] = array($id,
		$time,
		$type,		
		$call_id,
		$caller_number,
		$extension,
		array($delete,array('align'=>'center')));
	
	}


     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";

     echo "<table>";
     echo $html->tableCells(array(
     $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
     $paginator->numbers()));
     echo "</table>";
     echo $form->end();


echo "<span>".__("No of CDR per page: ",true);
echo $html->link('50','index/limit:50',null, null, false)." | ";
echo $html->link('100','index/limit:100',null, null, false)." | ";
echo $html->link('250','index/limit:250',null, null, false);
echo "</span>";
     }

?>
