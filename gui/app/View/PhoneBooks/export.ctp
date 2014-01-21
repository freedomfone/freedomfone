<?php
/****************************************************************************
 * export.ctp	- Export of phone book 
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

     $this->Csv->addRow($line);
     $filename = __('PhoneBook',true).'_'.$phonebook_name.'.csv';


	if($data){

            foreach($data as $entry){

                     $numbers[] = sizeof($entry['PhoneNumber']);    
            }

		foreach($data as $entry){


                    if (!$entry['Caller']['last_epoch']) {
                       $last_epoch = __('Never',true);
                    } else {
                      $last_epoch = date('Y-m-d H:i:s',$entry['Caller']['last_epoch']);
                    }
	
		    $line = array(
		      $entry['Caller']['name'],
		      $entry['Caller']['surname'],
		      $entry['Caller']['email'],
		      $entry['Caller']['skype'],
		      $entry['Caller']['organization'],
		      date('Y-m-d H:i:s',$entry['Caller']['created']),
		      $entry['Caller']['count_poll'],
		      $entry['Caller']['count_ivr'],
		      $entry['Caller']['count_lam'],
		      $entry['Caller']['count_bin'],
		      $entry['Caller']['count_callback'],
                      $this->element('services',array('service' => $entry['Caller']['first_app'])),
                      $this->element('services',array('service' => $entry['Caller']['last_app'])),
                      $last_epoch,
		      );

                      foreach($entry['PhoneNumber'] as $key => $number){
                      
                         $line[] = $number['number'];                   

                      }

		   $this->Csv->addRow($line);


		}

	}


		echo $this->Csv->render($filename);  
		$this->Csv->render(false);



?>
