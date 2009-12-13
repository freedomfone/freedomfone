<?php
$session->flash();

echo $form->create('Process',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRight',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo "<h1>".__('System Health',true)."</h1>";

     if ($data){

      foreach ($data as $key => $entry){

      	$status	    =  $this->element('process_status',array('status'=>$entry['Process']['status'],'mode'=>'image'));
	$title      = $entry['Process']['title'];
	$last_seen  = __("Last seen",true).": ".$time->niceShort($entry['Process']['last_seen']);
	$start_time = __("Running since",true).": ".$time->niceShort($entry['Process']['start_time']);

	if($text=$entry['Process']['interupt']){ $interupt   = __("Interupt mode",true).": ".$text;} else { $interupt=false;}


	$start     = $html->link($html->image("icons/start.png", array("name" => "Start")),"/processes/start/{$entry['Process']['id']}",null, null, false);
	$stop      = $html->link($html->image("icons/stop.png", array("name" => "Stop")),"/processes/stop/{$entry['Process']['id']}",null, null, false);

	if(!$entry['Process']['status']){ 
		$text = $html->div('process',$title).$last_seen.'<br/>'.$interupt;
	} else { 
	       $text = $html->div('process',$title).$start_time;
	       }
	
     	$row[] = array($status, array($text,array('valign'=>'top')), array($start,array('align'=>'center')), array($stop,array('align'=>'center')));

	}

      echo "<table width='50%'>";
     echo $html->tableCells($row);
     echo "</table>"; 
 
     }

?>
