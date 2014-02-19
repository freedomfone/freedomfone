<?php 
/****************************************************************************
 * exit.ctp	- Edit a Leave-a-message messages
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

    $source  = $this->Session->read('Message.source');
    $sort  = $this->Session->read('messages_sort');


    if($source == 'archive') { $location = __('Archive',true);} else { $location = __('Inbox',true);}

    if(!isset($keys)){
        $keys = $this->Session->read('messages_selected');
    }

    echo $this->Html->addCrumb(__('Message Centre',true), '/messages');
    echo $this->Html->addCrumb($location, '/messages/'.$source);
    echo $this->Html->addCrumb(__('Edit message',true), '/messages/edit/'.$data['Message']['id']);


    $current = array_keys($keys,$data['Message']['id']); 
    $prev = $next = false;

      
    if($data){

	$options_rate = array('options' => array ( '1'=>1 ,'2'=> 2 , '3'=> 3 , '4'=>4 ,'5'=> 5 ),
		      'label'   => false,
		      'empty'   => "--- ".__('No rate',true)." ---");

        $options_status = array('options' => array ('1'=>__("Active",true),'0'=>__("Archive",true)),
          'label'   => false);


     if($current[0]-1 >= 0){

          if (array_key_exists($current[0]-1,$keys)) {
      	     $prev = $this->Html->link("« ".__("Previous message",true),"edit/".$keys[$current[0]-1],array('class'=>'subTitles'));
	  }
     }

     if (array_key_exists($current[0]+1, $keys)) {
     	$next = $this->Html->link(__("Next message",true)." »","edit/".$keys[$current[0]+1]);
     }

     echo "<div class='frameRightAlone'>";
     if ($prev && $next){ echo $prev." | ".$next;}
        elseif ($prev) { echo $prev;}
        elseif ($next) { echo $next;}
        echo "</div>";

     echo "<h1>".__("Edit Message",true)."</h1>";


     //** START LEFT FRAME **//
     echo "<div class='frameLeft'>";
     echo $this->Session->flash();


     echo $this->Form->create('Message',array('type' => 'post','action'=> 'edit'));
     echo "<table width='300px' cellspacing= 0 class ='blue'>";
     echo $this->Form->hidden('new',array('value'=>0));
     echo $this->Form->hidden('source',array('value'=>$source));
     echo $this->Form->input('id',array('type'=>'hidden','value'=>$this->data['Message']['id']));

     echo $this->Html->tableCells(array (
     array(__("Title",true),	$this->Form->input('title',array('label'=>false,'size'=>'45'))),
     array(__("Status",true),	$this->Form->input('status',$options_status)),

     array(__("Rate",true),	$this->Form->input('rate',$options_rate)),
     array(__("Category",true),	$this->Form->input('category_id',array('type'=>'select','options'=>$categories, 'empty'=>"--- ".__('No category',true)." ---",'label'=>false))),
     array(array(__("Comment",true),array('valign'=>'top')),	$this->Form->input('comment',array('type'=>'textarea','label'=>false,'cols'=>45))),
     array(array(__("Tag",true),array('valign'=>'top')),	$this->Form->input('Tag',array('type'=>'select','multiple'=>'true','size' => 5, 'label'=>false,'empty'=>"--- ".__("No tag",true)." ---"))),
     ),array('class' => 'blue'), array('class' => 'blue'));
     echo "</table>";

     $button[] = $this->Form->submit(__('Save',true),  array('name' =>'data[Submit]', 'title'=>__('Save',true),'class' => 'save_button'));
     $button[] = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "messages", "action" => "delete", $data['Message']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this message?',true)."');"));


     echo "<table class= 'blue' cellspacing = 0>";
     echo $this->Html->tableCells(array($button),array('class'=>'blue'),array('class'=>'blue'));
     echo "</table>";
     echo $this->Form->end(); 
     echo "</div>";
     //** END LEFT FRAME **//


     //** START RIGHT FRAME **//
     echo "<div class='frameRight'>";
     echo "<table cellspacing =0 class ='blue'>";;
     echo $this->Html->tableCells(array (
     array(__("Created",true),	date('Y-m-d H:i:s',$data['Message']['created'])),
     array(__("Modified",true), $modified = $this->element('message_status',array('modified'=>$data['Message']['modified']))),
     array(__("Length",true),   $this->Formatting->epochToWords($data['Message']['length'])),
     array(__("Caller",true),   $this->Access->showBlock($authGroup, $data['Message']['sender'])),
     array(__("Quick hangup",true), $this->element('message_status',array('quickHangup' => $data['Message']['quick_hangup']))),
     array(__("Download",true), $this->Access->showBlock($authGroup, $this->Html->image("icons/music.png", array("alt" => __("Download",true), "title" => __("Download",true), "url" => array("controller" => "messages", "action" => "download", $data['Message']['id']))))),
     array(__("Listen",true),	$this->element('player',array('url'=>$data['Message']['url'],'file'=>$data['Message']['file'],'title'=>$data['Message']['title'],'id'=>$data['Message']['id'])))
     ),array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo "</div>";
     //** END RIGHT FRAME **//
}
    else {

         echo $this->Html->div("invalid_entry", __("This page does not exist.",true));


    }

 

?>

