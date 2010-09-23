<?php

define("BaseDir", "/usr/local/freedomfone/");
define("ESLPath", BaseDir."/esl/native/ESL.php");
define("LogFile", "/tmp/pop3_daemon.log");
define("LogLevel", 3);  //1 = low, 2 = medium, 3 = high

$_SocketParam = array(
	      'host'=>'localhost',
	      'port'=>'8021',
	      'pass'=>'ClueCon',
	      'timeout'=>3,
	      'stream_timeout'=>0.5
	      );

$_OfficerouteParam1 = array(
			'host'=>'192.168.46.109',
	      		'user'=>'admin',
	      		'pass'=>'2n',
	      		'port'=>'110'
	      		);


$_OfficerouteParam = array(
		   array(
			'host'=>'192.168.46.109',
	      		'user'=>'Admin',
	      		'pass'=>'2n',
	      		'port'=>'110'
	      		),
		   array(
			'host'=>'192.168.46.109',
	      		'user'=>'101',
	      		'pass'=>'2n',
	      		'port'=>'110'
	      		),
		   array(
			'host'=>'192.168.46.109',
	      		'user'=>'102',
	      		'pass'=>'2n',
	      		'port'=>'110'
	      		),
		   array(
			'host'=>'192.168.46.109',
	      		'user'=>'103',
	      		'pass'=>'2n',
	      		'port'=>'110'
	      		));




?>