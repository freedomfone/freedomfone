<?php
/****************************************************************************
 * view.ctp	- View poll result
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

echo $html->div("frameRight");
echo $form->create('Poll',array('type' => 'post','action'=> 'view/'.$data["Poll"]["id"]));
echo $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button'));
echo $form->end();



echo "</div>";

   if ($data){

	echo "<h1>".__("Question",true).": ".$data['Poll']['question']." ";
	echo  $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/polls/edit/{$data['Poll']['id']}",null, null, false)."</h1>";
	echo "<h3>".__("SMS code",true).": ".$data['Poll']['code']."</h3>";

	//echo $html->div('box',__("Please hit the refresh button to refresh the poll result.",true));
	echo $html->div('formTitleAlone',__("Result",true));
      
        $total =  0;
        $total_closed =  0;
        echo "<table>";
        echo $html->tableHeaders(array(__("Options",true), __("Votes",true), __("Percentage",true),__('Late votes',true)));

	$votes = $data['Vote'];
	$incorrect_open = $data['Poll']['incorrect_open'];
	$incorrect_closed = $data['Poll']['incorrect_closed'];

	//Calculate total valid votes
	   foreach ($votes as $vote) {
	  
    	    $total = $total + $vote['chvotes'];
    	    $total_closed = $total_closed + $vote['votes_closed'];

    	    }
    
           $total = $total + $incorrect_open;
           $total_closed = $total_closed + $incorrect_closed;

	    foreach ($votes as $vote) {

    	    	if (!$total){ 
		   $percentage = 0;
		   } else { 
		   $percentage = $number->toPercentage(100*$vote['chvotes']/$total,0);
		}

		$rows[] = array($vote['chtext'],array($vote['chvotes'],array('align'=>'center')),array($percentage,array('align'=>'center')),array($vote['votes_closed'],array('align'=>'center')));
    	      }

	      //Add incorrect votes (open)
	      if ($total) {
	      	 $percentage = $number->toPercentage(100*$incorrect_open/$total,0);
	      } else {
	      	$percentage=0;
		}
	      $rows[] = array(__('Invalid',true),array($incorrect_open,array('align'=>'center')),array($percentage,array('align'=>'center')),array($incorrect_closed,array('align'=>'center')));
	      echo $html->tableCells($rows);
	      echo "</table>";
	      echo $html->div('instruction',__('Total number of votes (in time): ',true).$total);
	      echo $html->div('instruction',__('Total number of late votes: ',true).$total_closed);


	      //Poll information
     	      echo "<div class='formTitleAlone'>".__("Poll information",true)."</div>";
     	      echo "<table>";
	      echo $html->tableCells(array (
     	      	   array(__("Status",true),	  $this->element('poll_status',array('status'=>$data['Poll']['status'],'mode'=>'text'))),
     		   array(__("Start time",true), $data['Poll']['start_time']),
     		   array(__("End time",true),	  $data['Poll']['end_time'])));
     	      echo "</table>";

	      }     

	      else {

	      echo "<h1>".__("No poll with this id exists",true)."</h1>";
	      }

?>