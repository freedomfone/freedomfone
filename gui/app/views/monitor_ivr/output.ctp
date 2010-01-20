<?php
/****************************************************************************
 * output.ctp	- Create cvs file 
 * version 	- 1.0.353
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
 *
 ***************************************************************************/



		$line = array(__('Year',true),__('Month',true),__('Day',true),__('Time',true),__('Call ID',true),__('IVR ID',true),__('Node ID',true),__('Digit',true),__('Caller number',true),__('Type',true));
		$csv->addRow($line);

	if($data){

		foreach($data as $entry){

	$type = $entry['MonitorIvr']['type'];
	if($type =='CS_ROUTING'){ $type=__("start",true);}
	elseif($type =='CS_DESTROY'){ $type=__("end",true);}

	
		$line = array( date('Y',$entry['MonitorIvr']['epoch']),
		      	       date('m',$entry['MonitorIvr']['epoch']),
			       date('d',$entry['MonitorIvr']['epoch']),
			       date('H:i:s',$entry['MonitorIvr']['epoch']),
			       $entry['MonitorIvr']['call_id'],
			       $entry['MonitorIvr']['ivr_code'],
			       $entry['MonitorIvr']['node_id'],
			       $entry['MonitorIvr']['digit'],
			       $entry['MonitorIvr']['caller_number'],
			       $type
			       );

		$csv->addRow($line);

		}

	}
		$prefix=date('Y-m-d_');
		echo $csv->render($prefix.__('MonitorIvr',true).'.csv');  
		$csv->render(false);



?>