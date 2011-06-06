<?php
/****************************************************************************
 * export.ctp	- Export Other MS to csv file
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




		$line = array(__('Date and Time',true),__('Date',true),__('Time',true),__('Message',true),__('Sender',true),__('Type',true));
		$csv->addRow($line);

	if($data){

		foreach($data as $entry){
	
		$line = array(date('Y-m-d H:i:s',$entry['Bin']['created']),date('Y-m-d',$entry['Bin']['created']),date('H:i:s',$entry['Bin']['created']),$entry['Bin']['body'],$entry['Bin']['sender'],$entry['Bin']['mode']);
		$csv->addRow($line);

		}

	}
		echo $csv->render(__('Other SMS',true).'.csv');  
		$csv->render(false);




?>
