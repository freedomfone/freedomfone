<?php

echo "<h1>".__("About",true)."</h1>";
echo "<h4>Release</h4>Freedom Fone v1.0, <i>aka: <a href='http://en.wikipedia.org/wiki/African_Wild_Dog'>Lycaon pictus pictus</a></i></p>";

echo "<h4>System</h4>";
echo "Server: ".apache_get_version()."<br/>";
printf("MySQL: %s\n", mysql_get_server_info());

?>

