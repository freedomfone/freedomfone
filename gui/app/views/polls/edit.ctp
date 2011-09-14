<?php
/****************************************************************************
 * edit.ctp	- Edit existing poll
 * version 	- 2.0.1170
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



     if($this->data){
           echo $html->addCrumb(__('Edit',true), '/polls/edit/'.$this->data['Poll']['id']);
	   echo "<h1>".__("Edit Poll",true)."</h1>";

	   $session->flash();

           echo $html->div('frameLeft');

           //** START POLL GENERAL **//

          
	   echo $form->create('Poll',array('type' => 'post','action'=> 'edit'));
           echo $form->submit(__('Save',true),  array('name' =>'data[Submit]', 'class' => 'save_button'));

	   echo $form->input('id',array('type' => 'hidden','value'=> $this->data['Poll']['id']));
   	   echo $form->input('invalid_open',array('type' => 'hidden','value'=> $this->data['Poll']['invalid_open']));
   	   echo $form->input('invalid_early',array('type' => 'hidden','value'=> $this->data['Poll']['invalid_early']));
	   echo $form->input('invalid_closed',array('type' => 'hidden','value'=> $this->data['Poll']['invalid_closed']));


	   echo "<table cellspacing='0' class='blue'>";
	   echo $html->tableCells(array (
     	   	array(__("Question",true),	$form->input('question',array('label'=>false,'size' => 70))),
     		array(array(__("Define a concrete question using simple language",true),"colspan='2' class='formComment'")),
     		array(__("SMS Code",true),	$form->input('code',array('label'=>false))),
    		array(array(__("Alpha-numeric characters only (maximum 10)",true),"colspan='2' class='formComment'")),
     		),array('class' => 'blue'),array('class' => 'blue'));
	  echo "</table>";
 
          //** END POLL GENERAL **//


          //** START POLL OPTIONS **// 


	  echo "<h2>".__("Start and end time",true)."</h2>";
	  echo "<div class='formComment'>".__("When would you like to open and close the poll?",true)."</div>";

	  echo "<table cellspacing ='0' class='blue'>";
	  echo $html->tableCells(array (
     	     array(__("Start time",true),	$form->input('start_time',array('label'=>false))),
     	     array(__("End time",true),		$form->input('end_time',array('label'=>false)))
      	     ),array('class' => 'blue'),array('class' => 'blue'));
	  echo "</table>";


          echo $form->end();





	  echo "<h2>".__("Poll options",true)."</h2>";
	  echo "<div class='formComment'>".__("Alpha-numeric characters only (maximum 10)",true)."</div>";
	  echo "<div class='formComment'>".__("Please note that all votes associated with a poll option will be deleted together with the poll option.",true)."</div>";
     //** AJAX: Delete poll option **//

     echo "<div id ='votes'>";  
     echo "<table width='400px' cellspacing='0' class='blue'>";

     foreach ($votes as $key => $vote){

             $delete = $ajax->link($html->image("icons/delete.png"),'/votes/delete/'.$vote['Vote']['id'].'/'.$this->data['Poll']['id'], array('update' => 'votes'), null, 1);
             $row[] = array(__('Option',true).' '.($key+1), $vote['Vote']['chtext'], $delete);

     }
     echo $html->tableCells($row, array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo $form->input('Vote.poll_id', array('type' =>'hidden', 'value' => $this->data['Poll']['id']));


     echo "</div>";
     //** END AJAX **//



     //** AJAX: Add poll option **//
     echo  $ajax->form(array('type' => 'post', 'options' => array('model'=>'Poll', 'update'=>'votes', 'url' => array('controller' => 'votes','action' => 'add'))));
     echo "<table width='400px' cellspacing='0' class='blue'>";
     $add[] = array(__('Option',true).' '.($key+2), $form->input('Vote.chtext',array('type' => 'text','label' => false, 'value' => false)), $form->end(__('Add option',true)));
     echo $html->tableCells($add,array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo $form->input('Vote.poll_id', array('type' =>'hidden', 'value' => $this->data['Poll']['id']));
     echo $form->end();
     //** END AJAX **//



     echo "</div>";
     } else {


         echo $html->div("invalid_entry", __("This page does not exist.",true));

     }

?>

