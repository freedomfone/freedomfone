<?php
/**
 * Core Configurations
 *
 * 
 */
define("LogFile", "../log/dialer.log");
define("SpoolerSavedDir", "dialer/spooler/saved/");
define("BasePath", "/usr/src/pictus/");
define("Redial", "5");
define("RedialSleep", "60");
define("DefaultSleep", "5");

$_SocketParam = array(
	      'host'=>'localhost',
	      'port'=>'8021',
	      'pass'=>'ClueCon',
	      'timeout'=>3,
	      'stream_timeout'=>0.5
	      );

$_DialerParam = array(
	      'GSM' => array ('originate {ignore_early_media=true}gsmopen/interface1/','XML default'),
	      'SIP' => array ('originate user/','XML default')
	      );
?>




