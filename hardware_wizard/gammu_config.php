<?php
include("config.php");
$data = file(HardwareDiscovery);

foreach($data as $key => $entry){

 $entry = explode(",",$entry);
print_r($entry); 

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





?>
