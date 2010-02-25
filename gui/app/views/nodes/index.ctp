<?php
/****************************************************************************
 * index.ctp	- List nodes (aka Menu Options for Voice Menus)
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
$ivr = Configure::read('IVR_SETTINGS');


echo $form->create('Node',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRight',$form->submit(__('Upload new',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

$info = __('Menu Option|A Menu Option can either be (1) an audio file previously uploaded through the Menu option files screen, or (2) a Leave-a-Message service.| You can at any time add, edit, listen to or delete existing Menu Options.| Menu option files can be .mp3 or .wav audio files. When they are uploaded into the system they are associated with a Title to help you manage your audio files.| A Menu option file can be used in one or more different Voice Menus. These files cannot be deleted if they are currently associated with a Voice Menu.',true);
echo $html->div('frameInfo', $html->link($html->image('icons/bulb.png',array('alt'=>'Tooltips')),'#',array('class'=>'infobox','title'=>$info),null,false));

//echo "<div class='frameRight'>".$html->link($html->image("icons/add.png", array("title" => __("Create new poll",true))),"/nodes/add",null, null, false)."</div>";

echo "<h1>".__('Menu options',true)."</h1>";


   if ($nodes){
echo $html->div("",$paginator->counter(array('format' => __("Entry:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));  

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
	$edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/nodes/edit/{$node['Node']['id']}",null, null, false);
	$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/nodes/delete/{$node['Node']['id']}",null, __("Are you sure you want to delete this Menu Option?",true),false);
	$listen   = $this->element('musicplayer_button',array('path'=>$path,'file'=>$node['Node']['file'],'title'=>$node['Node']['title']));

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
     echo $form->end();


     echo "<span>".__("Number of entries per page: ",true);
     echo $html->link('10','index/limit:10',null, null, false)." | ";
     echo $html->link('50','index/limit:50',null, null, false)." | ";
     echo $html->link('100','index/limit:100',null, null, false) ;
     echo "</span>";
     }
      else {
      	   echo "<div class='instruction'>".__("No Menu Option are uploaded. Please upload a Menu Option by clicking the 'Create new' button to the right.")."</div>";
      }

?>
