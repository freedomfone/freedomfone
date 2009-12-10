<?php
$session->flash();
echo $javascript->includeScript('toggle');

echo $form->create('Bin',array('type' => 'post','action'=> 'export'));
echo $html->div('frameRight',$form->submit(__('Export',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


echo "<h1>".__('Unclassified SMS',true)."</h1>";



echo $html->div("",$paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));


     if ($data){

echo $form->create('Bin',array('type' => 'post','action'=> 'process','name' =>'Bin'));
?>
<input type="button" name="CheckAll" value="Check All" onClick="checkAll(document.Bin)">
<input type="button" name="UnCheckAll" value="Uncheck All" onClick="uncheckAll(document.Bin)">
<?

echo "<table width='100%'>";

echo $html->tableHeaders(array(
	'',
 	$paginator->sort(__("Body",true), 'body'),
 	$paginator->sort(__("Created",true), 'created'),
	__("Delete",true)));

      foreach ($data as $key => $entry){
	$id = "<input name='data[Bin][$key]['Bin']' type='checkbox' value='".$entry['Bin']['id']."' id='check' class='check'>";

	//$id = $form->input($entry['Bin']['id'],array('id' => $entry['Bin']['id'], 'type'=>'checkbox','value'=>$entry['Bin']['id']));
	$body     = $entry['Bin']['body'];
	$created  = $time->niceShort($entry['Bin']['created']);
	$delete   = $html->link($html->image("icons/delete.png", array("alt" => "Delete")),"/bin/delete/{$entry['Bin']['id']}",null, __("Are you sure you want to delete this entry?",true),false);

     	$row[$key] = array($id, $body, $created, array($delete,array('align'=>'center')));


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
echo $html->link('100','index/limit:100',null, null, false)." | " ;
echo $html->link(__('All',true),'index',null, null, false);
echo "</span>";


?>
