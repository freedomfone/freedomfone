<?php
$session->flash();
$ivr = Configure::read('IVR_SETTINGS');


echo "<div class='frameRight'>".$html->link($html->image("icons/add.png", array("alt" => "Create new poll")),"/nodes/add",null, null, false)."</div>";

echo "<h1>".__('Voice menu nodes',true)."</h1>";


   if ($nodes){
echo $html->div("",$paginator->counter(array('format' => __("Nodes:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));  

echo $form->create('Node',array('type' => 'post','action'=> 'process'));

echo "<table width='100%'>";
echo $html->tableHeaders(array(
 	$paginator->sort(__("Title",true), 'title'),
 	//$paginator->sort(__("Category",true), 'Category.name'),
 	$paginator->sort(__("Created",true), 'created'),
 	$paginator->sort(__("Last modified",true), 'modified'),
	__("Edit",true),
	__("Delete",true),
	__("Listen",true)));

echo $form->hidden('source',array('value'=>'index'));

      foreach ($nodes as $key => $node){

      $path = $ivr['path'].$node['Node']['instance_id']."/".$ivr['dir_node'];

	$title    = $node['Node']['title'];
	//$category = $node['Category']['name'];
	$created  = $time->niceShort($node['Node']['created']);
	$modified = $time->niceShort($node['Node']['modified']);
	$edit     = $html->link($html->image("icons/edit.png", array("alt" => "Edit")),"/nodes/edit/{$node['Node']['id']}",null, null, false);
	$delete   = $html->link($html->image("icons/delete.png", array("alt" => "Delete")),"/nodes/delete/{$node['Node']['id']}",null, __("Are you sure you want to delete this voice menu node?",true),false);
	$listen   = $this->element('musicplayer_button',array('path'=>$path,'file'=>$formatting->changeExt($node['Node']['file'],'mp3'),'title'=>$node['Node']['title']));

     $row[$key] = array(
		$title,
		$created,		
		$modified,
		array($edit,array('align'=>'center')),
		array($delete,array('align'=>'center')),
		array($listen,array('align'=>'center')));
		

	}


     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";

/*     echo "<table>";
     echo $html->tableCells(array(
     $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
     $form->submit( __('Archive',true), array('name' =>'data[Submit]', 'class' => 'button')), 
     $paginator->numbers()));
     echo "</table>";*/
     echo $form->end();


echo "<span>".__("Number of nodes per page: ",true);
echo $html->link('10','index/limit:2',null, null, false)." | ";
echo $html->link('50','index/limit:5',null, null, false)." | ";
echo $html->link('100','index/limit:10',null, null, false)." | " ;
echo $html->link(__('All',true),'index',null, null, false);
echo "</span>";

     }


      else {

      echo "<div class='instruction'>".__("No nodes exist. Please create a node by clicking on the green button to the right.")."</div>";

      }

?>
