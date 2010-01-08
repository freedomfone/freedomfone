<?php

echo "<h1>".__("Polls",true)."</h1>";

echo $html->div("frameRight");
echo $html->link($html->image("icons/add.png", array("alt" => "Create new poll")),"/polls/add",null, null, false);
echo $form->create('Poll',array('type' => 'post','action'=> 'index'));
echo $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button'));
echo $form->end();
echo "</div>";

$session->flash();


echo $html->div("box", "To participate in a poll, send an sms to +39 340 47 80 434 or +39 333 677 45 32 or a Skype chat message to 'skypiax2' or 'skypiax4'");

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
	   $edit     = $html->link($html->image("icons/edit.png", array("alt" => "Edit")),"/polls/edit/{$poll['Poll']['id']}",null, null, false);
	   $delete   = $html->link($html->image("icons/delete.png", array("alt" => "Delete")),"/polls/delete/{$poll['Poll']['id']}",null, __("Are you sure you want to delete this poll?",true),false);


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