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
 ***************************************************************************/


		$line = array(__('Date (Y-m-d)',true),__('Year',true),__('Month',true),__('Day',true),__('Time',true),__('Type',true),__('Call Id',true),__('Caller',true),__('Application',true),__('Protocol',true));
		$csv->addRow($line);

	if($data){

		foreach($data as $entry){
	
		$line = array( date('Y-m-d',$entry['Cdr']['epoch']),
		               date('Y',$entry['Cdr']['epoch']),
		      	       date('m',$entry['Cdr']['epoch']),
			       date('d',$entry['Cdr']['epoch']),
			       date('H:i:s',$entry['Cdr']['epoch']),
			       $entry['Cdr']['channel_state'],
			       $entry['Cdr']['call_id'],
			       $entry['Cdr']['caller_number'],
			       $entry['Cdr']['application'],
			       $entry['Cdr']['proto']);

		$csv->addRow($line);

		}

	}
		$prefix=date('Y-m-d');
		echo $csv->render($prefix."_".__('CDR',true)."_".$select_option);  
		$csv->render(false);





?>