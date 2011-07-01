<?php
/****************************************************************************
 * overview.ctp	- Show CDR statistics
 * version 	- 2.0.1215
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

echo $html->addCrumb('', '');

echo $form->create('Cdr',array('type' => 'post','action'=> 'overview'));
echo $html->div('frameRightAlone',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


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
        
                $message_new = $message_new + 1;

                if(sizeof($rows)<5){

	        $download  = $html->link($html->image("icons/music.png", array("title" => __("Download audio file",true))),"/messages/download/{$message['Message']['id']}",null, null, false);
	        $listen   = $this->element('player',array('url'=>$message['Message']['url'],'file'=>$message['Message']['file'],'title'=>__('New message',true),'id'=>$message['Message']['id']));

                 $rows[] = array(
                       $message['Message']['sender'],
                       $time->format('Y/m/d H:i',$message['Message']['created']), 
                       $formatting->epochToWords($message['Message']['length']),
                       $html->link($html->image("icons/edit.png", array("title" => __("Edit message",true))),"/messages/edit/{$message['Message']['id']}",null, null, false),
                       $download,
                       $listen
                       );
                 }
        }
     }

        $message_total = sizeof($messages);
    }
  
    ///*** HERE STARTS HTML CODE ***///



     ///*** SYSTEM OVERVIEW *** ///
     echo "<h1>".__('System Overview',true)."</h1>";
     $stat[] = array(__('Leave-a-message',true), array($lamCount,array('align'=>'center')),array(round(100*$lamCount/$all).' %',array('align'=>'center')));
     $stat[] = array(__('Voice menus',true), 	 array($ivrCount,array('align'=>'center')),array(round(100*$ivrCount/$all).' %',array('align'=>'center')));
     $stat[] = array(__('Poll',true),		 array($pollCount,array('align'=>'center')),array(round(100*$pollCount/$all).' %',array('align'=>'center')));
     $stat[] = array(__('Incoming SMS',true),	 array($otherCount,array('align'=>'center')),array(round(100*$otherCount/$all).' %',array('align'=>'center')));

     echo "<table cellspacing=0>";
     echo $html->tableHeaders(array (__('Application',true),__('No of entries',true),__('Percentage',true)));
     echo $html->tableCells($stat);
     echo $html->tableHeaders(array(false,$total,100*($lamCount+$ivrCount+$pollCount+$otherCount)/$all),false,array('align' => 'center'));

     echo "</table>";

 
     ///*** NEW MESSAGES ***///
     if($message_new) { $msg = " (".$message_new.")";} else { $msg = false;}
     if(!$message_total) { $message_total = '0';}

     echo "<h1>".__('New Messages',true).$msg."</h1>";
     echo $html->div('instruction',__('Total number of messages',true).": ".$message_total);
     if ($message_new){
        if($message_new >=5) { 
             echo $html->div('instruction', __('The table below shows the five most recent new messages',true));
        }
        echo "<table width='600px' cellspacing=0>";
        echo $html->tableHeaders(array (__('Sender',true),__('Time',true),__('Length',true),__('Edit',true),'',__('Listen',true)));
        echo $html->tableCells($rows);
        echo "</table>";
     }




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
	   $start    = $time->format('Y/m/d H:i', $poll['Poll']['start_time']);
	   $end      = $time->format('Y/m/d H:i', $poll['Poll']['end_time']);
           $view     = $html->link($html->image("icons/view.png", array("title" => __("View results",true))),"/polls/view/{$poll['Poll']['id']}",null, null, false);
           $edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit message",true))),"/polls/edit/{$poll['Poll']['id']}",null, null, false);

           $row[$key] = array(
     		array($this->element('poll_status',array('status'=>$poll['Poll']['status'],'mode'=>'image')),array('align'=>'center')),
		$question,array($code,array('align'=>'left')),
		array($votes,array('align' =>'center')),
		$start,
		$end,
                array($view,array('align' => 'center')),
                array($edit,array('align' => 'center')));



     }

     echo "<table width='80%' cellspacing=0>";
     echo $html->tableHeaders(array(__("Status",true),__("Question",true),__("Code",true),__("Valid votes",true),__("Open",true),__("Close",true),__('Results',true),__('Edit',true)), false,array('align' => 'center'));
     echo $html->tableCells($row);
     echo "</table>";

 }

?>
