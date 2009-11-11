<?php
//**
//
// Database parameters for the spooler
//
//**



$config['poll_in']= array(
      	       'host'     => 'localhost',
	       'user'     => 'poll_in',
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

//**
//
// Application specific settings
//
// Always use trailing slash after url or path
//
//**
$config['LM_SETTINGS'] = array(
		'host'	           => 'http://demo.freedomfone.org/freedomfone/',
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
		'host'	           => 'http://demo.freedomfone.org/freedomfone',
		'path'             => 'freedomfone/ivr/',
		'curl'             => 'xml_curl/',
		'dir_node'        =>  'nodes/',
		'dir_menu'         =>  'ivr/',
		'dir_conf'         =>  'conf/'

		);


$config['IVR_DEFAULT']=	array(
	        'parent_ivr'       => 'freedomfone_ivr_'.IID,
                'ivrIndexMessage'  => 'To repeat the menu, press 9.',
                'ivrInvalidMessage'  => 'Invalid option. Please try again.',
		'ivrExitMessage'   => 'Thank you and good bye.');


$config['CALLBACK_DEFAULT']=	array(
	        'sms_code'	   => 'CALLBACK',
                'response_type'     =>  array ('4000' =>'IVR','2000' =>'Leave-a-Message'),
                'limit_user'       => '10',
                'limit_time'       => '24');

	

?>
