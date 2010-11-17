<?php
/****************************************************************************
 * overview.ctp	- Show CDR statistics
 * version 	- 1.0.376
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

$session->flash();

     //Calculate stats for CDR
     $pollCount  = 0;
     $lamCount   = 0;
     $ivrCount   = 0;
     $otherCount = 0;

     if($cdr){

        foreach ($cdr as $key => $entry){

             $app = $entry['Cdr']['application'];

  	     switch($app){

	     case 'poll':
	     $pollCount = $pollCount + 1;
	     break;

	     case 'lam':
	     $lamCount = $lamCount + 1;
	     break;

	     case 'ivr':
	     $ivrCount =$ivrCount +1;
	     break;

	     case 'bin':
	     $otherCount = $otherCount + 1;
	     break;
	     }
        }
    }

     $all=$lamCount+$ivrCount+$pollCount+$otherCount;
     $total=$all;
     if(!$all){ $all=1;}


     $message_new = $message_total = false;
     $rows= array();
     if($messages){

      foreach($messages as $key => $message){

        if ($message['Message']['new']){ 
        
	$download  = $html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/messages/download/{$message['Message']['id']}",null, null, false);
	$listen   = $this->element('player',array('url'=>$message['Message']['url'],'file'=>$message['Message']['file'],'title'=>__('New message',true),'id'=>$message['Message']['id']));


             $rows[] = array(
                       $message['Message']['sender'],
                       $time->niceShort($message['Message']['created']), 
                       $formatting->epochToWords($message['Message']['length']),
                       $html->link($html->image("icons/edit.png", array("title" => __("View",true))),"/messages/edit/{$message['Message']['id']}",null, null, false),
                       $download,
                       $listen
                       );


        }
     }
        $message_new = sizeof($rows);
        $message_total = sizeof($messages);
    }
  
    ///*** HERE STARTS HTML CODE ***///



     ///*** SYSTEM OVERVIEW *** ///
     echo "<h1>".__('System Overview',true)."</h1>";
     $stat[] = array(__('Leave-a-message',true), array($lamCount,array('align'=>'center')),array(round(100*$lamCount/$all).' %',array('align'=>'center')));
     $stat[] = array(__('Voice menus',true), 	 array($ivrCount,array('align'=>'center')),array(round(100*$ivrCount/$all).' %',array('align'=>'center')));
     $stat[] = array(__('Poll',true),		 array($pollCount,array('align'=>'center')),array(round(100*$pollCount/$all).' %',array('align'=>'center')));
     $stat[] = array(__('Other SMS',true),	 array($otherCount,array('align'=>'center')),array(round(100*$otherCount/$all).' %',array('align'=>'center')));
     $stat[] = array(array($html->div('empty_line'),array('colspan'=>'3')));
     $stat[] = array(__('All',true),	 array($total,array('align'=>'center')),'');

     echo "<table>";
     echo $html->tableHeaders(array (__('Application',true),__('No of entries',true),__('Percentage',true)));
     echo $html->tableCells($stat);
     echo "</table>";

 
     ///*** NEW MESSAGES ***///
     echo "<h1>".__('New Messages',true)." (".$message_new.") </h1>";
     if ($message_new){
     echo "<table width='600px'>";
     echo $html->tableHeaders(array (__('Sender',true),__('Time',true),__('Length',true),__('View',true),__('Download',true),__('Listen',true)));
     echo $html->tableCells($rows);
     echo "</table>";
     }

    echo $html->div('instructions',__('Total ',true).": ".$message_total);


    //*** POLLS *** ///

    if ($polls){
     echo "<h1>".__('Polls',true)."</h1>";

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

           $row[$key] = array(
     		array($this->element('poll_status',array('status'=>$poll['Poll']['status'],'mode'=>'image')),array('align'=>'center')),
		$question,array($code,array('align'=>'left')),
		array($votes,array('align' =>'center')),
		$start,
		$end,
                $edit);


     }

     echo "<table width='60%'>";
     echo $html->tableHeaders(array(__("Status",true),__("Question",true),__("Code",true),__("Valid votes",true),__("Open",true),__("Close",true),__('Edit',true)));
     echo $html->tableCells($row);
     echo "</table>";

 }

?>
