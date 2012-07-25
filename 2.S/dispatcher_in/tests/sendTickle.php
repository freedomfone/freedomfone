<?php
/**
 *
 * Connects to FreeSwitch and generates 1 SMS event every second. 
 * Used to test Poll application
 * 
 * php sendSMS $arg1 $arg2

 * $arg1 = sms ('test yes')
 * $arg2 = sender ('123456')
 *
 * 
 */ 

require_once('../config.php');
require_once('../../esl/php/fs_sock.php');


global $_SocketParam;

// uncommenting this will produce LARGE amounts of output
define('FS_SOCK_DEBUG', true);


	$obj = new fs_sock($_SocketParam,"logfile");

	while ($obj -> auth != true) {
    	   die(printf("Unable to authenticate\r\n"));

	   sleep(10);
	   }

	while (!$obj -> subscribe_events('custom message tickle')) {
    	   die(printf("Unable to subscribe to events"));

	   sleep(10);
	   }


	   $i=1;

	   while ($i){


    	   $cmd = "jsrun freedomfone/sms/tickle.js '".$argv[1]."' 'tickle'";
echo $cmd;
    	   $i++;

    
		$bg_return = $obj -> bgapi_command($cmd);
    		$obj -> debug($bg_return);

    		$output[] = $obj -> wait_for_event(time());
    		sleep(5);

	  }


$obj -> sock_close();

?>
