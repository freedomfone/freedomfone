<?php
/****************************************************************************
 * index.ctp	- List GSM channels
 * version 	- 3.0.1500
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

  echo $html->addCrumb(__('Dashboard',true), '');
  echo $html->addCrumb(__('Audio channels',true), '/channels');

        // Multiple Flash messages
        if ($messages = $this->Session->read('Message')) {
                foreach($messages as $key => $value) {
                 echo $this->Session->flash($key);
                }
        }



  $generated  = $session->read('Channel.refresh');
  echo $form->create('Channel',array('type' => 'post','action'=> 'index'));
  echo $html->div('frameRightAlone',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
  echo $form->end();

  echo "<h1>".__('Audio channels',true)."</h1>";

     echo "<h3>".__('Office Route',true)."</h3>";

     if ($data == 'snmp_off'){ 

       echo $html->div('feedback',__("SNMP daemon is not running.",true));

     } elseif ($data){


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
			$signal_level           = $this->element('channel_signal_level', array('signal' => $entry['OfficeRoute']['signal_level']));
			$network_registration   = $entry['OfficeRoute']['network_registration'];
			$operator_name          = $entry['OfficeRoute']['operator_name'];
			//$created              = $time->niceShort($entry['OfficeRoute']['created']);
			$modified               = $time->niceShort($entry['OfficeRoute']['modified']);

			if($sim_inserted==__('Yes',true)){ 
                           $edit =  $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "office_route", "action" => "edit", $entry['OfficeRoute']['id']))));
        		}

     			$row[] = array($slot, $title, $msisdn, $sim_inserted, $signal_level, $imsi, $network_registration, $operator_name, $modified,$edit);

	       }


     	       echo "<table width='95%' cellspacing=0>";
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
                        __('Actions',true)));
     		echo $html->tableCells($row);
     		echo "</table>"; 
     }

   } else {

   echo $html->div('feedback',__("There are no OfficeRoute units connected to your system.",true));

   }


    echo "<h3>".__('Active channels',true)."</h3>";

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
        $edit            =  $this->Access->showBlock($authGroup, $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "channels", "action" => "edit", $entry['Channel']['id']))));

     	$row[] = array($interface_id,$title, $msisdn, $interface_name,$imei,$imsi,array($signal,array('align'=>'center')),$epoch,$edit);

	}



     echo "<table width='95%' cellspacing = 0>";
     echo $html->tableHeaders(array(
                        __('Interface id',true),
                        __('Title',true),
                        __('Phone number',true),
                        __('Interface name',true),
                        __('IMEI',true),
                        __('IMSI',true),
                        __('Signal level',true),
                        __('Last updated',true),
                        __('Actions',true)));
     echo $html->tableCells($row);
     echo "</table>"; 


   } else {

   echo $html->div('feedback',__("There are no Mobigater units connected to your system.",true));

   }


     echo $html->div('system_time',__('Generated',true).': '.$time->format('H:i:s A (e \G\M\T O)',time())); 

 


?>
