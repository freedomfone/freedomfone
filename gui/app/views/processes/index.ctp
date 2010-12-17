<?php
/****************************************************************************
 * index.ctp	- List processes
 * version 	- 1.0.354
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
$generated  = $session->read('Process.refresh');


echo $form->create('Process',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRight',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo "<h1>".__('Processes',true)."</h1>";


     if ($data){

      foreach ($data as $key => $entry){


       if( $last_db = $entry['Process']['last_seen']){
      	$last=$time->niceShort($last_db); 
	} else {
	$last =__('N/A',true); 
	}

        $running = $entry['Process']['start_time'];
        if ($epoch > $running){
          $running = $epoch;}

	$start_time = __("Running since",true).": ".$time->niceShort($running);




      	$status	    =  $this->element('process_status',array('status'=>$entry['Process']['status'],'mode'=>'image'));
	$title      = $entry['Process']['title'];
	$last_seen  = __("Last seen",true).": ".$last;


	if(!$interupt=$entry['Process']['interupt']){ $interupt=false;}


	$start     = $html->link($html->image("icons/start.png", array("title" => __("Start",true))),"/processes/start/{$entry['Process']['id']}",null, null, false);
	$stop      = $html->link($html->image("icons/stop.png", array("title" => __("Stop",true))),"/processes/stop/{$entry['Process']['id']}",null, null, false);

	if(!$entry['Process']['status']){ 
		//$text = $html->div('process',$title).$last_seen.'<br/>'.$interupt;
		$text = $last_seen;
	} else { 
	       //$text = $html->div('process',$title).$start_time;
	       $text = $start_time;
	       }

	       //Do not display outgoing dispatcher
	       if($entry['Process']['id']!=2){	
     	       	$row[] = array($status, $title, $text, $interupt,array($start,array('align'=>'center')), array($stop,array('align'=>'center')));
		}
	}


	$running = __("Not running",true);
	$freeswitch=false;
	if($version[1]){    
	    $freeswitch=true;
	    $running = __("Running since",true).': '.$time->niceShort($uptime);
	}
    	$row[] = array($this->element('process_status',array('status'=>$freeswitch,'mode'=>'image')),__("FreeSWITCH",true), $running,"","",""); 

     echo "<table width='80%' cellspacing = 0>";
     echo $html->tableHeaders(array('',__('Component',true),__('Status',true),__('Interupt mode',true),__('Start',true),__('Stop',true)));
     echo $html->tableCells($row);
     echo "</table>"; 


     echo $html->div('system_time',__('Generated',true).': '.$time->format('H:i:s A (e \G\M\T O)',$generated));

     }


 

 


?>
