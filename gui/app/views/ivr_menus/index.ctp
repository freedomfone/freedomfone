<?php
$session->flash();

echo "<p class='frameRight'>".$html->link($html->image("icons/add.png", array("alt" => "Create new IVR")),"/ivr_menus/add",null, null, false)."</p>";

echo "<h1>".__('Voice Menus',true)."</h1>";

echo $html->div("box", "To call the default Voice Menu, dial +39 333 677 45 32 or make a Skype call to 'skypiax4'");

     if ($ivr_menus){

     echo $form->create('IvrMenu',array('type' => 'post','action'=> 'update'));

     echo "<table width=100%>";
     echo $html->tableHeaders(array(
     	__("Default",true),
 	$paginator->sort(__("Title",true), 'title'),
 	$paginator->sort(__("Greeting",true), 'rate'),
 	$paginator->sort(__("Created",true), 'created'),
 	$paginator->sort(__("Last modified",true), 'modified'),
	__("Edit",true),
	__("Delete",true)));

	echo $form->hidden('source',array('value'=>'index'));

	//Find parent
      foreach ($ivr_menus as $key => $ivr_menu){
      	   if ($ivr_menu['IvrMenu']['parent']==1){
	      $parent = $ivr_menu['IvrMenu']['id'];
	      }
      }
 
      foreach ($ivr_menus as $key => $ivr_menu){
      $options=array($ivr_menu['IvrMenu']['id']=>'');


        $attributes=array('legend'=>false,'default'=>$parent);
        $default = $form->radio('parent',$options,$attributes);

	$title         = $ivr_menu['IvrMenu']['title'];
	$message_long  = $ivr_menu['IvrMenu']['message_long'];
	$created       = $time->niceShort($ivr_menu['IvrMenu']['created']);
	$modified      = $time->niceShort($ivr_menu['IvrMenu']['modified']);
	$edit     = $html->link($html->image("icons/edit.png", array("alt" => "Edit")),"/ivr_menus/edit/{$ivr_menu['IvrMenu']['id']}",null, null, false);
	$delete   = $html->link($html->image("icons/delete.png", array("alt" => "Delete")),"/ivr_menus/delete/{$ivr_menu['IvrMenu']['id']}",null, __("Are you sure you want to delete this voice menu?",true),false);

     	$row[$key] = array(
		$default,
		array($title,array('width'=>'100px')),
		$message_long,
		$created,		
		$modified,
		array($edit,array('align'=>'center')),
		array($delete,array('align'=>'center')));
	}


     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";

     echo $form->end('Update default');
     }

?>
