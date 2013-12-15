<?php
/****************************************************************************
 * gammu_detection.php	- 
 *			- gammu_detection.php should run once to setup the hardware.
 *
 * version 		- 1.1
 * 
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 *
 * The Initial Developer of the Original Code is
 *   Louise Berthilson <louise@it46.se>
 *
 * 
 * 
 ***************************************************************************/

echo "FIXME! Make sure that gammu and freeswitch are not running"."\n";

//Include configuration file
include_once('config.php');


//Open log file for writing
$handle0 = fopen(LogFile,'a');
$handle1 = fopen(GammuConfig,'w');
$handle2 = fopen(HardwareDiscovery,'w');

$dir = "/dev";
$files = scandir($dir);
$i = 0;
$data = array();
$imsis = array();
foreach($files as $key => $port){
	 if(preg_match("/USB|ACM/", $port)){

		 echo "Scanning ".$port."\n";

	 	 if($i==0){
		    fwrite($handle1, "[gammu]\n");
		 } else {
		   fwrite($handle1, "[gammu".$i."]\n");
		 }

		 fwrite($handle1, "port = /dev/".$port."\n");
		 fwrite($handle1, "connection = at\n\n\n");
		 $i++;
		 exec("gammu -c ".GammuConfig." -s ".($i-1)." --identify", $result);

		print_r($result);
		 //Gammu unit with id ($i+1) detected 
		 if(sizeof($result)> 1){
		     $imsi = trim(ltrim(strstr($result[5],":"),':'));

		     //If current IMSI is found for the first time
		     if(!in_array($imsi, $imsis)){
	   
			//add imsi to list of existing imsis
			$imsis[$i] = $imsi;		 
		 

			$data[$i]['IMSI']		=  trim(ltrim(strstr($result[5],":"),':'));
		     	$data[$i]['IMEI']  		=  trim(ltrim(strstr($result[4],":"),':'));
		     	$data[$i]['Manufacturer']  	=  trim(ltrim(strstr($result[1],":"),':'));
		     	$data[$i]['Device']  		=  trim(ltrim(strstr($result[0],":"),':'));
		     	$data[$i]['Model']  		=  trim(ltrim(strstr($result[2],":"),':'));


		     } else {

		     //If current IMSI has been detected before, overwrite
		      $key = array_search($imsi, $imsis);
		      $data[$key]['Device'] =  trim(ltrim(strstr($result[0],":"),':'));

		     }
		 }

		 unset($result);

	   }


}
	  //print_r($data);
	  foreach($data as $key => $entry){

	    fwrite($handle2, $entry['IMSI'].",".$entry['IMEI'].",".$entry['Manufacturer'].",".$entry['Device'].",".$entry['Model']."\n");

	  }
fclose($handle1);
fclose($handle2);


/*
 * Log events to LogFile
 *
 * $params string $msg, string $type, $protocol, $level
 * 
 * $msg      = Text message to be logged (including HTTP status code)
 * $type     = INFO, WARNING or ERROR
 * 
 */
   function logGammuIncoming($message, $type){

   global $handle;
   
   	    $string = date('Y-m-j H:i:s')." ".$type." ".$message."\n";
	    fwrite($handle, $string);
	  

   }




?>
