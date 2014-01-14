<?php
/****************************************************************************
 * archive.ctp	- List all archived Leave-a-message messages
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


echo $this->Html->addCrumb(__('Message Centre',true), '');
echo $this->Html->addCrumb(__('Archive',true), '/messages/');



 $this->Session->flash();

 echo $this->Html->script('toggle');
 echo "<h1>".__('Archived messages',true)."</h1>";

	if ($messages){

           echo $this->Html->div("",$this->Paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
           echo $this->Form->create('Message',array('type' => 'post','action'=> 'process','name'  => 'Message'));

           ?>
           <input type="button" name="CheckAll" value="<? echo __('Check All',true);?>" onClick="checkAll(document.Message)">
           <input type="button" name="UnCheckAll" value="<? echo __('Uncheck All',true);?>" onClick="uncheckAll(document.Message)">
           <?

           echo "<table width='95%' cellspacing  = '0'>";

           echo $this->Html->tableHeaders(array(
	        '',
	        $this->Paginator->sort('new', __("New",true)),
	        $this->Paginator->sort('instance_id', __("Service",true)),
 	        $this->Paginator->sort('title', __("Title",true)),
 	        $this->Paginator->sort('sender', __("Caller",true)),
 	        $this->Paginator->sort('rate', __("Rate",true)),
 	        $this->Paginator->sort('Category.name', __("Category",true)),
 	        $this->Paginator->sort('created', __("Date",true)),
 	        $this->Paginator->sort('length', __("Length",true)),
	        __("Actions",true),
	        __("Listen",true)));

          echo $this->Form->hidden('source',array('value'=>'archive'));


          foreach ($messages as $key => $message){

          $status='';
	  $id = "<input name='message[$key]['Message']' type='checkbox' value='".$message['Message']['id']."' id='check' class='check'>";
	

                if($message['Message']['new']){
                        $status = $this->Html->image("icons/star.png",array("title" => __("New",true)));
	        }

        $service  = $message['Message']['instance_id'];
	$title    = $message['Message']['title'];
	$sender   = $message['Message']['sender'];
	$rate     = $this->element('message_status',array('rate'=>$message['Message']['rate']));
	$category = $message['Category']['name'];
	$created  = $this->Time->niceShort($message['Message']['created']);
	$length   = $this->Formatting->epochToWords($message['Message']['length']);

	$edit     = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "messages", "action" => "edit", $message['Message']['id'])));
	$download = $this->Html->image("icons/music.png", array("alt" => __("Download",true), "title" => __("Download",true), "url" => array("controller" => "messages", "action" => "download", $message['Message']['id'])));

	$actions = array($edit.' '.$this->Access->showBlock($authGroup, $download ) ,array('align'=>'center'));


	$listen   = $this->element('player',array('url'=>$message['Message']['url'],'file'=>$message['Message']['file'],'title'=>$title,'id'=>$message['Message']['id']));

        $row[$key] = array(
     		$id,
     		array($status,array('align'=>'center')),
		$service,
                $title,
                $sender,
		array($rate,array('align'=>'center')),
		array($category,array('align'=>'center')),
		$created,		
		array($length,array('align'=>'center')),
                $actions,
		array($listen,array('align'=>'center')));
		

	}

     echo $this->Html->tableCells($row,array('class'=>'darker'));
     echo "</table>";


     echo "<table cellspacing = 0 class = 'none'>";
     echo $this->Html->tableCells(array(
          $this->Form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
          $this->Form->submit( __('Activate',true), array('name' =>'data[Submit]', 'class' => 'button')), 
          $this->Paginator->counter(array('format' => 'Page %page% of %pages%')),
          $this->Paginator->numbers()),array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo $this->Form->end();

     $total = $this->Paginator->counter(array('format' => '%count%'));;

     echo "<span>".__("No of messages per page: ",true);
     echo $this->Html->link('5','archive/limit:5',null, null, false)." | ";
     echo $this->Html->link('10','archive/limit:10',null, null, false)." | ";
     echo $this->Html->link('25','archive/limit:25',null, null, false)." | " ;
     echo $this->Html->link(__('All',true),'archive/limit:'.$total,null, null, false);
     echo "</span>";

     } else {

     echo $this->Html->div('feedback', __('No records found.',true));

     }



?>
