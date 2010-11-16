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

$ivr = Configure::read('IVR_SETTINGS');


echo $form->create('Node',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRight',$form->submit(__('Upload new',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

$info = __('Menu Option|A Menu Option can either be (1) an audio file previously uploaded through the Create Menu option page, or (2) a Leave-a-Message service.| You can at any time add, edit, listen to or delete existing Menu Options.| Menu option files can be .mp3 or .wav audio files. When they are uploaded into the system they are associated with a Title to help you manage your audio files.| A Menu option file can be used in one or more different Voice Menus. These files cannot be deleted if they are currently associated with a Voice Menu.',true);
echo $html->div('frameInfo', $html->link($html->image('icons/bulb.png',array('alt'=>'Tooltips')),'#',array('class'=>'infobox','title'=>$info),null,false));


  echo "<h1>".__('Menu options',true)."</h1>";

   	  if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
         }


   if ($nodes){

      echo $html->div("",$paginator->counter(array('format' => __("Entry:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));  
      echo $form->create('Node',array('type' => 'post','action'=> 'process'));
      echo "<table width='100%'>";
      echo $html->tableHeaders(array(
 	$paginator->sort(__("Title",true), 'title'),
 	//$paginator->sort(__("Category",true), 'Category.name'),
 	$paginator->sort(__("Created",true), 'created'),
	__("Duration",true),
	__("Edit",true),
	__("Delete",true),
	__("Download",true),
	__("Listen",true)));

      echo $form->hidden('source',array('value'=>'index'));

      foreach ($nodes as $key => $node){

       	      $path = $ivr['path'].IID."/".$ivr['dir_node'];
	      $title    = $node['Node']['title'];
	      //$category = $node['Category']['name'];
	      $created  = $time->niceShort($node['Node']['created']);
	      $duration = $formatting->epochToWords($node['Node']['duration']);
	      $edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/nodes/edit/{$node['Node']['id']}",null, null, false);
	      $delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/nodes/delete/{$node['Node']['id']}",null, __("Are you sure you want to delete this Menu Option?",true),false);
	      $download = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/nodes/download/{$node['Node']['id']}",null, null, false);
	      $listen   = $this->element('player',array('path'=>$path,'file'=>$node['Node']['file'],'title'=>$title, 'id'=> $node['Node']['id']));

     	      $row[$key] = array(
		array($title,array('align'=>'left')),
		array($created,array('align'=>'left','width'=>'125px')),
		array($duration,array('align'=>'left','width'=>'80px')),
		array($edit,array('align'=>'center','width'=>'30px')),
		array($delete,array('align'=>'center','width'=>'30px')),
		array($download,array('align'=>'center','width'=>'30px')),
		array($listen,array('align'=>'left','width'=>'200px')));	

	}


     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";
     echo $form->end();


     if($pages = $paginator->numbers()){
     	       echo "<table>";
     	       echo $html->tableCells(array(__('Page',true),$pages));
     	       echo "</table>";
     }

     echo "<span>".__("Number of entries per page: ",true);
     echo $html->link('10','index/limit:10',null, null, false)." | ";
     echo $html->link('50','index/limit:50',null, null, false)." | ";
     echo $html->link('100','index/limit:100',null, null, false) ;
     echo "</span>";
     } else {
      	   echo "<div class='instruction'>".__("No Menu Options are uploaded. Please upload a Menu Option by clicking the 'Upload new' button to the right.")."</div>";
     }

?>
