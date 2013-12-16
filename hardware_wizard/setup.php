<?php

include("config.php");

$hardware = HardwareDiscovery;
$stdin = fopen('php://stdin', 'r');
$file = file($hardware);
$handle = fopen(HardwareDiscovery,'w');
$fs = $gm = 0;


//STEP 1: WIZARD


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
	  $data[$key]['gateway'] = 'false';
	  $data[$key]['inbound'] = 'false';
	  $data[$key]['outbound'] = 'false';
	  $data[$key]['interface_id'] = 'false';

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
	  
	  $fs ++;
	  $data[$key]['gateway']  = 'freeswitch';
	  $data[$key]['inbound']  = 1;
	  $data[$key]['outbound'] = 0;
	  $data[$key]['interface_id'] = "FS".$fs."-".$entry[0];
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

	  $data[$key]['interface_id'] = "GM".$gm."-".$entry[0];
	  }

	}

	
	fwrite($handle, implode(",",array_slice($entry, 0, 5)).",".implode("," , $data[$key])."\n");

}

	fclose($handle);

//STEP 2: GAMMU CONFIG


$data = file(HardwareDiscovery);

foreach($data as $key => $entry){

 $entry = explode(",",$entry);


if($entry[6] == 'gammu'){
 $handle = fopen(GammuConfigDir."gammu-smsdrc-".$entry[0],'w');


 fwrite($handle, "[gammu]\n");
 fwrite($handle, "port = ".$entry[3]."\n");
 fwrite($handle, "connection = at\n\n\n");
 fwrite($handle, "[smsd]\n");
 fwrite($handle, "service = sql\n");
 fwrite($handle, "driver = native_mysql\n");
 fwrite($handle, "debuglevel = 3\n");
 fwrite($handle, "Logfile = ".GammuLogDir."gammu-GM".($key+1)."-".$entry[0].".log\n");
 fwrite($handle, "user = ".$gammu_credentials['user']."\n");
 fwrite($handle, "password = ".$gammu_credentials['password']."\n");
 fwrite($handle, "pc = localhost\n");
 fwrite($handle, "MaxRetries = 5\n");
 fwrite($handle, "database = ".$gammu_credentials['database']."\n");
 fwrite($handle, "phoneid = GM".($key+1)."-".$entry[0]."\n");

  fclose($handle);
 }

}


//STEP 3: GSMOPEN CONFIG

$data = file(HardwareDiscovery);
$i = 0;

$writer = new XMLWriter();  
$writer->openURI(GsmOpenConfig);  
$writer->startDocument('1.0','UTF-8');  
$writer->setIndent(4);   

$writer->startElement('configuration');  
$writer->writeAttribute('name','gsmopen.conf');
$writer->writeAttribute('description','GSMopen Configuration');
$writer->startElement('global_settings');  

$writer->startElement('param');  
$writer->writeAttribute('name' , 'debug');
$writer->writeAttribute('value','8');
$writer->endElement();  

$writer->startElement('param');  
$writer->writeAttribute('name', 'dialplan');
$writer->writeAttribute('value','XML');
$writer->endElement();  

$writer->startElement('param');  
$writer->writeAttribute('name', 'context');
$writer->writeAttribute('value','default');
$writer->endElement();  

$writer->startElement('param');  
$writer->writeAttribute('name', 'hold-music');
$writer->writeAttribute('value', '$${moh_uri}');
$writer->endElement();  

$writer->startElement('param');  
$writer->writeAttribute('name', 'destination');
$writer->writeAttribute('value','5000');
$writer->endElement();  


$writer->endElement();  //global_settings
$writer->startElement('per_interface_settings');  


foreach($data as $key => $entry){

  $i++;
 $entry = explode(",",$entry);

 if($entry[6] == 'freeswitch'){

    //find port for audio
    $no = substr($entry[3], -1);
    $audio = intval($no)-1;
    $audio_port = substr($entry[3], 0, -1).$audio;

    $writer->startElement('interface');  
    $writer->writeAttribute('id',$i); //FS{x}-IMSI
    $writer->writeAttribute('name',"FS".$i."-".$entry[0]); //FS{x}-IMSI

    $writer->startElement('param');  
    $writer->writeAttribute('name', 'controldevice_name'); //Port number
    $writer->writeAttribute('value',$entry[3]); //Port number
    $writer->endElement();  

    $writer->startElement('param');  
    $writer->writeAttribute('name', 'controldevice_audio_name');
    $writer->writeAttribute('value', $audio_port); // Port number -1
    $writer->endElement();  

    $writer->startElement('param');  
    $writer->writeAttribute('name', 'destination'); // Extention
    $writer->writeAttribute('value','500'.($i-1)); // Extention
    $writer->endElement();  


 }

}

$writer->endElement(); //per_interface_settings
$writer->endElement();  //configuration
$writer->endDocument();  
$writer->flush();  






?>

