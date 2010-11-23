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

$session->flash();
$generated  = $session->read('Channel.refresh');

echo $form->create('Channel',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRight',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


echo "<h1>".__('GSM channels',true)."</h1>";

     echo "<h3>".__('Office Route',true)."</h3>";

     if ($data){

      foreach ($data as $no => $unit){


      	      foreach ($unit as $key => $entry){

	            	$edit  = false;

      			$slot                   = $entry['OfficeRoute']['id'];
      			$title                  = $html->link( $entry['OfficeRoute']['title'],array('controller' =>'office_route', 'action' => 'edit', $entry['OfficeRoute']['id']));
      			$line_id                = $entry['OfficeRoute']['line_id'];
      			$msisdn                 = $html->link( $entry['OfficeRoute']['msisdn'],array('controller' =>'office_route', 'action' => 'edit', $entry['OfficeRoute']['id']));
      			$sim_inserted           = $entry['OfficeRoute']['sim_inserted'];
			$imei                   = $entry['OfficeRoute']['imei'];
			$imsi                   = $entry['OfficeRoute']['imsi'];
			$signal_level           = $entry['OfficeRoute']['signal_level'];
			$network_registration   = $entry['OfficeRoute']['network_registration'];
			$operator_name          = $entry['OfficeRoute']['operator_name'];
			//$created              = $time->niceShort($entry['OfficeRoute']['created']);
			$modified               = $time->niceShort($entry['OfficeRoute']['modified']);

			if($sim_inserted==__('Yes',true)){ 
			   $edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/office_route/edit/{$entry['OfficeRoute']['id']}",null, null, false);
        		}

     			$row[] = array($slot, $title, $msisdn, $sim_inserted, $signal_level, $imsi, $network_registration, $operator_name, $modified,$edit);

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
                        __('Last updated',true),
                       __('Edit',true)));
     		echo $html->tableCells($row);
     		echo "</table>"; 
     }

   } else {

   echo __("There are no OfficeRoute units connected to your system.",true);

   }


    echo "<h3>".__('Mobigater',true)."</h3>";

     if ($gsmopen){


    	 unset($row);
    
      foreach ($gsmopen as $key => $entry){

     	$title           = $entry['Channel']['title'];
     	$msisdn          = $entry['Channel']['msisdn'];
      	$epoch           = $time->niceShort($entry['Channel']['epoch']);
      	$interface_id    = $entry['Channel']['interface_id'];
      	$interface_name  = $entry['Channel']['interface_name'];
	$imei            = $entry['Channel']['imei'];
	$imsi            = $entry['Channel']['imsi'];
	$signal          = $entry['Channel']['got_signal'];
        $edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/channels/edit/{$entry['Channel']['id']}",null, null, false);

     	$row[] = array($interface_id,$title, $msisdn, $interface_name,$imei,$imsi,array($signal,array('align'=>'center')),$epoch,$edit);

	}





     echo "<table>";
     echo $html->tableHeaders(array(
                        __('Interface id',true),
                        __('Title',true),
                        __('Phone number',true),
                        __('Interface name',true),
                        __('IMEI',true),
                        __('IMSI',true),
                        __('Signal level',true),
                        __('Last updated',true),
                        __('Edit',true)));
     echo $html->tableCells($row);
     echo "</table>"; 

     $lines[] = array(array($html->div('empty_line',''),array('colspan'=>3,'height'=>100,'valign'=>'bottom')));
     $lines[] = array(__('Generated',true).' : ', $time->format('H:i:s A (e \G\M\T O)',time()));

     echo "<table>"; 
     echo $html->tableCells($lines);
     echo "</table>"; 

   } else {

   echo __("There are no Mobigater units connected to your system.",true);

   }


 

 


?>
