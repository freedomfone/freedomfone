<?php
/****************************************************************************
 * export.ctp	- Export of phone book 
 * version 	- 2.5.1700
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
 ***************************************************************************

        //Calculate max number of phone numbers for each entry

        if ($data){

            foreach($data as $entry){

                     $numbers[] = sizeof($entry['PhoneNumber']);    
            }

        }

        //Create data headers
       $line = array(__('Name',true),__('Surname',true),__('Email',true),__('Skype',true),__('Organization',true),__('In the system since',true),__('Poll count',true),__('Voice menu count',true),__('Leave-a-message count',true),__('SMS count',true), __('Callback count',true),__('First application',true),__('Last application',true),__('Last active',true));

       $i = 1;
       while($i<= max($numbers)){

       $line[] = __('Phone number',true).' '.$i;
       $i++;
       }

     $csv->addRow($line);
     $filename = __('PhoneBook',true).'_'.$phonebook_name.'.csv';


	if($data){

            foreach($data as $entry){

                     $numbers[] = sizeof($entry['PhoneNumber']);    
            }

		foreach($data as $entry){


                    if (!$entry['User']['last_epoch']) {
                       $last_epoch = __('Never',true);
                    } else {
                      $last_epoch = date('Y-m-d H:i:s',$entry['User']['last_epoch']);
                    }
	
		    $line = array(
		      $entry['User']['name'],
		      $entry['User']['surname'],
		      $entry['User']['email'],
		      $entry['User']['skype'],
		      $entry['User']['organization'],
		      date('Y-m-d H:i:s',$entry['User']['created']),
		      $entry['User']['count_poll'],
		      $entry['User']['count_ivr'],
		      $entry['User']['count_lam'],
		      $entry['User']['count_bin'],
		      $entry['User']['count_callback'],
                      $this->element('services',array('service' => $entry['User']['first_app'])),
                      $this->element('services',array('service' => $entry['User']['last_app'])),
                      $last_epoch,
		      );

                      foreach($entry['PhoneNumber'] as $key => $number){
                      
                         $line[] = $number['number'];                   

                      }

		   $csv->addRow($line);


		}

	}


		echo $csv->render($filename);  
		$csv->render(false);



?>
