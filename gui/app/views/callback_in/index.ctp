<?php
$session->flash();

echo "<div style='float:right'>".__("Show callback records: ",true);
echo $html->link('25','index/limit:25',null, null, false)." | ";
echo $html->link('50','index/limit:50',null, null, false)." | ";
echo $html->link('100','index/limit:100',null, null, false)." | " ;
echo $html->link(__('All',true),'index',null, null, false);
echo "</div>";

echo "<h1>".__('Callback requests',true)."</h1>";
echo "<div style='float:right'>".$paginator->counter(array('format' => __("Records",true)." %start% ".__("to",true)." %end% ".__("of",true)." %count% "))."</div>";
echo $form->create('CallbackIn',array('type' => 'post','action'=> 'process'));


     if ($callbacks){

echo "<table width=100%>";
echo $html->tableHeaders(array(
 	$paginator->sort(__("Status",true), 'status'),
 	//$paginator->sort(__("To",true), 'receiver'),
 	$paginator->sort(__("From",true), 'sender'),
 	$paginator->sort(__("Mode",true), 'mode'),
 	$paginator->sort(__("Protocol",true), 'proto'),
 	$paginator->sort(__("Date",true), 'created')));

      foreach ($callbacks as $key => $callback){
      	$status 	  = $this->element('callback_status',array('status'=>$callback['CallbackIn']['status']));
	//$to       	  = $callback['CallbackIn']['receiver'];
	$from       	  = $callback['CallbackIn']['sender'];
	$mode       	  = $callback['CallbackIn']['mode'];
	$protocol         = $callback['CallbackIn']['proto'];
	$created  	  = $time->niceShort($callback['CallbackIn']['created']);
	

     $row[$key] = array(array($status,array('align'=>'center', 'width'=>'30')),$from,$mode,$protocol, $created);

	}


     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";
     $form->end();
     $paginator->numbers();
       }
?>
