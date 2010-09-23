<?php
/****************************************************************************
 * pop3_daemon.php	- Connects to Officeroute device, and POPs incoming SMS. 
 * 			  A custom event (subclass: officeroute) is created and sent 
 *			  to FreeSWITCH using the ESL library (bgapi).
 *
 *			- pop3_daemon.php should run as a cronjob every x minutes.
 *
 * version 		- 1.0
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
 * Manual connection to FreeSWITCH:
 *
 * telnet localhost 8021
 * auth ClueCon
 * events plain officeroute
 * 
 * 
 ***************************************************************************/


include_once('pop3.php');
include_once('config.php');
require_once(ESLPath);

$host = $_SocketParam['host'];
$port = $_SocketParam['port'];
$pass = $_SocketParam['pass'];


$_HostPOP = $_OfficerouteParam['host'];
$_UserPOP = $_OfficerouteParam['user'];
$_PassPOP = $_OfficerouteParam['pass'];
$_PortPOP = $_OfficerouteParam['port'];



$handle = fopen(LogFile,'a');


	$pop3=new pop3_class;
	$pop3->hostname=$_HostPOP;
	$pop3->port=$_PortPOP;   	                         
	$pop3->tls=0;                            /* Establish secure connections using TLS      */
	$user=$_UserPOP;
	$password=$_PassPOP;
	$pop3->realm="";                         /* Authentication realm or domain              */
	$pop3->workstation="";                   /* Workstation for NTLM authentication         */
	$apop=0;                                 /* Use APOP authentication                     */
	$pop3->authentication_mechanism="USER";  /* SASL authentication mechanism               */
	$pop3->debug=1;                          /* Output debug information                    */
	$pop3->html_debug=1;                     /* Debug information is in HTML                */
	$pop3->join_continuation_header_lines=1; /* Concatenate headers split in multiple lines */
	
	$messages = false;

	if(($error=$pop3->Open())=="")  {
		if(($error=$pop3->Login($user,$password,$apop))=="") {
			if(($error=$pop3->Statistics($msg_no,$size))==""){ 
				for($i=0;$i<$msg_no;$i++){
					if(($error=$pop3->RetrieveMessage($i+1,$headers,$body,-1))==""){

						$messages[$i] = parseData($headers,$body,$i);

			   		} else {
					  
						logPOP($error,'FOO',1);

					}
                     		  }
		 	}  else {	
				logPOP($error,'ERROR',1);
			} 

		} else { 
	
		   logPOP($error,'ERROR',1);
	
		} 
 
	} else {	
		logPOP($error,'ERROR',1);
	} 



	//****************************************//
	//*  Connect to Freeswitch via ESL       *//
	//*  and create custom event for         *//
	//*  incoming SMS from Officeroute       *//
	//*                                      *//
	//****************************************//

     $sock = new ESLconnection($host, $port, $pass);

     if($sock->connected()){

	if ($messages){

	   foreach ($messages as $key => $message){
       	   	   $cmd = "jsrun freedomfone/sms/createSMS.js '".$message[$key]['sender']."' '".$message[$key]['receiver']."' '".$message[$key]['date']."' '".$message[$key]['body']."'";
       		   echo $cmd." \n";
       		   $sock->bgapi($cmd);
		   logPOP("BGAPI: Sender: ".$message[$key]['sender'].", Date: ".date('M j H:i:s',$message[$key]['date']).", Body: ".$message[$key]['body'],'INFO',2);
           }
       }
     } else {

	$sock->disconnect();
	logPOP("Failed to connect to FreeSWITCH","ERROR",1); 

     }


     function parseData($headers,$body,$i){


     	for($line=0;$line<count($headers);$line++){

		$string = $headers[$line];

		if (ereg("From:",$string)){
						   	   
			$var = strstr($string, '@', true); 
	   		$sender = trim(strstr($var, ':'),': '); 							   
	   		$messages[$i]['sender'] = $sender;

		}  elseif (ereg("Date",$string)){

	   	   	$var = trim(strstr($string, ':'),': '); 
	   		$date = strtotime($var);
	   		$messages[$i]['date'] = $date;
		}

						
	} 
	$message = false;
	
	for($line=0; $line<count($body); $line++){

		     $message = $message.$body[$line];

	} 

	//FIXME!
	$messages[$i]['receiver'] = "1000";
	$messages[$i]['body'] = $message;
	
	return $messages;

     }

   function logPOP($msg,$type,$level){

   global $handle;
   

   	  if($level <= LogLevel){
   	    $string = date('M d H:i:s')." pop3_daemon ".$type." ". $msg."\n";
	    fwrite($handle, $string);
	  }

   }

?>						

			
