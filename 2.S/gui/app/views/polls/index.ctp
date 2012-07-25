<?php
/****************************************************************************
 * index.ctp	- List polls with view, edit and delete options
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
echo $html->addCrumb(__('Polls',true), '/polls');

    $session->flash();

   echo $form->create('Poll',array('type' => 'post','action'=> 'index'));
   echo $html->div('frameRightAlone', $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
   echo $form->end();


   $this->Access->showButton($authGroup, 'Poll', 'add', 'frameRightTrans', __('Create new',true), 'submit', 'button');
   $info = $html->link(
                        $this->Html->image("icons/bulb.png"),
                        "/pages/polls/tip",
                        array("escape" => false, "title" => __("Tool tip", true), "onClick" => "Modalbox.show(this.href, {title: this.title, width: 500}); return false;"),
                        false);

   echo $html->div('frameInfo', $info);

   echo "<h1>".__("Polls",true)."</h1>";

   // Multiple Flash messages
   if ($messages = $this->Session->read('Message')) {
       foreach($messages as $key => $value) {
              echo $this->Session->flash($key);
       }
    }


   if ($polls){

     foreach ($polls as $key => $poll){

     	     $votes=$poll['Poll']['invalid_open'];
     	     foreach($poll['Vote'] as $option){
	    
		$votes = $votes + $option['chvotes'];
	     
	     }

	   $question = $html->link($poll['Poll']['question'],"/polls/view/{$poll['Poll']['id']}");
	   $code     = $poll['Poll']['code'];
	   $start    = $time->format('Y/m/d H:i',$poll['Poll']['start_time']);
	   $end      = $time->format('Y/m/d H:i',$poll['Poll']['end_time']);

           $view = $html->link(
                        $this->Html->image("icons/view.png"),
                        "/polls/view/".$poll['Poll']['id'],
                        array("escape" => false, "title" => __("View results", true), "onClick" => "Modalbox.show(this.href, {title: this.title, width: 500}); return false;"),
                        false);



           $edit     = $this->Access->showBlock($authGroup , $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "polls", "action" => "edit", $poll['Poll']['id']))));

           $delete   = $this->Access->showBlock($authGroup, $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "polls", "action" => "delete", $poll['Poll']['id']), "onClick" => "return confirm('".__('Are you sure you wish to delete this poll?',true)."');")));


           $row[$key] = array(
     		array($this->element('poll_status',array('status'=>$poll['Poll']['status'],'mode'=>'image')),array('align'=>'center')),
                array($question,array('align'=>'left','width' => '200px')),
                array($code,array('align'=>'center','width' => '50px')),
		array($votes,array('align' =>'center')),
		array($start,array('align' =>'center', 'width' => '100px')),
		array($end,array('align' =>'center', 'width' => '100px')),
		array($view.' '.$edit.' '.$delete,array('align'=>'center','width' => '100px')));

     }

    echo "<table cellspacing =0>";
    echo $html->tableHeaders(array(__("Status",true),__("Question",true),__("Code",true),__("Total Votes",true),__("Open",true),__("Close",true),__("Actions",true)), false, array('align' => 'center'));
    echo $html->tableCells($row);
    echo "</table>";

    echo $html->div('system_time',__('System time',true).' : '.$time->format('H:i:s A (e \G\M\T O)',time()));

   }  else {

        echo $html->div('feedback', __('No polls exist. Please create one by clicking the <i>Create new</i> button to the right.',true));

   }

?>