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


     echo "<h3>".__('Office Route',true)."</h3>";
      foreach ($data as $key => $entry){



      	$slot                   = $entry['OfficeRoute']['id'];
      	$title                  = $html->link( $entry['OfficeRoute']['title'],array('controller' =>'office_route', 'action' => 'edit', $entry['OfficeRoute']['id']));
      	$line_id                = $entry['OfficeRoute']['line_id'];
      	$msisdn                  = $html->link( $entry['OfficeRoute']['msisdn'],array('controller' =>'office_route', 'action' => 'edit', $entry['OfficeRoute']['id']));
      	$sim_inserted           = $entry['OfficeRoute']['sim_inserted'];
	$imei                   = $entry['OfficeRoute']['imei'];
	$imsi                   = $entry['OfficeRoute']['imsi'];
	$signal_level           = $entry['OfficeRoute']['signal_level'];
	$network_registration   = $entry['OfficeRoute']['network_registration'];
	$operator_name          = $entry['OfficeRoute']['operator_name'];
	//$created              = $time->niceShort($entry['OfficeRoute']['created']);
	$modified               = $time->niceShort($entry['OfficeRoute']['modified']);


     	$row[] = array($slot, $title, $msisdn, $sim_inserted, $signal_level, $imsi, $network_registration, $operator_name, $modified);

	}


     echo "<table width='100%'>";
     echo $html->tableHeaders(array(
                        __('Slot',true),
                        __('Title',true),
                        __('Phone number',true),
                        __('Sim inserted',true),
                        __('Signal level',true),
                        __('IMSI',true),
                        __('Network registration',true),
                        __('Operator',true),
                        __('Last updated',true)));
     echo $html->tableCells($row);
     echo "</table>"; 


}


     if ($gsmopen){

    echo "<h3>".__('Mobigater',true)."</h3>";

      foreach ($gsmopen as $key => $entry){

	$created           = $time->niceShort($entry['Channel']['created']);
	$modified           = $time->niceShort($entry['Channel']['modified']);
      	$interface_id    = $entry['Channel']['interface_id'];
      	$interface_name  = $entry['Channel']['interface_name'];
	$imei            = $entry['Channel']['imei'];
	$imsi            = $entry['Channel']['imsi'];
	$signal          = $entry['Channel']['got_signal'];


     	$row[] = array($interface_id,$interface_name,$imei,$imsi,array($signal,array('align'=>'center')),$modified);

	}





     echo "<table>";
     echo $html->tableHeaders(array(
                        __('Interface id',true),
                        __('Interface name',true),
                        __('IMEI',true),
                        __('IMSI',true),
                        __('Signal level',true),
                        __('Last updated',true)));
     echo $html->tableCells($row);

     $lines[] = array(array($html->div('empty_line',''),array('colspan'=>2,'height'=>100,'valign'=>'bottom')));
     $lines[] = array(__('Generated',true).' :', $time->format('H:i:s A (e \G\M\T O)',time()));
     echo $html->tableCells($lines);
     echo "</table>"; 
     }


 

 


?>
