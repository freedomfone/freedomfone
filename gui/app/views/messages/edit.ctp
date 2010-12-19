<?php 
/****************************************************************************
 * exit.ctp	- Edit a Leave-a-message messages
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

$source  = $session->read('Message.source');
$sort  = $session->read('messages_sort');

      $Prev = 'prev';
      $Next = 'next';

      if($sort){
	if(current($sort)=='desc'){
		$Prev = 'next';
      		$Next = 'prev';
		}
      }

      if($data){
	$options_rate = array('options' => array ( '1'=>1 ,'2'=> 2 , '3'=> 3 , '4'=>4 ,'5'=> 5 ),
		      'label'   => false,
		      'empty'   => "--- ".__('No rate',true)." ---");


        $options_status = array('options' => array ('1'=>__("Active",true),'0'=>__("Archive",true)),
		          'label'   => false);



     if ($prev = $neighbors[$Prev]['Message']['id']) {     	  
	  $prev = $html->link(__("« Older message",true),"edit/".$prev,array('class'=>'subTitles'));
	  }

     if ($next = $neighbors[$Next]['Message']['id']){
     	$next = $html->link(__("Newer message »",true),"edit/".$next);
     }




     echo "<div class='frameRightAlone'>";
     if ($prev && $next){ echo $prev." | ".$next;}
        elseif ($prev) { echo $prev;}
        elseif ($next) { echo $next;}
        echo "</div>";

     echo "<h1>".__("Edit Message",true)."</h1>";




     //** START LEFT FRAME **//
     echo "<div class='frameLeft'>";


   	  if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
         }


     echo $form->create('Message',array('type' => 'post','action'=> 'edit'));
     echo "<table width='300px' cellspacing= 0 class ='blue'>";
     echo $form->hidden('new',array('value'=>0));
     echo $form->hidden('next',array('value'=>$neighbors[$Next]['Message']['id']));
     echo $form->hidden('prev',array('value'=>$neighbors[$Prev]['Message']['id']));
     echo $form->hidden('source',array('value'=>$source));
     echo $form->input('id',array('type'=>'hidden','value'=>$this->data['Message']['id']));


     echo $html->tableCells(array (
     array(__("Title",true),	$form->input('title',array('label'=>false,'size'=>'45'))),
     array(__("Status",true),	$form->input('status',$options_status)),
     array(__("Rate",true),	$form->input('rate',$options_rate)),
     array(__("Tag",true),	$form->input('Tag',array('type'=>'select','multiple'=>'true','label'=>false,'empty'=>"--- ".__("No tag",true)." ---"))),
     array(__("Category",true),	$form->input('category_id',array('type'=>'select','options'=>$categories, 'empty'=>"--- ".__('No category',true)." ---",'label'=>false))),
     array(array(__("Comment",true),array('valign'=>'top')),	$form->input('comment',array('type'=>'textarea','label'=>false,'cols'=>45))),
     ),array('class' => 'blue'), array('class' => 'blue'));
     echo "</table>";

     $button[] = $form->submit(__('Save',true),  array('name' =>'data[Submit]', 'title'=>__('Save',true),'class' => 'button'));
     $button[]   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/messages/delete/{$data['Message']['id']}",null, __("Are you sure you want to delete this message?",true),false);
     echo "<table class= 'blue' cellspacing = 0>";
     echo $html->tableCells(array($button),array('class'=>'blue'),array('class'=>'blue'));
     echo "</table>";
     echo $form->end(); 
     echo "</div>";
     //** END LEFT FRAME **//


     //** START RIGHT FRAME **//
     echo "<div class='frameRight'>";
     echo "<table cellspacing =0 class ='blue'>";;
     echo $html->tableCells(array (
     array(__("Created",true),	$time->nice($data['Message']['created'])),
     array(__("Modified",true), $modified = $this->element('message_status',array('modified'=>$data['Message']['modified']))),
     array(__("Length",true),   $formatting->epochToWords($data['Message']['length'])),
     array(__("Sender",true),   $data['Message']['sender']),
     array(__("Quick hangup",true), $this->element('message_status',array('quickHangup' => $data['Message']['quick_hangup']))),
     array(__("Download",true), $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/messages/download/{$data['Message']['id']}",null, null, false)),
    array(__("Listen",true),	$this->element('player',array('url'=>$data['Message']['url'],'file'=>$data['Message']['file'],'title'=>$data['Message']['title'],'id'=>$data['Message']['id'])))
     ),array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo "</div>";
     //** END RIGHT FRAME **//
}
    else {

    echo "<h1>".__("No messsage with this id exists",true)."</h1>";
    }

 

?>

