<?php

define("LogFile", "/opt/freedomfone/log/gammu_daemon.log");
define("GammuConfig", "/tmp/gammu.rc");
define("GammuDiscovery", "/tmp/gammu-discovery");
define("LogLevel", 3);  //1 = low, 2 = medium, 3 = high
define("BaseDir", "/opt/freedomfone/");
define("ESLPath", BaseDir."/esl/native/ESL.php");
define("TimeZone", "Africa/Harare");


$_DB =  array(
     	   'host' => 'localhost',
	   'user' => 'smsd',
	   'pass' => 'thefone',
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
