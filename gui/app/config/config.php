<?php
/****************************************************************************
 * config.php	- Configuration parameters for spooler tables, and application settings
 * version 	- 1.0.360
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


$config['callback_in']= array(
      	       'host'     => 'localhost',
	       'user'     => 'callback_in',
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
		'dir_conf'         =>  'conf/'
		);

$config['LM_DEFAULT']=	array(
	        'lmWelcomeMessage' => 'Welcome to Freedom Fone Leave a Message Service!',
     	        'lmInformMessage'  => 'Record your message after the beep. To Finish, Press #',
                'lmInvalidMessage' => 'No, No! No! Wrong key!',
		'lmLongMessage'    => 'Your message is too long, to the point, please!',
		'lmSelectMessage'  => 'To Play... press *. To Delete... press 0. To Save... press 1',
		'lmDeleteMessage'  => 'Your message has been deleted!',
		'lmSaveMessage'    => 'Thank you!',
		'lmGoodbyeMessage' => 'Goodbye');


$config['IVR_SETTINGS'] = array(
		'host'	           => MY_DOMAIN,
		'path'             => 'freedomfone/ivr/',
		'curl'             => 'xml_curl/',
		'dir_node'        =>  'nodes/',
		'dir_menu'         =>  'ivr/',
		'dir_conf'         =>  'conf/'
		);


$config['IVR_DEFAULT']=	array(
	        'parent_ivr'       => 'freedomfone_ivr_'.IID,
                'ivrIndexMessage'  => 'To repeat the menu, press 9.',
                'ivrLongMessage'   => 'Hello and Welcome to Freedom Fone',
		'ivrShortMessage'  => 'Navigate through the menu by pressing any number between 1 and 8.',
                'ivrInvalidMessage'  => 'Invalid option. Please try again.',
		'ivrExitMessage'   => 'Thank you and good bye.');


$config['CALLBACK_DEFAULT']=	array(
	        'sms_code'	   => 'CALLBACK',
                'response_type'     =>  array ('4000' =>'IVR','2000' =>'Leave-a-Message'),
                'limit_user'       => '10',
                'limit_time'       => '24');

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
		      'lam' => '2000',
		      'ivr' => '4000',
		      );

$config['VERSION'] = array(
		   'dispatcher_in'  => '/freedomfone/freedomfone/version/dispatcher_in',
		   'dispatcher_out' => '/freedomfone/freedomfone/version/dispatcher_out'
		   );
?>
