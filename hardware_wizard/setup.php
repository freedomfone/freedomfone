<?php

include("config.php");

$hardware = HardwareDiscovery;
$stdin = fopen('php://stdin', 'r');
$file = file($hardware);
$handle = fopen(HardwareDiscovery,'w');

//For each hardware entry
foreach ($file as $key => $line){

	$entry = explode(',',trim($line));	

	echo "Hardware found: ".$entry[2]." ".$entry[4].", Port: ".$entry[3]."\n";
	echo "Would you like to enable this device (Y/N) ?\n";
	$enable = trim(fgets(STDIN));

	//Incorrct answer
	while(!preg_match('/[Yy]/', $enable) && !preg_match('/[Nn]/', $enable)){

	echo "(2) Would you like to enable this device (Y/N) ?\n";
	$enable = trim(fgets(STDIN));

	} 

	//Disable device
	if (preg_match('/[Nn]/', $enable)){

	  //Update file with disable flag
	  echo "Disable  device, let's move on";
	  $data[$key]['enable'] = 0;

	} 
	//Enable device
	else {

  	  $data[$key]['enable'] = 1;

	  //Update file with enable flag
	  echo "Will the device be used for SMS only (Y/N) ?\n";
	  $sms_only = trim(fgets(STDIN));

	  //Incorrct answer
	  while(!preg_match('/[Yy]/', $sms_only) && !preg_match('/[Nn]/', $sms_only)){

	  	echo "Will the device be used for SMS only (Y/N) ?\n";
	  	$sms_only = trim(fgets(STDIN));

	  } 

	  if (preg_match('/[Nn]/', $sms_only)){
	  
	  $data[$key]['gateway']  = 'freeswitch';
	  $data[$key]['inbound']  = 1;
	  $data[$key]['outbound'] = 0;
	  //Write fs config file

	  } else {

	  $data[$key]['gateway'] = 'gammu';
	  $data[$key]['inbound'] = 1;

	  echo "Will the device send SMS (Y/N) ?\n";
  	  $outbound= trim(fgets(STDIN));

	  while(!preg_match('/[Yy]/', $outbound) && !preg_match('/[Nn]/', $outbound)){

	  	echo "Will the device send SMS (Y/N) ?\n";
	  	$outbound = trim(fgets(STDIN));

	  } 

	  if (preg_match('/[Yy]/', $outbound)){

	  $data[$key]['outbound'] = 1;

	  } else {

	  $data[$key]['outbound'] = 0;

	  }


	  }

	}

	
	fwrite($handle, implode(",",array_slice($entry, 0, 5)).",".implode("," , $data[$key])."\n");

}

	fclose($handle);
?>

