<?php

define("BaseDir", "/opt/freedomfone/");
define("ESLPath", BaseDir."/esl/native/ESL.php");
define("LogFile", "/opt/freedomfone/log/pop3_daemon.log");
define("LogLevel", 3);  //1 = low, 2 = medium, 3 = high

$_SocketParam = array(
	      'host'=>'localhost',
	      'port'=>'8021',
	      'pass'=>'ClueCon',
	      'timeout'=>3,
	      'stream_timeout'=>0.5
	      );

$_OfficerouteParamSingle = array(
                               array(
                                'host'=>'192.168.1.46',
	      		        'user'=>'Admin',
	      		        'pass'=>'2n',
	      		        'port'=>'110'
	      		        ));


$_OfficerouteParamMulti = array(
		           array(
                                'host'=>'192.168.1.46',
	      		        'user'=>'Admin',
	      		        'pass'=>'2n',
	      		        'port'=>'110'
	      		        ),
		           array(
                                'host'=>'192.168.1.46',
	      		        'user'=>'or1sim1',
	      		        'pass'=>'2n',
	      		        'port'=>'110'
	      		        ),
		           array(
                                'host'=>'192.168.1.46',
	      		        'user'=>'or1sim2',
	      		        'pass'=>'2n',
	      		        'port'=>'110'
	      		        ),
		           array(
                                'host'=>'192.168.1.46',
	      		        'user'=>'or1sim3',
	      		        'pass'=>'2n',
	      		        'port'=>'110'
	      		        ),
		           array(
                                'host'=>'192.168.1.46',
	      		        'user'=>'or1sim4',
	      		        'pass'=>'2n',
	      		        'port'=>'110'
	      		        ));


?>
