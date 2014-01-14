<?php
/****************************************************************************
 * index.ctp	- List nodes (aka Content for Voice Menus and Selectors)
 * version 	- 3.0.1500
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

echo $this->Html->addCrumb(__('IVR Centre',true), '');
echo $this->Html->addCrumb(__('Content',true), '/nodes');


$ivr = Configure::read('IVR_SETTINGS');


$this->Access->showButton($authGroup, 'Node', 'add', 'frameRightTrans', __('Upload new',true), 'submit', 'button');


  echo "<h1>".__('Content',true)."</h1>";
  echo $this->Session->flash();

   if ($nodes){


      echo $this->Html->div("paginator",$this->Paginator->counter(array('format' => __("Entry:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));  
      echo $this->Html->div("empty", false);  
      echo $this->Form->create('Node',array('type' => 'post','action'=> 'process'));
      echo "<table width='95%' cellspacing=0>";
      echo $this->Html->tableHeaders(array(
 	$this->Paginator->sort('title', __("Title",true)),
 	//$this->Paginator->sort('Category.name', __("Category",true)),
 	$this->Paginator->sort('created', __("Created",true)),
	__("Duration",true),
	__("Actions",true),
	__("Listen",true)));

      echo $this->Form->hidden('source',array('value'=>'index'));

      foreach ($nodes as $key => $node){

       	      $path = $ivr['path'].$ivr['dir_node'];
	      $title    = $node['Node']['title'];
	      //$category = $node['Category']['name'];
	      $created  = $this->Time->niceShort($node['Node']['created']);
	      $duration = $this->Formatting->epochToWords($node['Node']['duration']);
	      $edit     = $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "nodes", "action" => "edit", $node['Node']['id']))));
              $delete   = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "nodes", "action" => "delete", $node['Node']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this content?',true)."');")));
	      $download = $this->Access->showBlock($authGroup, $this->Html->image("icons/music.png", array("alt" => __("Download",true), "title" => __("Download",true), "url" => array("controller" => "nodes", "action" => "download", $node['Node']['id']))));

	      $listen   = $this->element('player',array('path'=>$path,'file'=>$node['Node']['file'],'title'=>$title, 'id'=> $node['Node']['id']));
     	      $row[$key] = array(
		array($title,array('align'=>'left')),
		array($created,array('align'=>'left','width'=>'125px')),
		array($duration,array('align'=>'left','width'=>'80px')),
		array($edit.' '.$delete.' '.$download,array('align'=>'center','width'=>'90px')),
		array($listen,array('align'=>'left','width'=>'200px')));	

	}


     echo $this->Html->tableCells($row);
     echo "</table>";
     echo $this->Form->end();

     if($this->Paginator->counter(array('format' => '%pages%'))>1){
           echo $this->Html->div('paginator', $this->Paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$this->Paginator->numbers().' '.$this->Paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $this->Html->div('paginator', __("Entries per page ",true).$this->Html->link('10','index/limit:10',null, null, false)." | ".$this->Html->link('25','index/limit:25',null, null, false)." | ".$this->Html->link('50','index/limit:50',null, null, false));


     } else {
      	   echo $this->Html->div('feedback', __("No content items exist. Please upload content by clicking the <i>Upload new</i> button to the right.",true));
     }

?>
