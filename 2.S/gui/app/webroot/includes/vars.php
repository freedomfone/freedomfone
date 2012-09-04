<?php

//session_start();

//Initialization of global variables
$titleArray = array();
$report = array();
$reportByTitle=array();
$call = array();
$durations = array();
$from;
$to;
$uploadPath = "/opt/freedomfone/gui/app/tmp/graphs.csv";
$error = "<div class='error bold'>Please fix the following problems:</div>";
$hasErrors = false;
$pageTitle = "Reporting";

//Align columns from CSV
$dateColumn = 0;
$yearColumn = 1;
$monthColumn = 2;
$dayColumn = 3;
$timeColumn = 4;
$titleColumn = 5;
$callersColumn = 6;
$callerTypeColumn = 7;
$durationColumn = 8;

//System Settings
date_default_timezone_set('Africa/Harare');
?>
