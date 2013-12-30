<?php

define("LogFile", "/opt/freedomfone/log/gammu_daemon.log");
define("LogLevel", 3);  //1 = low, 2 = medium, 3 = high
define("BaseDir", "/opt/freedomfone/");
define("ESLPath", BaseDir."/esl/native/ESL.php");
define("TimeZone", "Africa/Harare");
/* Added by Hayden - 09.02.2013 */
define("panaceaPath", "/opt/freedomfone/gammu-smsd/classes/panacea_api.php");

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

/* Added by Hayden on 03.05.2013 */
$_DB_FF =  array(
     	   'host' => 'localhost',
	   'user' => 'freedomfone',
	   'pass' => 'thefone',
	   'db'   => 'freedomfone',
	   );


?>
