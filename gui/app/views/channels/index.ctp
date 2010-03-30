<?php
/****************************************************************************
 * index.ctp	- List GSM channels
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
date_default_timezone_set(Configure::read('Config.timezone'));
$session->flash();
$generated  = $session->read('Channel.refresh');

echo $form->create('Channel',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRight',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo "<h1>".__('GSM channels',true)."</h1>";


     if ($data){

      foreach ($data as $key => $entry){

	$epoch           = $time->niceShort($entry['Channel']['epoch']);
      	$interface_id    = $entry['Channel']['interface_id'];
      	$interface_name  = $entry['Channel']['interface_name'];
	$imei            = $entry['Channel']['imei'];
	$imsi            = $entry['Channel']['imsi'];
	$signal          = $entry['Channel']['got_signal'];


     	$row[] = array($interface_id,$interface_name,$imei,$imsi,array($signal,array('align'=>'center')),$epoch);

	}


     echo "<table width='80%'>";
     echo $html->tableHeaders(array(__('Interface id',true),__('Interface name',true),__('IMEI',true),__('IMSI',true),__('Signal',true),__('Last seen',true)));
     echo $html->tableCells($row);
     echo "</table>"; 

     echo "<table>";
     $lines[] = array(array($html->div('empty_line',''),array('colspan'=>2,'height'=>100,'valign'=>'bottom')));
     $lines[] = array(__('Generated',true).' :', $time->format('H:i:s A (e \G\M\T O)',time()));
     echo $html->tableCells($lines);
     echo "</table>"; 
     }


 

 


?>
