<?php
/****************************************************************************
 * config.php	- Configuration parameters for spooler tables, and application settings
 * version 	- 2.0.1215
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

$config['poll_in']= array(
      	       'host'     => 'localhost',
	       'user'     => 'poll_in',
	       'password' => 'thefone',
	       'database' => 'spooler_in',
	       );

$config['bin']= array(
      	       'host'     => 'localhost',
	       'user'     => 'bin',
	       'password' => 'thefone',
	       'database' => 'spooler_in',
	       );


$config['lm_in']= array(
      	       'host'     => 'localhost',
	       'user'     => 'lm_in',
	       'password' => 'thefone',
	       'database' => 'spooler_in',
	       );

$config['monitor_ivr']= array(
      	       'host'     => 'localhost',
	       'user'     => 'monitor_ivr',
	       'password' => 'thefone',
	       'database' => 'spooler_in',
	       );

$config['cdr']= array(
      	       'host'     => 'localhost',
	       'user'     => 'cdr',
	       'password' => 'thefone',
	       'database' => 'spooler_in',
	       );

$config['gsmopen']= array(
      	       'host'     => 'localhost',
	       'user'     => 'gsmopen',
	       'password' => 'thefone',
	       'database' => 'spooler_in',
	       );

	       	      
$config['public_api']= array(
               'user'      => 'api',
               'password' => 'thefone',
               );

/*
 *
 * Application specific settings
 *
 * Always use trailing slash after url or path
 *
 */

$config['LM_SETTINGS'] = array(
		'host'	           =>  MY_DOMAIN,
		'path'             => 'freedomfone/leave_message/',
		'dir_messages'     =>  'messages/',
		'dir_menu'         =>  'audio_menu/',
		'dir_conf'         =>  'conf/',
                'instance_min'     => '100',
                'instance_max'     => '119'
		);

$config['LM_DEFAULT']=	array(
	        'lmWelcomeMessage' => 'Welcome to Freedom Fone Leave a Message Service.',
     	        'lmInformMessage'  => 'Record your message after the beep. To Finish, hang up.',
                'lmInvalidMessage' => 'No, No! No! Wrong key!',
		'lmLongMessage'    => 'Your message is too long, to the point, please!',
		'lmSelectMessage'  => 'To Play... press *. To Delete... press 0. To Save... press 1.',
		'lmDeleteMessage'  => 'Your message has been deleted!',
		'lmSaveMessage'    => 'Thank you!',
		'lmGoodbyeMessage' => 'Goodbye',
                'lmOnHangup'       => 'delete',
                'lmForceTTS'       =>  false,
                'lmMaxreclen'      =>  120
                );


$config['IVR_SETTINGS'] = array(
		'host'	           => MY_DOMAIN,
		'path'             => 'freedomfone/ivr/',
		'curl'             => 'xml_curl/',
		'dir_node'         => 'nodes/',
		'dir_menu'         => 'ivr/',
		'dir_conf'         => 'conf/',
                'instance_start'   => '100',
                'instance_end'     => '119',
                'showLengthMin'    => '13',
                'showLengthMax'    => '50',
		);


$config['IVR_DEFAULT']=	array(
	        'parent_ivr'       => 'freedomfone_ivr_100',
                'ivrIndexMessage'  => 'To repeat the menu, press 9.',
                'ivrLongMessage'   => 'Hello and Welcome to Freedom Fone',
		'ivrShortMessage'  => 'Navigate through the menu by pressing any number between 1 and 8.',
                'ivrInvalidMessage'  => 'Invalid option. Please try again.',
		'ivrExitMessage'   => 'Thank you and good bye.');


$config['IVR_MONITOR']=	array(
	        'script'             => 'scripts/freedomfone/monitor_ivr/main.js'
		);

	
$config['FREESWITCH']=		array(
	      'host'=>'localhost',
	      'port'=>'8021',
	      'pass'=>'ClueCon'
	      );

$config['ESL']	= array(
	      'path' =>BASE_DIR."esl/native/ESL.php");

$config['EXTENSIONS'] = array(
		      'lam' => '2',
		      'ivr' => '4',
                      'selector' => '4',
		      );

$config['EXT_MAPPING'] = array(
		      'lam' => '/^2(\d{3})/',
		      'ivr' => '/^4(\d{3})/',
		      );

$config['LANGUAGES'] = array(
                            'eng' => 'English',
                            'swa' => 'Swahili',
                            'esp' => 'Spanish',
                            'fre' => 'French',
                            );

$config['RSS']	= array(
	      'path' =>'http://freedomfone.org/updates.xml',
              'max'  => 3
                        );

$config['OR_MIB']= array( 
                'sim_inserted' => array('No', 'Yes'),
                'network_registration' => array('Not registered', 'Registered to home network','Searching for network','Registration denied','Unknown','Registered roaming')
                );

$config['OR_SNMP']= array(
                        array('ip_addr'   => '192.168.1.46',
                              'community' => 'public' , 
                              'object_id' => '1.3.6.1.4.1.6530.4.2.2.1'
                             ));



?>
