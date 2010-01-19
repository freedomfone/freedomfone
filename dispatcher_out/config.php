<?php
/**
 * Core Configurations
 *
 * 
 */

/* FIXME! Move BasePath to globals */
define("BasePath", "/usr/src/pictus/");
define("SpoolerOutDir", "dialer/spooler/incoming/");
define("SpoolerTmpDir", "/tmp/");
define("LogFile", "../log/dispatcher_out.log");
define("PidFile", "/usr/src/pictus/freeswitch/scripts/freedomfone/pid/dispatcher_out.pid");

$_SpoolerOut = array(
	     'host'  => '127.0.0.1',
	     'port'  => '9999');


?>