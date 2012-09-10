<?php
/****************************************************************************
 * archive.ctp	- List all archived Leave-a-message messages
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

echo $html->addCrumb(__('Message Centre',true), '');
echo $html->addCrumb(__('Archive',true), '/messages/');



 $session->flash();

 echo $javascript->includeScript('toggle');
 echo "<h1>".__('Archived messages',true)."</h1>";

	if ($messages){

           echo $html->div("",$paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
           echo $form->create('Message',array('type' => 'post','action'=> 'process','name'  => 'Message'));

           ?>
           <input type="button" name="CheckAll" value="<? echo __('Check All',true);?>" onClick="checkAll(document.Message)">
           <input type="button" name="UnCheckAll" value="<? echo __('Uncheck All',true);?>" onClick="uncheckAll(document.Message)">
           <?

           echo "<table width='95%' cellspacing  = '0'>";

           echo $html->tableHeaders(array(
	        '',
	        $paginator->sort(__("New",true), 'new'),
	        $paginator->sort(__("Service",true), 'instance_id'),
 	        $paginator->sort(__("Title",true), 'title'),
 	        $paginator->sort(__("Caller",true), 'sender'),
 	        $paginator->sort(__("Rate",true), 'rate'),
 	        $paginator->sort(__("Category",true), 'Category.name'),
 	        $paginator->sort(__("Date",true), 'created'),
 	        $paginator->sort(__("Length",true), 'length'),
		'',
		'',
	        __("Listen",true)));

          echo $form->hidden('source',array('value'=>'archive'));


          foreach ($messages as $key => $message){

          $status='';
	  $id = "<input name='message[$key]['Message']' type='checkbox' value='".$message['Message']['id']."' id='check' class='check'>";
	

                if($message['Message']['new']){
                        $status = $html->image("icons/star.png",array("title" => __("New",true)));
	        }

	$service  = $message['Message']['instance_id'];
	$title    = $message['Message']['title'];
	$sender   = $message['Message']['sender'];
	$rate     = $this->element('message_status',array('rate'=>$message['Message']['rate']));
	$category = $message['Category']['name'];
	$created  = $time->niceShort($message['Message']['created']);
	$length   = $formatting->epochToWords($message['Message']['length']);
	$edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/messages/edit/{$message['Message']['id']}",null, null, false);
	$download  = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/messages/download/{$message['Message']['id']}",null, null, false);
	$listen   = $this->element('player',array('url'=>$message['Message']['url'],'file'=>$message['Message']['file'],'title'=>$title,'id'=>$message['Message']['id']));

        $row[$key] = array(
     		$id,
     		array($status,array('align'=>'center')),
     		array($service,array('align'=>'center')),
		$title,
                $sender,
		array($rate,array('align'=>'center')),
		array($category,array('align'=>'center')),
		$created,		
		array($length,array('align'=>'center')),
		array($edit,array('align'=>'center')),
		array($download,array('align'=>'center')),
		array($listen,array('align'=>'center')));
		

	}

     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";


     echo "<table cellspacing = 0 class = 'none'>";
     echo $html->tableCells(array(
          $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
          $form->submit( __('Activate',true), array('name' =>'data[Submit]', 'class' => 'button')), 
          $paginator->counter(array('format' => 'Page %page% of %pages%')),
          $paginator->numbers()),array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo $form->end();

     $total = $paginator->counter(array('format' => '%count%'));;

     echo "<span>".__("No of messages per page: ",true);
     echo $html->link('5','archive/limit:5',null, null, false)." | ";
     echo $html->link('10','archive/limit:10',null, null, false)." | ";
     echo $html->link('25','archive/limit:25',null, null, false)." | " ;
     echo $html->link(__('All',true),'archive/limit:'.$total,null, null, false);
     echo "</span>";

     } else {

     echo $html->div('feedback', __('No records found.',true));

     }



?>
