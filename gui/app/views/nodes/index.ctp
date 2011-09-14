<?php
/****************************************************************************
 * index.ctp	- List nodes (aka Content for Voice Menus and Selectors)
 * version 	- 2.0.1175
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

echo $html->addCrumb(__('IVR Centre',true), '');
echo $html->addCrumb(__('Content',true), '/nodes');


$ivr = Configure::read('IVR_SETTINGS');


echo $form->create('Node',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRightAlone',$form->submit(__('Upload new',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


  echo "<h1>".__('Content',true)."</h1>";

   	  if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
         }


   if ($nodes){

      echo $html->div("paginator",$paginator->counter(array('format' => __("Entry:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));  
      echo $form->create('Node',array('type' => 'post','action'=> 'process'));
      echo "<table width='95%' cellspacing=0>";
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

       	      $path = $ivr['path'].$ivr['dir_node'];
	      $title    = $node['Node']['title'];
	      //$category = $node['Category']['name'];
	      $created  = $time->niceShort($node['Node']['created']);
	      $duration = $formatting->epochToWords($node['Node']['duration']);
	      $edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/nodes/edit/{$node['Node']['id']}",null, null, false);
	      $delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/nodes/delete/{$node['Node']['id']}",null, __("Are you sure you want to delete this content?",true),false);
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


     echo $html->tableCells($row);
     echo "</table>";
     echo $form->end();

     if($paginator->counter(array('format' => '%pages%'))>1){
           echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $html->div('paginator', __("Entries per page ",true).$html->link('10','index/limit:10',null, null, false)." | ".$html->link('25','index/limit:25',null, null, false)." | ".$html->link('50','index/limit:50',null, null, false));


     } else {
      	   echo $html->div('feedback', __("No content items exist. Please upload content by clicking the <i>Upload new</i> button to the right.",true));
     }

?>
