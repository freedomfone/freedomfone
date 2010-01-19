
<?php
/**
 *
 * Connects to FreeSwitch and generates 1 SMS event every second. 
 * Used to test Poll application
 * 
 * php autoSend $arg1 $arg2
 * 
 * $arg1 = code
 * $arg2 = answer
 * 
 */ 

require_once('../config.php');
require_once('../../esl/fs_sock.php');


global $_SocketParam;

// uncommenting this will produce LARGE amounts of output
define('FS_SOCK_DEBUG', true);


$code   = $argv[1] ;
$answer = $argv[2];


	$obj = new fs_sock($_SocketParam,"logfile");

	while ($obj -> auth != true) {
    	   die(printf("Unable to authenticate\r\n"));
	   sleep(10);
	   }

	while (!$obj -> subscribe_events('custom message')) {
    	   die(printf("Unable to subscribe to events"));
	   sleep(10);
	   }


	   $i=1;

	   while ($i){


    	   $cmd = "jsrun freedomfone/sms/main.js '$code $answer' 'receiver'";
    	   $i++;

    
		$bg_return = $obj -> bgapi_command($cmd);
    		$obj -> debug($bg_return);

    		$output[] = $obj -> wait_for_event(time());
    		sleep(5);

	  }


$obj -> sock_close();

?>
