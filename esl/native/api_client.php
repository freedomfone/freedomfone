<?php
require_once('ESL.php');
$command = $argv[1];
$esl = new eslConnection('127.0.0.1', '8021', 'ClueCon');
$e = $esl->sendRecv("api $command");
print $e->getBody();

