<?php
/**
 * Core Configurations
 *
 * 
 */
define("ParentXML", "ff-event");
define("DefaultXSL", "default.xsl");
define("DirXSL", "templates/");
define("LogFile", "/tmp/dispatcher_in.log");
define("LocalDomain", "http://demo.freedomfone.org/freedomfone/");

$_SocketParam = array(
	      'host'=>'localhost',
	      'port'=>'8021',
	      'pass'=>'ClueCon',
	      'timeout'=>3,
	      'stream_timeout'=>0.5
	      );


$_DispatcherDB = array(
	      'host'=>'localhost',
	      'user'=>'dispatcher_in',
	      'password'=>'thefone',
	      'database'=>'spooler_in'
	      );

$_AllowCURL = array('callback_in' => 'callback_in');

?>



