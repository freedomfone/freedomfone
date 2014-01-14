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
echo $this->Html->addCrumb(__('Polls',true), '/polls');


    $this->Session->flash();

   echo $this->Form->create('Poll',array('type' => 'post','action'=> 'index'));
   echo $this->Html->div('frameRightAlone', $this->Form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
   echo $this->Form->end();


   $this->Access->showButton($authGroup, 'Poll', 'add', 'frameRightTrans', __('Create new',true), 'submit', 'button');
   $info = $this->Html->link(
                        $this->Html->image("icons/bulb.png"),
                        "/pages/polls/tip",
                        array("escape" => false, "title" => __("Tool tip", true), "onClick" => "Modalbox.show(this.href, {title: this.title, width: 500}); return false;"),
                        false);

   echo $this->Html->div('frameInfo', $info);

   echo "<h1>".__("Polls",true)."</h1>";
   echo $this->Session->flash();


   if ($polls){

     foreach ($polls as $key => $poll){

     	     $votes=$poll['Poll']['invalid_open'];
     	     foreach($poll['Vote'] as $option){
	    
		$votes = $votes + $option['chvotes'];
	     
	     }

	   $question = $this->Html->link($poll['Poll']['question'],"/polls/view/{$poll['Poll']['id']}");
	   $code     = $poll['Poll']['code'];
	   $start    = $this->Time->format('Y/m/d H:i',$poll['Poll']['start_time']);
	   $end      = $this->Time->format('Y/m/d H:i',$poll['Poll']['end_time']);

           $view = $this->Html->link(
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
		array($start,array('align' =>'center', 'width' => '150px')),
		array($end,array('align' =>'center', 'width' => '150px')),
		array($view.' '.$edit.' '.$delete,array('align'=>'center','width' => '100px')));

     }

    echo "<table cellspacing =0 width='90%'>";
    echo $this->Html->tableHeaders(array(__("Status",true),__("Question",true),__("Code",true),__("Total Votes",true),__("Open",true),__("Close",true),__("Actions",true)), false, array('align' => 'center'));
    echo $this->Html->tableCells($row);
    echo "</table>";

    echo $this->Html->div('system_time',__('System time',true).' : '.$this->Time->format('H:i:s A (e \G\M\T O)',time()));

   }  else {

        echo $this->Html->div('feedback', __('No polls exist. Please create one by clicking the <i>Create new</i> button to the right.',true));

   }

?>