<?php
require_once('../../esl/native/ESL.php');
$cmd = "jsrun /opt/freeswitch/scripts/freedomfone/sms/gammu_main.js '".$argv[1]."' '".$argv[2]."' '".$argv[3]."' '".(time()*1000000)."'";
echo $cmd;

$esl = new eslConnection('127.0.0.1', '8021', 'ClueCon');
if ( $esl->connected() ) {
	$e = $esl->sendRecv("api $cmd");
	print $e->getBody(); } 
	else {
	echo "Can not connect to Freeswitch\n\n";
	}
