<?php
/****************************************************************************
 * gammu_daemon.php	- Retrieves incoming SMS from MySQL table, and created FreeSWITCH event.
 *			- gammu_daemon.php should run as a cronjob every x minutes.
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

//Include configuration file
include_once('config.php');
require_once(ESLPath);

//Open log file for writing
$handle = fopen(LogFile,'a');

//Connect to Gammu database
$res = mysql_connect($_DB['host'], $_DB['user'], $_DB['pass']);
mysql_select_db($_DB['db'],$res);

//Open ESL socket
$sock = new ESLconnection($_SocketParam['host'], $_SocketParam['port'], $_SocketParam['pass']);


      if($sock->connected()){

        logGammuIncoming('Socket: CONNECTION ESTABLISHED', 'INFO');

        //Select all messages from inbox
        $res = mysql_query("select * from inbox");

        //Loop through selected messages
        while($data = mysql_fetch_array($res)){
       
             $msg      = $data['TextDecoded'];
             $sender   = $data['SMSCNumber']; 
             $receiver = "N/A";
             $epoch    = strtotime($data['ReceivingDateTime']);
             
             //For each message, trigger an ESL event
             triggerEvent($sender, $receiver, $msg, $epoch);
   
             //Log incoming SMS
             logGammuIncoming("Inbox: ".$sender." ".$receiver." ".$msg." ".date('Y-m-j H:i:s',$epoch), 'INFO');

             //Delete message from Inbox
             mysql_query("delete from inbox where id = ".$data['ID']);
        }

           $sock->disconnect();
           logGammuIncoming('Socket: CONNECTION CLOSED', 'INFO');

      } else {

           logGammuIncoming('Socket: CONNECTION COULD NOT BE ESTABLISHED', 'WARNING');

      }



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



   function triggerEvent($sender, $receiver, $message, $epoch){

    global $sock;

            //Format command
            $cmd = "jsrun /opt/freeswitch/scripts/freedomfone/sms/main.js '".$message."' '".$sender."' '".$receiver."' '".$epoch."'";
            $result = $sock->api($cmd);

   }

?>
