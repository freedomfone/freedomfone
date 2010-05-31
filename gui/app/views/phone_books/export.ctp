<?php
/****************************************************************************
 * export.ctp	- Export of phone book 
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





		$line = array(__('Name',true),__('Surname',true),__('Email',true),__('Skype',true),__('Phone',true),__('Organization',true),__('In the system since',true),__('Poll count',true),__('Voice menu count',true),__('Leave-a-message count',true),__('First application',true),__('Last application',true),__('Last active',true));
		$csv->addRow($line);

$filename = __('PhoneBook',true).'_'.$data['PhoneBook']['name'].'.csv';

	if($data){

		foreach($data['User'] as $key => $entry){
	
		$line = array(
		      $entry['name'],
		      $entry['surname'],
		      $entry['email'],
		      $entry['skype'],
		      $entry['phone1'],
		      $entry['organization'],
		      date('Y-m-d H:i:s',$entry['created']),
		      $entry['count_poll'],
		      $entry['count_ivr'],
		      $entry['count_lam'],
		      $entry['first_app'],
		      $entry['last_app'],
		      date('Y-m-d H:i:s',$entry['last_epoch'])
		      );

		$csv->addRow($line);

		}

	}
		echo $csv->render($filename);  
		$csv->render(false);



?>
