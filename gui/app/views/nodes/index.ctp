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

echo $html->addCrumb(__('IVR Centre',true), '');
echo $html->addCrumb(__('Content',true), '/nodes');


$ivr = Configure::read('IVR_SETTINGS');


$this->Access->showButton($authGroup, 'Node', 'add', 'frameRightTrans', __('Upload new',true), 'submit', 'button');


  echo "<h1>".__('Content',true)."</h1>";


        // Multiple Flash messages
        if ($messages = $this->Session->read('Message')) {
                foreach($messages as $key => $value) {
                 echo $this->Session->flash($key);
                }
        }




   if ($nodes){


      echo $html->div("paginator",$paginator->counter(array('format' => __("Entry:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));  
      echo $this->Html->div("empty", false);  
      echo $form->create('Node',array('type' => 'post','action'=> 'process'));
      echo "<table width='95%' cellspacing=0>";
      echo $html->tableHeaders(array(
 	$paginator->sort(__("Title",true), 'title'),
 	//$paginator->sort(__("Category",true), 'Category.name'),
 	$paginator->sort(__("Created",true), 'created'),
	__("Duration",true),
	__("Actions",true),
	__("Listen",true)));

      echo $form->hidden('source',array('value'=>'index'));

      foreach ($nodes as $key => $node){

       	      $path = $ivr['path'].$ivr['dir_node'];
	      $title    = $node['Node']['title'];
	      //$category = $node['Category']['name'];
	      $created  = $time->niceShort($node['Node']['created']);
	      $duration = $formatting->epochToWords($node['Node']['duration']);
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
