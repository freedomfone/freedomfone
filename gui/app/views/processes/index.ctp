<?php
$session->flash();

echo $form->create('Bin',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRight',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo "<h1>".__('System Health',true)."</h1>";

     if ($data){

      foreach ($data as $key => $entry){

      	$status	 =  $this->element('process_status',array('status'=>$entry['Process']['status'],'mode'=>'image'));
	$title     = $entry['Process']['title'];
	$created  = $time->niceShort($entry['Process']['created']);
	$start  =  $form->submit("icons/start.png",  array('name' =>'start','value' => $entry['Process']['id']));	
	$stop   =  $form->submit("icons/stop.png",  array('name' =>'stop','value' => $entry['Process']['id']));	
     	$row[$key] = array($status."  ".$title, array($start,array('align'=>'center')), array($stop,array('align'=>'center')));

	}

     echo $form->create('Process',array('type' => 'post','action'=> 'index'));
     echo "<table width='50%'>";
     echo $html->tableCells($row);
     echo "</table>"; 
     echo $form->end();
     }

?>
