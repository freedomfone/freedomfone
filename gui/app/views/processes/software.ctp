<?php
/****************************************************************************
 * software.ctp	- List software versions
 * version 	- 1.0.369
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
 ***************************************************************************/


 $os = php_uname('s');

$cmd1 = exec('/usr/bin/lsb_release -d');
$cmd2 = exec('/usr/bin/lsb_release -a');
$release = $lsb = false;

if($cmd1){ $release = explode(':',$cmd1); }
if($cmd2){ $lsb = explode(':',$cmd2); }


 $string = $os.', '.$release[1].', '.$lsb[1];

     echo "<h1>".__("System software",true)."</h1>";
     $row[] = array(__("Operating system",true).": ", $string); 
     $row[] = array(__("FreeSWITCH",true).": ", $version[1]); 
     $row[] = array(__("Web server",true).": ", apache_get_version());
     $row[] = array(__("MySQL",true).": ", mysql_get_server_info());
     $row[] = array(__("Dispatcher",true).": ", $version[0]);

    echo "<table width='70%'>";
    echo $html->tableCells($row);
    echo "</table>"; 
 




