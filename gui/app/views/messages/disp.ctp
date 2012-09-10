<?php
/****************************************************************************
 * disp.ctp	- List all Leave-a-message messages
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

echo $ajax->div("service_div");


echo $form->create('Message',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRightAlone', $form->submit(__('Refresh',true),  array('name' =>'disp', 'class' => 'button')));
echo $form->end();
echo $this->Access->showCheckbox($authGroup, 'document.Message','frameRightTrans');

$ext = Configure::read('EXTENSIONS');


     if ($messages){

     echo $html->div("",$paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% "))); 
     echo $form->create('Message',array('type' => 'post','action'=> 'process','name'  => 'Message'));
     echo $form->hidden('source',array('value'=>'index'));


     echo $html->div('empty',false);
     echo "<table width='95%' cellspacing  = '0'>";
     echo $html->tableHeaders(array(
	'',
	__("New",true),
 	__("Service",true),
 	__("Title",true),
 	__("Caller",true),
 	__("Rate",true),
 	__("Category",true),
 	__("Date",true),
 	__("Length",true),
        __("Actions",true),
	__("Listen",true)));

 
      foreach ($messages as $key => $message){

        $status='';
	$id = "<input name='message[$key]['Message']' type='checkbox' value='".$message['Message']['id']."' id='check' class='check'>";

	if($message['Message']['new']){ $status = $html->image("icons/star.png",array("title" => __("New",true)));}
        $service      = $message['Message']['instance_id'];
        $title      = $message['Message']['title'];
        $title_div  = $html->div('',$text->truncate($title,20,array('ending' => '...','exact' => true,'html' => false)),array('title' => $title),false);
	$sender     = $this->Access->showBlock($authGroup, $message['Message']['sender']);
	$rate       = $this->element('message_status',array('rate'=>$message['Message']['rate']));
	$category   = $message['Category']['name'];
	$created    = date('y/m/d H:i',$message['Message']['created']);
	$length     = $formatting->epochToWords($message['Message']['length']);

        $edit       = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "messages", "action" => "edit", $message['Message']['id'])));
        $download   = $this->Html->image("icons/music.png", array("alt" => __("Download",true), "title" => __("Download",true), "url" => array("controller" => "messages", "action" => "download", $message['Message']['id'])));
	$listen     = $this->element('player',array('url'=>$message['Message']['url'],'file'=>$message['Message']['file'],'title'=>$title,'id'=>$message['Message']['id']));

        $row[$key] = array($id,
     		array($status,array('align'=>'center')),
                array($ext['lam'].$service,array('align'=>'center')),
		array($title_div, array('width' => '110px')),
                $sender,
		array($rate,array('align'=>'center')),
		array($category,array('align'=>'center')),
		$created,		
		array($length,array('align'=>'center')),
		array($edit.' '.$this->Access->showBlock($authGroup, $download ) ,array('align'=>'center')),
		array($listen,array('align'=>'center')));
		

	}


     echo $html->tableCells($row);
     echo "</table>";

     if($authGroup == 1) {
                   echo "<table cellspacing = 0 class = 'none'>";
                   echo $html->tableCells(array(__('Perform action on selected',true).': ',
                   $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
                   $form->submit( __('Move to Archive',true), array('name' =>'data[Submit]', 'class' => 'button'))),array('class' => 'none'),array('class' => 'none'));
                   echo "</table>";
     }

     echo $form->end();


     $total = $this->Paginator->counter(array('format' => '%pages%'));
     if($total >1){

        $current = $this->Paginator->current();
        $prev = $next = false;

        if($current > 1) {
                    $prev = $ajax->link('«'.__('Previous',true),"/messages/disp/".($current-1), array('update' => 'service_div'), null, 1);
        }
        if($total > $current){
                  $next = $ajax->link(__('Next',true).'»','/messages/disp/'.($current+1), array('update' => 'service_div'), null, 1);
        }
        echo  $html->div('paginator', $prev." ".$next);


    }


     } else {

     echo $html->div('feedback', __('No records found.',true));

     }

     echo $ajax->divEnd('service_div');
?>