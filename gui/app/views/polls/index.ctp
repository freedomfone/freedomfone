<?php
/****************************************************************************
 * index.ctp	- List polls with view, edit and delete options
 * version 	- 2.0.1160
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
echo $html->addCrumb('Polls', '/polls');

    $session->flash();
    $info = __("Poll|The Poll service allows end users to participate in polls by sending SMSs to Freedom Fone.<p>The Freedom Fone administrator has the ability to create, edit and delete polls.<p>The administrator can at any time edit the above listed fields. Of course, it is not recommended to change the question, code or answers to a poll, once it has been opened to the public.<p>Before a poll is opened, and after it has been closed, no poll votes are registered for the poll. <p>For each poll, once it has started, the administrator can at anytime, view the interim or final result in terms of number of votes per answer, and percentage of total votes per answer.",true);

   echo $form->create('Poll',array('type' => 'post','action'=> 'index'));
   echo $html->div('frameRightAlone', $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
   echo $form->end();

   echo $form->create('Poll',array('type' => 'post','action'=> 'add'));
   echo $html->div('frameRightAlone',$form->submit(__('Create new',true),  array('name' =>'submit', 'class' => 'button')));
   echo $form->end();

   echo $html->div('frameInfo', $html->link($html->image('icons/bulb.png',array('alt'=>'Tooltips')),'#',array('class'=>'infobox','title'=>$info),null,false)); 
   echo "<h1>".__("Polls",true)."</h1>";

  if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
  }


  if ($polls){



     foreach ($polls as $key => $poll){

     	     $votes=0;

     	     foreach($poll['Vote'] as $option){
	    
		$votes = $votes + $option['chvotes'];
	     
	     }

	   $question = $html->link($poll['Poll']['question'],"/polls/view/{$poll['Poll']['id']}");
	   $code     = $poll['Poll']['code'];
	   $start    = $time->format('Y/m/d H:i',$poll['Poll']['start_time']);
	   $end      = $time->format('Y/m/d H:i',$poll['Poll']['end_time']);
	   $view     = $html->link($html->image("icons/view.png", array("title" => __("View",true))),"/polls/view/{$poll['Poll']['id']}",null, null, false);
	   $edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/polls/edit/{$poll['Poll']['id']}",null, null, false);
	   $delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/polls/delete/{$poll['Poll']['id']}",null, __("Are you sure you want to delete this poll?",true),false);


     $row[$key] = array(
     		array($this->element('poll_status',array('status'=>$poll['Poll']['status'],'mode'=>'image')),array('align'=>'center')),
		$question,array($code,array('align'=>'left')),
		array($votes,array('align' =>'center')),
		$start,
		$end,
		array($view,array('align'=>'center')),
		array($edit,array('align'=>'center')),
		array($delete,array('align'=>'center')));

     }

    echo "<table width='90%' cellspacing =0>";
    echo $html->tableHeaders(array(__("Status",true),__("Question",true),__("Code",true),__("Votes",true),__("Open",true),__("Close",true),__("View",true),__("Edit",true),__("Delete",true)));
    echo $html->tableCells($row);
    echo "</table>";

     echo $html->div('system_time',__('System time',true).' : '.$time->format('H:i:s A (e \G\M\T O)',time()));

   }


   else {

        echo $html->div('feedback', __('No polls exist. Please create one by clicking the <i>Create new</i> button to the right.',true));

   }
 




?>