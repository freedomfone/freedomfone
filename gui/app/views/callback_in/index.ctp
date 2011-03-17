<?php
/****************************************************************************
 * index.ctp	- List callback requests
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

$session->flash();

echo "<div style='float:right'>".__("Show callback records",true).": ";
echo $html->link('25','index/limit:25',null, null, false)." | ";
echo $html->link('50','index/limit:50',null, null, false)." | ";
echo $html->link('100','index/limit:100',null, null, false)." | " ;
echo $html->link(__('All',true),'index',null, null, false);
echo "</div>";

echo "<h1>".__('Callback requests',true)."</h1>";
echo "<div style='float:right'>".$paginator->counter(array('format' => __("Records",true)." %start% ".__("to",true)." %end% ".__("of",true)." %count% "))."</div>";
echo $form->create('Callback',array('type' => 'post','action'=> 'process'));


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
      	$status 	  = $this->element('callback_status',array('status'=>$callback['Callback']['status']));
	//$to       	  = $callback['Callback']['receiver'];
	$from       	  = $callback['Callback']['sender'];
	$mode       	  = $callback['Callback']['mode'];
	$protocol         = $callback['Callback']['proto'];
	$created  	  = $time->niceShort($callback['Callback']['created']);
	

     $row[$key] = array(array($status,array('align'=>'center', 'width'=>'30')),$from,$mode,$protocol, $created);

	}


     echo $html->tableCells($row,array('class'=>'darker'));
     echo "</table>";
     $form->end();
     $paginator->numbers();
       }
?>
