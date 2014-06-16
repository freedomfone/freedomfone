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

  echo $this->Html->addCrumb(__('Dashboard',true), '');
  echo $this->Html->addCrumb(__('Service mapping',true), '/channels/audio_services');

  echo $this->Session->flash();


echo $this->Form->create('Channel',array('type' => 'post','action'=> 'audio_services'));
echo $this->Html->div('frameRightAlone',$this->Form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $this->Form->end();



   echo "</br><h1>".__('Service mapping',true)."</h1>";
   echo $this->Html->div(false, __('To map services to an OfficeRoute gateway, please login to the OfficeRoute device and perform the mapping.',true));


   if($gammu_discovery){

      echo $this->Form->create("Channel");

     echo "<table width='95%' cellspacing = 0>";
     echo $this->Html->tableHeaders(array(
			__('Enabled',true),
			__('Gateway',true),
			__('Inbound',true),
			__('Outbound',true),
                        __('IMSI',true),
                        __('Manufacturer',true),
                        __('Model',true),
                        __('Hardware id',true),
                        __('Interface id',true),
                        __('Service',true)));

     foreach($gammu_discovery as $key => $entry){


        $entry = explode(',',$entry);
      echo $this->Form->hidden('Channel.'.$key.'.interface_id',array('value'=>trim($entry[9]))); 
    	$row[$key]['enable']		= $entry[5] ? __('Yes') : __('No');
     	$row[$key]['gateway']		= $entry[6];
     	$row[$key]['inbound']		= $entry[7] ? __('Yes') : __('No');
     	$row[$key]['outbound']		= $entry[8] ? __('Yes') : __('No');
     	$row[$key]['IMSI']		= $entry[0];
     	$row[$key]['manufacturer'] 	= $entry[2];
     	$row[$key]['model'] 		= $entry[4];
     	$row[$key]['hardwareId'] 	= $entry[3];
     	$row[$key]['interfaceId'] 	= trim($entry[9]);


	if(array_key_exists(10, $entry)){ $selected = trim($entry[10]);} else {$selected = false;}

	if($entry[6] == 'freeswitch'){

	//$row[$key]['Service'] 		= $this->Form->input('Channel.'.$key.'.instance_id', array('type' => 'select', 'options' => $lam+$ivr, 'selected' => $selected, 'label' => false, 'empty' => '-- '.__("Select service",true).' --'));

	$row[$key]['Service'] 		= $this->Access->showBlock($authGroup, $this->Form->input('Channel.'.$key.'.instance_id', array('type' => 'select', 'options' => $lam+$ivr, 'selected' => $selected, 'label' => false, 'empty' => '-- '.__("Select service",true).' --')));



	} else {

	$row[$key]['Service'] = false;

	}

	}
     echo $this->Html->tableCells($row);
     echo "</table>";

     //Admin: create dialplan
     if($authGroup == 1){      
      echo $this->Form->submit(__('Create dialplan',true),  array('class' => 'button'));
      }
      echo $this->Form->end();



   } else {

   echo $this->Html->div('feedback',__("There are no GSMOpen based units connected to your system.",true));

   }
     echo $this->Html->div('system_time',__('Generated',true).': '.$this->Time->format('H:i:s A (e \G\M\T O)',time())); 

 


?>
