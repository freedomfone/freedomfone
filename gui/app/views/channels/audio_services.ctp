<?php
/****************************************************************************
 * audio_services.ctp	- Map audio channels with services
 * version 		- 3.0.1500
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
  echo $html->addCrumb(__('Audio services',true), '/channels/audio_services');

        // Multiple Flash messages
        if ($messages = $this->Session->read('Message')) {
                foreach($messages as $key => $value) {
                 echo $this->Session->flash($key);
                }
        }


   echo "<h3>".__('GSMOpen channels',true)."</h3>";

   if($gammu_discovery){

      echo $form->create("Channel");
     echo "<table width='95%' cellspacing = 0>";
     echo $html->tableHeaders(array(
			__('Enabled',true),
			__('Gateway',true),
			__('Inbound',true),
			__('Outbound',true),
                        __('IMSI',true),
                        __('IMEI',true),
                        __('Manufacturer',true),
                        __('Model',true),
                        __('Hardware id',true),
                        __('Interface id',true),
                        __('Service',true)));

     foreach($gammu_discovery as $key => $entry){

        $entry = explode(',',$entry);
     	$row[$key]['enable']		= $entry[5] ? 'Yes' : 'No';
     	$row[$key]['gateway']		= $entry[6];
     	$row[$key]['inbound']		= $entry[7] ? 'Yes' : 'No';
     	$row[$key]['outbound']		= $entry[8] ? 'Yes' : 'No';;
     	$row[$key]['IMSI']		= $entry[0];
     	$row[$key]['IMEI'] 		= $entry[1];
     	$row[$key]['manufacturer'] 	= $entry[2];
     	$row[$key]['model'] 		= $entry[4];
     	$row[$key]['hardwareId'] 	= $entry[3];
     	$row[$key]['interfaceId'] 	= $entry[9];



	if($entry[6] == 'freeswitch'){

	$row[$key]['Service'] 		= $form->input('instance_id', array('type' => 'select', 'options' => $lam+$ivr, 'label' => false, 'empty' => '-- '.__("Select service",true).' --'));

	} else {

	$row[$key]['Service'] = false;

	}

	}
     echo $html->tableCells($row);
     echo "</table>";
      echo $form->submit(__('Create configuration files',true),  array('class' => 'button'));
      echo $form->end();



   } else {

   echo $html->div('feedback',__("There are no GSMOpen based units connected to your system.",true));

   }
     echo $html->div('system_time',__('Generated',true).': '.$time->format('H:i:s A (e \G\M\T O)',time())); 

 


?>
