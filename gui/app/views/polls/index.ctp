<?php
/****************************************************************************
 * index.ctp	- List polls with view, edit and delete options
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

echo "<h1>".__("Polls",true)."</h1>";
$session->flash();
echo $form->create('Poll',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRight', $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();
echo $html->div('frameRight',$html->link($html->image("icons/add.png", array("title" => __("Create new poll",true))),"/polls/add",null, null, false));





  if ($polls){

  echo "<table width='100%'>";
  echo $html->tableHeaders(array(__("Status",true),__("Question",true),__("Code",true),__("Valid votes",true),__("Open",true),__("Close",true),__("Edit",true),__("Delete",true)));


     foreach ($polls as $key => $poll){

     	     $votes=0;

     	     foreach($poll['Vote'] as $option){
	    
		$votes = $votes + $option['chvotes'];
	     
	     }

	   $question = $html->link($poll['Poll']['question'],"/polls/view/{$poll['Poll']['id']}");
	   $code     = $poll['Poll']['code'];
	   $start    = $time->niceShort($poll['Poll']['start_time']);
	   $end      = $time->niceShort($poll['Poll']['end_time']);
	   $edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/polls/edit/{$poll['Poll']['id']}",null, null, false);
	   $delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/polls/delete/{$poll['Poll']['id']}",null, __("Are you sure you want to delete this poll?",true),false);


     $row[$key] = array(
     		array($this->element('poll_status',array('status'=>$poll['Poll']['status'],'mode'=>'image')),array('align'=>'center')),
		$question,array($code,array('align'=>'left')),
		array($votes,array('align' =>'center')),
		$start,
		$end,
		array($edit,array('align'=>'center')),
		array($delete,array('align'=>'center')));

     }

    echo $html->tableCells($row,array('class'=>'darker'));
    echo "</table>";

   echo $html->div('box',__('System time',true).": ".$time->format('H:i:s A (e \G\M\T O) ', time()));
   }


   else {

   echo "<div class='instruction'>".__("No polls exists. Please create one by click on the green button to the right.")."</div>";


   }
 




?>