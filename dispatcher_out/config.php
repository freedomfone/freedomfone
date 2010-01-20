<?php
/**
 * Core Configurations
 *
 * 
 */

/* FIXME! Move BasePath to globals */
define("BasePath", "/usr/local/freedomfone");
define("SpoolerOutDir", "dialer/spooler/incoming/");
define("SpoolerTmpDir", "/tmp/");
define("LogFile", "../log/dispatcher_out.log");
define("PidFile", "/usr/local/freedomfone/gui/app/webroot/system/pid/dispatcher_out.pid");

$_SpoolerOut = array(
	     'host'  => '127.0.0.1',
	     'port'  => '9999');


?>
