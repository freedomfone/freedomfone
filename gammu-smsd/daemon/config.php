<?php

define("LogFile", "/var/tmp/gammu_daemon.log");
define("StatFile", "/var/tmp/");
define("LogLevel", 3);  //1 = low, 2 = medium, 3 = high
define("BaseDir", "/opt/freedomfone/");
define("ESLPath", BaseDir."/esl/native/ESL.php");


$_DB =  array(
     	   'host' => 'localhost',
	   'user' => 'root',
	   'pass' => 'qwerty',
	   'db'   => 'smsd',
	   );


$_SocketParam = array(
          'host'=>'localhost',
          'port'=>'8021',
          'pass'=>'ClueCon',
          'timeout'=>3,
          'stream_timeout'=>0.5
          );

?>
