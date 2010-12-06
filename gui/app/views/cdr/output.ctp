<?php
/****************************************************************************
 * export.ctp	- Export phone book to cvs file 
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


	$line = array(__('Name',true),__('Surname',true),__('Email',true),__('Skype',true),__('Organization',true),__('Poll count',true),__('IVR count',true),__('Leave-a-message count',true),__('SMS count',true),__('First application',true),__('Last application',true),__('First seen',true),__('Last seen',true),__('ACL',true));
	$csv->addRow($line);

	if($data){


		foreach($data as $entry){
	
		$line = array( $entry['PhoneBook']['name'],
			       $entry['PhoneBook']['surname'],
			       $entry['PhoneBook']['email'],
			       $entry['PhoneBook']['skype'],
                               $entry['PhoneBook']['organization'],
                               $entry['PhoneBook']['count_poll'],
			       $entry['PhoneBook']['count_ivr'],
			       $entry['PhoneBook']['count_lam'],
			       $entry['PhoneBook']['count_bin'],
			       $entry['PhoneBook']['first_app'],
			       $entry['PhoneBook']['last_app'],
			       $entry['PhoneBook']['first_epoch'],
			       $entry['PhoneBook']['last_epoch']);
 

		$csv->addRow($line);

		}

	}
		$prefix=date('Y-m-d');
		echo $csv->render($prefix."_".__('PhoneBook',true));  
		$csv->render(false);


?>