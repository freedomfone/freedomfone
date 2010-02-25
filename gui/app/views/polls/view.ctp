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


$info = __('Classification of votes|The system classifies all incoming votes as <i>valid</i>, <i>invalid</i>, or <i>incorrect</i>:|
<p><b>Valid vote:</b> correct poll code, and correct poll option|<ul><li>Early: Received before the poll opened.</li><li>In time: Received while the poll was open.</li><li>Late: Received after the poll was closed.</li></ul>|
Early votes will be registered as "Valid, early". The number of early votes per poll option is presented in a separate column under the View poll page. Early votes will not be added to the Total votes accepted for the poll.|
<p>Late votes will be registered as "Valid, late". The number of late votes per poll option is presented in a separate column under the View poll page. Late votes will not be added to the Total votes accepted for the poll.|
<p><b>Invalid vote:</b> correct poll code, but a non-matching poll option|
Invalid votes are registered as votes, but classified as "invalid". "Early", "late" and "on-time" invalid votes are registered.|
Only "on-time" invalid votes are incorporated into the Total number of votes (in time) summary.|
<p>Invalid vote totals are provided to give deployers an idea of how SMS errors might impact on poll results.|
<p><b>Incorrect vote:</b> Non-matching poll code|
Incorrect votes that cannot be matched to any existing poll, will be classified as an incoming SMS and will be stored under "Other SMS". The SMS will be classified as "Unclassified".',true);




echo $form->create('Poll',array('type' => 'post','action'=> 'view/'.$data["Poll"]["id"]));
echo $html->div('frameRight', $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $html->div('frameInfo', $html->link($html->image('icons/bulb.png',array('alt'=>'Tooltips')),'#',array('class'=>'infobox','title'=>$info),null,false));


   if ($data){



	echo "<h1>".__("Question",true).": ".$data['Poll']['question']." ";
	echo  $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/polls/edit/{$data['Poll']['id']}",null, null, false)."</h1>";
	echo "<h3>".__("SMS code",true).": ".$data['Poll']['code']."</h3>";

	//echo $html->div('box',__("Please hit the refresh button to refresh the poll result.",true));
	echo $html->div('formTitleAlone',__("Result",true));
      
        $total =  0;
        $total_early =  0;
        $total_closed =  0;
        echo "<table width='400px'>";
        echo $html->tableHeaders(array(__("Options",true), __("Votes",true), __("Percentage",true),__('Early votes',true),__('Late votes',true)));

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
		   $percentage = $number->toPercentage(100*$vote['chvotes']/$total,0);
		}

		$rows[] = array($vote['chtext'],array($vote['chvotes'],array('align'=>'center')),array($percentage,array('align'=>'center')),array($vote['votes_early'],array('align'=>'center')),array($vote['votes_closed'],array('align'=>'center')));
    	      }

	      //Add invalid votes (open)
	      if ($total) {
	      	 $percentage = $number->toPercentage(100*$invalid_open/$total,0);
	      } else {
	      	$percentage=0;
		}

	 
  	      $rows[] = array('"'.__('Invalid',true).'"',array($invalid_open,array('align'=>'center')),array($percentage,array('align'=>'center')),array($invalid_early,array('align'=>'center')), array($invalid_closed,array('align'=>'center')));
	      $rows[] =array(array($html->div('empty_line'),array('colspan'=>5)));
	      echo $html->tableCells($rows);

  	      $final = array(__('Total',true),array($total,array('align'=>'center')),array('',array('align'=>'center')),array($total_early,array('align'=>'center')), array($total_closed,array('align'=>'center')));
	      
	      echo $html->tableCells($final);
	      echo "</table>";


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