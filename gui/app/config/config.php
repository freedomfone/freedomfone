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

$config['gsmopen']= array(
      	       'host'     => 'localhost',
	       'user'     => 'gsmopen',
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
		'dir_conf'         =>  'conf/',
                'instance_min'     => 100,
                'instance_max'     => 109,
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
                'lmForceTTS'       =>  false
                );


$config['IVR_SETTINGS'] = array(
		'host'	           => MY_DOMAIN,
		'path'             => 'freedomfone/ivr/',
		'curl'             => 'xml_curl/',
		'dir_node'        =>  'nodes/',
		'dir_menu'         =>  'ivr/',
		'dir_conf'         =>  'conf/',
                'instance_min'     => 100,
                'instance_max'     => 110,
		);


$config['IVR_DEFAULT']=	array(
	        'parent_ivr'       => 'freedomfone_ivr_100',
                'ivrIndexMessage'  => 'To repeat the menu, press 9.',
                'ivrLongMessage'   => 'Hello and Welcome to Freedom Fone',
		'ivrShortMessage'  => 'Navigate through the menu by pressing any number between 1 and 8.',
                'ivrInvalidMessage'  => 'Invalid option. Please try again.',
		'ivrExitMessage'   => 'Thank you and good bye.');


$config['CALLBACK_DEFAULT']=	array(
	        'sms_code'	   => 'CALLBACK',
                'response_type'     =>  array ('4100' =>'IVR','2100' =>'Leave-a-Message'),
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
		      'lam' => '2100',
		      'ivr' => '4100',
		      );

$config['EXT_MAPPING'] = array(
		      'lam' => '/^2(\d{3})/',
		      'ivr' => '/^4(\d{3})/',
		      );

$config['LANGUAGES'] = array(
                            'eng' => __('English',true),
                            'swa' => __('Swahili',true),
                            'esp' => __('Spanish',true)
                                                  );

$config['RSS']	= array(
	      'path' =>'https://dev.freedomfone.org/timeline?ticket=on&changeset=on&milestone=on&wiki=on&max=5&daysback=365&format=rss');


?>
