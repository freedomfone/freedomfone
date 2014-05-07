<?php
/****************************************************************************
 * index.ctp	- List processes
 * version 	- 2.5.1450
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

echo $this->Html->addCrumb(__('Dashboard',true), '');
echo $this->Html->addCrumb(__('Health',true), '/processes/');


$generated  = $this->Session->read('Process.refresh');
echo $this->Form->create('Process',array('type' => 'post','action'=> 'index'));
echo $this->Html->div('frameRightAlone',$this->Form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $this->Form->end();

echo "<h1>".__('Health',true)."</h1>";

     echo $this->Session->flash();

     if ($data){

      foreach ($data as $key => $entry){


       if( $last_db = $entry['Process']['last_seen']){
      	$last = $this->Time->niceShort($last_db); 
	} else {
	$last =__('N/A',true); 
	}

        $running = $entry['Process']['start_time'];
        if ($epoch > $running){
          $running = $epoch;}

	$start_time = __("Running since",true).": ".$this->Time->niceShort($running);
      	$status	    =  $this->element('process_status',array('status'=>$entry['Process']['status'],'mode'=>'image'));
	$title      = $entry['Process']['title'];
	$last_seen  = __("Last seen",true).": ".$last;


	if(!$interupt=$entry['Process']['interupt']){ $interupt=false;}


        $start     = $this->Html->image("icons/start.png", array("alt" => __("Start",true), "title" => __("Start",true), "url" => array("controller" => "processes", "action" => "start", $entry['Process']['id'])));
        $stop     = $this->Html->image("icons/stop.png", array("alt" => __("Stop",true), "title" => __("Stop",true), "url" => array("controller" => "processes", "action" => "stop", $entry['Process']['id'])));


	if(!$entry['Process']['status']){ 
		//$text = $this->Html->div('process',$title).$last_seen.'<br/>'.$interupt;
		$text = $last_seen;
	} else { 
	       //$text = $this->Html->div('process',$title).$start_time;
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
	    $running = __("Running since",true).': '.$this->Time->niceShort($uptime);
	}
    	$row[] = array($this->element('process_status',array('status'=>$freeswitch,'mode'=>'image')),__("FreeSWITCH",true), $running,"","",""); 


        $headers = array('',__('Component',true),__('Status',true),__('Interrupt mode',true),__('Start',true),__('Stop',true));

        if($authGroup != 1){
              unset($headers[4]);
              unset($headers[5]);
              foreach($row as $key => $line){
                   unset($row[$key][4]);
                   unset($row[$key][5]);
               }
       }

       
     echo "<table cellspacing = 0>";
     echo $this->Html->tableHeaders($headers);
     echo $this->Html->tableCells($row);
     echo "</table>"; 


     echo $this->Html->div('system_time',__('Generated',true).': '.$this->Time->format('H:i:s A (e \G\M\T O)',$generated));

     }


 

 


?>
