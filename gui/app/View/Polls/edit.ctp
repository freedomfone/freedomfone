<?php
/****************************************************************************
 * edit.ctp	- Edit existing poll
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


     if($this->data){
           echo $this->Html->addCrumb(__('Edit',true), '/polls/edit/'.$this->data['Poll']['id']);
	   echo "<h1>".__("Edit Poll",true)."</h1>";

	   $this->Session->flash();

           echo $this->Html->div('frameLeft');

           //** START POLL GENERAL **//
         
	   echo $this->Form->create('Poll',array('type' => 'post','action'=> 'edit'));
           echo $this->Form->submit(__('Save',true),  array('name' =>'data[Submit]', 'class' => 'save_button'));
	   echo $this->Form->input('id',array('type' => 'hidden','value'=> $this->data['Poll']['id']));
   	   echo $this->Form->input('invalid_open',array('type' => 'hidden','value'=> $this->data['Poll']['invalid_open']));
   	   echo $this->Form->input('invalid_early',array('type' => 'hidden','value'=> $this->data['Poll']['invalid_early']));
	   echo $this->Form->input('invalid_closed',array('type' => 'hidden','value'=> $this->data['Poll']['invalid_closed']));


	   echo "<table cellspacing='0' class='blue'>";
	   echo $this->Html->tableCells(array (
     	   	array(__("Question",true),	$this->Form->input('question',array('label'=>false,'size' => 70))),
     		array(array(__("Define a concrete question using simple language",true),"colspan='2' class='formComment'")),
     		array(__("SMS Code",true),	$this->Form->input('code',array('label'=>false))),
    		array(array(__("Alpha-numeric characters only (maximum 10)",true),"colspan='2' class='formComment'")),
     		),array('class' => 'blue'),array('class' => 'blue'));
	  echo "</table>";

          //** END POLL GENERAL **//


          //** START POLL OPTIONS **// 
	  echo "<h2>".__("Start and end time",true)."</h2>";
	  echo $this->Html->div('formComment', __("When would you like to open and close the poll?",true));

	  echo "<table cellspacing ='0' class='blue'>";
	  echo $this->Html->tableCells(array (
     	     array(__("Start time",true),	$this->Form->input('start_time',array('label'=>false))),
     	     array(__("End time",true),		$this->Form->input('end_time',array('label'=>false)))
      	     ),array('class' => 'blue'),array('class' => 'blue'));
	  echo "</table>";
          echo $this->Form->end();





     echo "<h2>".__("Poll options",true)."</h2>";
     echo "<div class='formComment'>".__("Alpha-numeric characters only (maximum 10)",true)."</div>";
     echo "<div class='formComment'>".__("Please note that all votes associated with a poll option will be deleted together with the poll option.",true)."</div>";

     //** AJAX: Delete poll option **//


     echo $this->Form->create();
     echo "<div id ='votes'>";  
     echo "<table width='500px' cellspacing='0' class='blue'>";

     foreach ($votes as $key => $vote){

             $delete = $this->Js->link($this->Html->image("icons/delete.png"),
                                   array('controller' => 'votes', 'action' => 'delete/'.$vote['Vote']['id'].'/'.$this->data['Poll']['id']),
                                   array('update' => '#votes', 'escape' => false,'class' => 'votes'));

             $row[] = array(__('Option',true).' '.($key+1), $vote['Vote']['chtext'], $delete);

     }
     echo $this->Html->tableCells($row, array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo $this->Form->input('Vote.poll_id', array('type' =>'hidden', 'value' => $this->data['Poll']['id']));

//     echo $this->Form->end();
//     echo "</div>";  //VOTES


     //** END AJAX **//



     //** AJAX: Add poll option **//
  //     echo "<div id ='add_vote'>";  
  //     echo $this->Form->create('Votes');
       echo "<table width='500px' cellspacing='0' class='blue'>";
       $add[] = array(
       	      __('Option',true).' '.($key+2), 
       	      $this->Form->input('Vote.chtext',array('type' => 'text','label' => false, 'value' => false)), 
	      $this->Js->submit(__('Add option',true), array('url' => '/votes/add', 'update' => '#votes')),
	      );
       echo $this->Html->tableCells($add,array('class' => 'blue'),array('class' => 'blue'));
       echo "</table>";


   echo "</div>";  //add_vote    
   echo $this->Form->input('Vote.poll_id', array('type' =>'hidden', 'value' => $this->data['Poll']['id']));
       echo $this->Form->end();

    
       //** END AJAX **//



     echo "</div>"; //leftFrame
     } else {

         echo $this->Html->div("invalid_entry", __("This page does not exist.",true));

     }


?>

