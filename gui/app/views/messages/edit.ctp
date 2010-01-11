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

      if($data){

	$options_rate = array('options' => array ( '1'=>1 ,'2'=> 2 , '3'=> 3 , '4'=>4 ,'5'=> 5 ),
		      'label'   => false,
		      'empty'   => __('-Set rate-',true));


        $options_status = array('options' => array ('1'=>__("Active",true),'0'=>__("Archive",true)),
		          'label'   => false);


     echo "<div class='frameRight'>";
     if ($prev = $neighbors['prev']['Message']['id']) {     	  
	  echo $html->link(__("« Previous ",true),"edit/".$prev,array('class'=>'subTitles'));
	  }
     echo " | ";
     if ($next = $neighbors['next']['Message']['id']){
     	echo $html->link(__("Next »",true),"edit/".$next);
     }
     echo "</div>";

     echo "<h1>".__("Edit Message",true)."</h1>";

     echo "<fieldset>";

     echo "<div class='frameLeft'>";
  
     echo $form->create('Message',array('type' => 'post','action'=> 'edit'));
     echo "<table>";
     echo $form->hidden('new',array('value'=>0));
     echo $form->hidden('next',array('value'=>$neighbors['next']['Message']['id']));
     echo $form->hidden('source',array('value'=>$source));

            $button1 = $form->submit(__('Save & Index',true),  array('name' =>'data[Submit]', 'class' => 'button'));
	if ($next){
            $button2 = $form->submit(__('Save & Next',true),   array('name' =>'data[Submit]', 'class' => 'button'));
	}
	else {
            $button2='';
		}

     echo $html->tableCells(array (
     array(__("Title",true),	$form->input('title',array('label'=>false))),
     array(__("Status",true),	$form->input('status',$options_status)),
     array(__("Rate",true),	$form->input('rate',$options_rate)),
     array(__("Tag",true),	$form->input('Tag',array('type'=>'select','multiple'=>'true','label'=>false))),
     array(__("Category",true),	$form->input('category_id',array('type'=>'select','options'=>$categories, 'empty'=>__('-Select category-',true),'label'=>false))),
     array( $button1, $button2)
     ));
  
     echo "</table>";
     echo $form->end(); 
    echo "</div>";

     echo "<div class='frameRight'>";
     echo "<table>";
     echo $html->tableCells(array (
     array(__("Created",true),	$time->nice($data['Message']['created'])),
     array(__("Modified",true), $modified = $this->element('message_status',array('modified'=>$data['Message']['modified']))),
     array(__("Length",true),   $formatting->epochToWords($data['Message']['length'])),
     array(__("Author",true),   $data['Message']['sender']),
     array(__("Listen",true),	$this->element('musicplayer_button',array('url'=>$data['Message']['url'],'file'=>$data['Message']['file'],'title'=>$data['Message']['title'])))
     ));
     echo "</table>";
     echo "</div>";
    echo "</fieldset>";
}
    else {

    echo "<h1>".__("No messsage with this id exists",true)."</h1>";
    }

 

?>

