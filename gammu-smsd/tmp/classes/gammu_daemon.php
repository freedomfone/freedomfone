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
             $sender   = $data['SenderNumber']; 
             $receiver = "N/A";
	     date_default_timezone_set(TimeZone);

             $epoch    = strtotime($data['ReceivingDateTime']);
             $epochMicro    = number_format($epoch*1000000, 0, '.', '');

             //For each message, trigger an ESL event
             triggerEvent($sender, $receiver, $msg, $epochMicro);
   
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












// alter all NULL folder Id's to be in main inbox 
mysql_query("UPDATE bin SET smsfolder_id = 1 WHERE smsfolder_id=NULL"); 




/* NB Below code is ugly. It is intended to be written into a class to be included either in a new daemon, or run within a controller by virtue of a cronjob - Hayden 03-0202013 */

require_once(panaceaPath);

/* get outbox entries from FF database and inject into gammu - hayden 07-01-2013 */
$res = mysql_connect($_DB_FF['host'], $_DB_FF['user'], $_DB_FF['pass']);
mysql_select_db($_DB_FF['db'],$res);

echo " *** Getting username and password info for panacea and clickatell users *** " . date('H:i:s') . "\n ";

/* Get username and password details for Panacea and Clickatell */
$res = mysql_query("select * from smssettings");
$row1 = mysql_fetch_assoc($res);
$panUser = $row1['text_user_pan'];
$panPass = $row1['text_pass_pan'];
$clickUser = $row1['text_user_cli'];
$clickPass = $row1['text_pass_cli'];
$clickApiKey = $row1['api_id_cli'];

$api = new PanaceaApi();
$api->setUsername($panUser);
$api->setPassword($panPass);

/* Get IP details for SIP */
$res = mysql_query("select IP from smssips");
$row1 = mysql_fetch_assoc($res);
$IpSip = $row1['IP'];

/* Read all entries from FF outbox */
echo " *** make new query *** \n ";
$res2 = mysql_query("select * from outbox where date_to_be_sent < NOW() and status = 1");


/* Loop through each outbox message and process as OR, Dongle or Web client */
echo " *** Checking freedomfone outbox *** \n";
$countMessages = 0;

if (mysql_num_rows($res2) > 0) {
	echo ' *** Shutting down Freeswitch *** ';
	$pluto = 'manguensis';
	shell_exec('sudo -S service freeswitch stop');
	         	         
	/* Stop daemon */

	$daemonCommandBase = 'echo "' . $pluto . '" | sudo -S /etc/init.d/gammu-smsd';
	$daemonCommandStop =  $daemonCommandBase . ' stop';
	$daemonResult = shell_exec($daemonCommandStop);    
		
	/* Start daemon */
	sleep(5);
	$daemonCommandStart =  $daemonCommandBase . ' start';
	$daemonResult = shell_exec($daemonCommandStart);        


	/* Create new smsdrc file */
	$sedCommand = 'echo "' . $pluto . 
		'" | sudo -S sed "s/port1_xxx/' . $port1 . 
		'/" /etc/gammu-smsdrc_xx | sed "s/port2_xxx/' . $port2 . 
		'/" > /etc/gammu-smsdrc';
		
	$sedResult1 = shell_exec($sedCommand);
		
}

while($data = mysql_fetch_array($res2)) {



	$countMessages++;
	echo " *** Checking freedomfone outbox *** " . $data['id'] . "\n";
	$id = $data['id'];
	$receiver = trim($data['receiver']);
	$message = $data['body'];
	$sender = trim($data['sender']);
	$batchId = $data['batch_id'];
	echo 'data channel is  ' . $data['channel'] . "\n";
	$relativeValidity = 255;
	
	/* Send text with Office Route */
	if ($data['channel'] == 'SIP') {
		$IpSip = 'kubatana01.com';
		echo " * * * Using SIP Channel * * * \n";
		echo 'connecting to IP address ' . $IpSip . "\n";
		mysql_query("update outbox set status = 2 where id = '$id'");
		$ch = curl_init($IpSip);
		curl_setopt($ch, CURLOPT_NOBODY, true);
		curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
		curl_exec($ch);
		$retcode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
		curl_close($ch);
		echo 'Attempting to send message through ' . $IpSip . "\n";
		if (200 == $retcode) {
			/* Set outbox as status processing */
			$subject = 'Outgoing SMS from Freedom Fone';
			$headers = 'From: sms@'.$IpSip . "\r\n" .
				'reply-To: sms@'.$IpSip . "\r\n" .
				'X-Mailer: PHP/' . phpversion();

			 $to      = $receiver."@". $IpSip;  
			mail($to, $subject, $message, $headers);
			$status = 1;
			echo $headers;
			echo "\n";
			echo $to;


		} 
		else {
			echo ' ** SIP Fail: return code ' . $retcode . " *** \n";
			$status = 0;
		}
		
		/* Copy message to sent items and delete outbox record */
		insertBinsent($message, $sender, $receiver, $batchId, $status, 'SIP');
		deleteOutboxId($id);		  
	
		
	}
	
	/* Send message with Dongle */
	elseif (trim($data['channel']) == 'USB') {
	echo 'USB channel being used';
		$query="insert into outbox (DestinationNumber, TextDecoded, SenderID, RelativeValidity) values ('$receiver','$message','','255')";
		
		
		echo $query; 
		
		/* Inject into gammu outbox */
		mysql_close();
		$connectGammu = mysql_connect($_DB['host'], $_DB['user'], $_DB['pass']);
		mysql_select_db($_DB['db'],$connectGammu);
                $resGammu = mysql_query($query) or die(mysql_error());
                
                /* Get final inserted ID from gammu db */
                $resGammu2 = mysql_query("select last_insert_id() as id");
                $idGammu=mysql_fetch_assoc($resGammu2);
                $idGammu=$idGammu['id']; 
                mysql_close();
                
                echo "*** gammu outbox injection made *** \n";
                
                
                /* Tag FF outbox id as 'processing' */
                $connectFF = mysql_connect($_DB_FF['host'], $_DB_FF['user'], $_DB_FF['pass']);
		mysql_select_db($_DB_FF['db'],$connectFF);
		 $query = "update outbox set status = 2, third_party_id = '$idGammu' where id = '$id'";
		     mysql_query($query);
		     mysql_close();
	}
	/* Send message with third party web provider */
	elseif ($data['channel'] == 'Panacea') {
		echo "Panacea running \n";
		$result = $api->message_send($receiver, $message, $sender);
		if($api->ok($result)) {
			$messageStatus = $api->message_status($result['details']);
			$panStatus = $messageStatus['details']['status'];

		} 
		else {
		/* There was an error */
			$panStatus = $api->getError();
		}

		$connectFF = mysql_connect($_DB_FF['host'], $_DB_FF['user'], $_DB_FF['pass']);
		insertBinsent($message, $sender, $receiver, $batchId, $panStatus, 'Web') ;
		echo 'deleting from outbox id ' . $id . "\n";
		$deleteStatus = deleteOutboxId($id);
		mysql_close();
	}
	elseif ($data['channel'] == 'Clickatell') {
		echo 'testing clickatell' . "\n";
		echo 'message is ' . $message . "\n";
		
		$messageURL = urlencode($message);
		$url = "https://api.clickatell.com/http/sendmsg?user=$clickUser&password=$clickPass&api_id=$clickApiKey&to=$receiver&text=$messageURL&from=$sender";
		echo $url; // exit();
		$ret = file($url);
		$sess = explode(':', $ret[0]);
		print_r($sess);
		if (trim($sess[0]) == 'ID') {
			$clickStatus = 1;

		} 
		else {
			$clickStatus = 'Authentication failure: '. $ret[0];
		}
		$connectFF = mysql_connect($_DB_FF['host'], $_DB_FF['user'], $_DB_FF['pass']);
		insertBinsent($message, $sender, $receiver, $batchId, $clickStatus, 'Web') ;
		deleteOutboxId($id);	
		mysql_close();
	}

}

	// echo ' *** Restarting Freeswitch *** ';
	// shell_exec('sudo -S service freeswitch start');

	echo 'count messages is: ' . $countMessages . "\n"; 
	// Update sms stats
	$res = mysql_connect($_DB_FF['host'], $_DB_FF['user'], $_DB_FF['pass']);
	mysql_select_db($_DB_FF['db'],$res);
	echo "Updating message counter \n";

	$res = mysql_query("select total_messages from smsstats where id = 1");
	$row1 = mysql_result($res, 0);

	$newCount = $row1 + $countMessages;
	echo "UPDATE smsstats SET total_messages=$newCount WHERE id=1";

	$result = mysql_query("UPDATE smsstats SET total_messages=$newCount WHERE id=1");
	echo 'result of update count is ' . $newCount;

	/* read sent items from gammu and send them to FF - Hayden - 05.01.2013 */

	//Connect to Gammu database
	$res = mysql_connect($_DB['host'], $_DB['user'], $_DB['pass']);
	mysql_select_db($_DB['db'],$res);


	//Select all messages from inbox
	 $res2 = mysql_query("select * from sentitems");
	  mysql_close();
	  
	//Connect to FF database
	$resFF = mysql_connect($_DB_FF['host'], $_DB_FF['user'], $_DB_FF['pass']);
	mysql_select_db($_DB_FF['db'],$resFF);

	echo "*** FF DB connected again *** " . date('H:i:s') . "\n";

	//Loop through selected messages in extracted gammu array and 1. inject into FF "binsent" 2. Delete from FF outbox
	while($data = mysql_fetch_array($res2)){
		echo " *** looping through gammu sentitems *** \n";
		/* Loop through gammu sentitems */
		$gammu_sentitems_id[] = $data['ID'];
		$msg = $data['TextDecoded'];
		$sender = $data['SMSCNumber']; 
		$receiver = $data['DestinationNumber'];
		$status = $data['Status'];
		$channel = 'USB';
		date_default_timezone_set(TimeZone);
		$epoch    = strtotime($data['SendingDateTime']);
		$epochMicro    = number_format($epoch*1000000, 0, '.', '');
		
		/* Get outbox batch identified */
		$queryBatch = "Select batch_id from outbox where third_party_id = '" .  $data['ID'] . "'";
		echo $queryBatch . "\n";
	       $batchId = mysql_result(mysql_query($queryBatch), 0);
		
		// insert message into binsent
	
		if ($status == 'SendingOKN') $status = 1;
		else $status = 0;
		
		insertBinsent($msg, $sender, $receiver, $batchId, $status, 'USB');
		insertCDR($data['ID'], $msg, $channel);
		deleteOutbox3PId($data['ID']);
	}
	mysql_close();


	/* Connect to Gammu database once more */
	$res = mysql_connect($_DB['host'], $_DB['user'], $_DB['pass']);
	mysql_select_db($_DB['db'],$res);

	/* Remove sent items from gammu "sentitems" table that were just written to FF "binsent" table */
	if (isset($gammu_sentitems_id)) {
		foreach ($gammu_sentitems_id as $key => $id) {
			echo 'The id being deleted from sent items is ' . $id . "\n";
			mysql_query("delete from sentitems where ID = '$id'");
		}
	}


mysql_close();


function insertBinsent($message, $sender, $receiver, $batchId, $status, $channel) {
	$queryBinsent = "insert into binsent (body, sender, receiver, channel, status, created, batch_id, smsfolder_id)
	   	values ('$message', '$sender', '$receiver', '$channel', '$status', NOW(), '$batchId', '2')";
	return(mysql_query($queryBinsent));
}

function deleteOutbox3PId($id) {
	$query2 = "delete from outbox where third_party_id = '" . $id . "'";
	return(mysql_query($query2));
}

function deleteOutboxId($id) {
	$query2 = "delete from outbox where id = '" . $id . "'";
	return(mysql_query($query2));
}

function insertCDR($batchId, $body, $channel) {
	$timeStamp = strtotime(date('Y-m-d H:i:s'));
	$smsID = 'sms' . '-' . $batchId;
	$smsDescriptor = 'MESSAGE OUT';
	$application = 'SMS OUT';
	
	$query = "insert into cdr (channel_state, epoch, call_id, application, proto, title) values ('$smsDescriptor', '$timeStamp',  '$smsID', '$application', '$channel', '$body')";
	
	return(mysql_query($query));
}

?>
