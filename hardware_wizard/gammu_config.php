<?php
include("config.php");
$data = file(HardwareDiscovery);

foreach($data as $key => $entry){

 $entry = explode(",",$entry);

 if($entry[6] == 'gammu'){
 $handle = fopen(HardwareDiscovery."-".$entry[0],'w');


 fwrite($handle, "[gammu]\n");
 fwrite($handle, "port = ".$entry[3]."\n");
 fwrite($handle, "connection = at\n\n\n");
 fwrite($handle, "[smsd]\n");
 fwrite($handle, "service = sql\n");
 fwrite($handle, "driver = native_mysql\n");
 fwrite($handle, "Logfile = syslog\n");
 fwrite($handle, "user = ".$gammu_credentials['user']."\n");
 fwrite($handle, "password = ".$gammu_credentials['password']."\n");
 fwrite($handle, "pc = localhost\n");
 fwrite($handle, "MaxRetries = 5\n");
 fwrite($handle, "database = ".$gammu_credentials['database']."\n");
 fwrite($handle, "phoneid = ".$entry[0]."\n");

  fclose($handle);
 }

}





?>