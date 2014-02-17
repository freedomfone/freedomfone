<?php
/****************************************************************************
 * view.ctp	- View poll result
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

echo $this->Form->create('Poll',array('type' => 'post','action'=> 'view/'.$data["Poll"]["id"]));
echo $this->Html->div('frameRightAlone', $this->Form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $this->Form->end();


   $info = $this->Html->link(
                        $this->Html->image("icons/bulb.png"),
                        "/pages/polls/view",
                        array("escape" => false, "title" => __("Tool tip", true), "onClick" => "Modalbox.show(this.href, {title: this.title, width: 500}); return false;"),
                        false);

   echo $this->Html->div('frameInfo', $info);



   if ($data){

        echo $this->Html->addCrumb(__('View',true), '/polls/view/'.$data['Poll']['id']);
	echo "<h1>".__("Question",true).": ".$data['Poll']['question']." ";

	echo $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "polls", "action" => "edit", $data['Poll']['id'])));
        echo "</h1>";

	echo "<h3>".__("SMS code",true).": ".$data['Poll']['code']."</h3>";


	echo "<h2>".__("Results",true)."</h2>";
      
        $total =  0;
        $total_percentage = 0;
        $total_early =  0;
        $total_closed =  0;
        echo "<table width='400px' cellspacing=0>";
        echo $this->Html->tableHeaders(array(__("Options",true), __("Votes",true), __("Percentage",true),__('Early votes',true),__('Late votes',true)),false, array('align' => 'center'));

	$votes = $data['Vote'];
	$invalid_open   = $data['Poll']['invalid_open'];
	$invalid_early  = $data['Poll']['invalid_early'];
	$invalid_closed = $data['Poll']['invalid_closed'];

	//Calculate total valid votes
	   foreach ($votes as $vote) {
	  
    	    $total = $total + $vote['chvotes'];
    	    $total_closed = $total_closed + $vote['votes_closed'];
    	    $total_early   = $total_early + $vote['votes_early'];

    	    }
    
           $total = $total + $invalid_open;
           $total_closed = $total_closed + $invalid_closed;
    	   $total_early = $total_early + $invalid_early;

	    foreach ($votes as $vote) {

    	    	if (!$total){ 
		   $percentage = 0;
		   } else { 
		   $percentage = $this->Number->toPercentage(100*$vote['chvotes']/$total,0);
		}

                

		$rows[] = array($vote['chtext'],array($vote['chvotes'],array('align'=>'center')),array($percentage,array('align'=>'center')),array($vote['votes_early'],array('align'=>'center')),array($vote['votes_closed'],array('align'=>'center')));
    	      }

	      //Add invalid votes (open)
	      if ($total) {
	      	 $percentage = $this->Number->toPercentage(100*$invalid_open/$total,0);
	      } else {
	      	$percentage=0;
		}


  	      $rows[] = array('"'.__('Invalid',true).'"',array($invalid_open,array('align'=>'center')),array($percentage,array('align'=>'center')),array($invalid_early,array('align'=>'center')), array($invalid_closed,array('align'=>'center')));

	      echo $this->Html->tableCells($rows);

  	      $final = array(false,$total,false, $total_early, $total_closed);
	      
	      echo $this->Html->tableHeaders($final,false, array('align' => 'center'));
	      echo "</table>";


	      //Poll information
     	      echo "<h2>".__("Poll information",true)."</h2>";
     	      echo "<table cellspacing=0 class='stand-alone'>";
	      echo $this->Html->tableCells(array (
     	      	   array(__("Status",true),	  $this->element('poll_status',array('status'=>$data['Poll']['status'],'mode'=>'text'))),
     		   array(__("Start time",true), $data['Poll']['start_time']),
     		   array(__("End time",true),	  $data['Poll']['end_time'])),array('class'=>'stand-alone'),array('class'=>'stand-alone'));
     	      echo "</table>";

	      }     

	      else {

                   echo $this->Html->div("invalid_entry", __("This page does not exist.",true));


	      }

?>
