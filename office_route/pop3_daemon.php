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

$handle = fopen(LogFile,'a');
//$_OfficerouteParam = $_OfficerouteParamSingle;   //Single Channel
$_OfficerouteParam = $_OfficerouteParamMulti;   //Multiple Channels 

$sock = new ESLconnection($host, $port, $pass);

   if($sock->connected()){

     logPOP('200 Connection success','INFO','ESL',3);

      foreach ($_OfficerouteParam as $instance){

	$_HostPOP = $instance['host'];
	$_UserPOP = $instance['user'];
	$_PassPOP = $instance['pass'];
	$_PortPOP = $instance['port'];


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
                     logPOP('200 '.$user.' Connection success','INFO','POP3',3);
			if(($error=$pop3->Statistics($msg_no,$size))==""){ 
                          logPOP('200 '.$user.' Messages available ('.$msg_no.')','INFO','POP3',3);
				for($i=0;$i<$msg_no;$i++){
					if(($error=$pop3->RetrieveMessage($i+1,$headers,$body,-1))==""){
						$messages[$i] = parseData($headers,$body,$i);                                             
			   		} else {
						logPOP($user.' '.$error,'ERROR','POP3',1);
					}
                     		  }
		 	}  else {	
				logPOP($user.' '.$error,'ERROR','POP3',1);
			} 

		} else { 
	
		   logPOP($error.'('.$_HostPOP.':'.$_UserPOP.':'.$_PassPOP.':'.$_PortPOP.')','ERROR','POP3',1);
		   
	
		} 
 
	} else {	
		logPOP($user.' '.$error,'ERROR','POP3',1);
	} 


     if ($messages){



	   foreach ($messages as $key => $message){

       	   	   $cmd = "jsrun /opt/freeswitch/scripts/freedomfone/sms/officeroute_main.js '".$message[$key]['body']."' '".$message[$key]['sender']."' '".$message[$key]['receiver']."' '".$message[$key]['date']."'";
       		   $result = $sock->api($cmd);

		   logPOP("200 ".$user." Command; Sender: ".$message[$key]['sender'].", Date: ".date('M j H:i:s',($message[$key]['date']/1000000)).", Body: ".$message[$key]['body'],'INFO','ESL',3);

		   if (preg_match('/OK/i', $result->getBody())){

		      logPOP('200 '.$user.' Command success','INFO','ESL',3);


		      if (! $result = $pop3->DeleteMessage($key+1)){
                         logPOP('200 '.$user.' Delete success','INFO','POP3',3);		      	 
		      } else {
	 	         logPOP('500 '.$user.' Delete failed: '.$result,'ERROR','POP3',1);

		      }


		   } else {

		    logPOP('500 Command failed' ,'ERROR','ESL',1);

		   }
           } //foreach message


       }  //no messages
	      $pop3->Close();
	      logPOP('200 '.$user.' Connection closed','INFO', 'POP3',3); 
  
     } //foreach channel
              $sock->disconnect();
              logPOP('200 Connection closed','INFO', 'ESL',3); 

     } else {

	$sock->disconnect();
	logPOP('Connection failed','ERROR', 'ESL',1); 

     }


/*
 * Parse POP3 data and return a multi-dimensional array with sender, receiver,date and body
 *  
 *  @params array $headers, array $body, int $i
 *  @return array[$i](string  $sender, string $date, string $receiver, string $body)
 * 
 */

     function parseData($headers,$body,$i){


     	for($line=0;$line<count($headers);$line++){

		$string = $headers[$line];

		if (ereg("From:",$string)){
						                        	   
                        $start = strrpos( $string,': ');
                        $end   = strpos( $string,'@');
	   		$sender = trim(substr($string,$start+2,$end-$start-2));
	   		$messages[$i]['sender'] = $sender;

		}  elseif (ereg("Date",$string)){

	   	   	$var = trim(strstr($string, ':'),': '); 
	   		$date = strtotime($var)*1000000;
			$messages[$i]['date'] = number_format($date, 0, '.', ''); 




		}

						
	} 
	$message = false;
	
	for($line=0; $line<count($body); $line++){

		     $message = $message.$body[$line];

	} 



	//FIXME! $array[3] = "To: Admin@2n.cz"
	$messages[$i]['receiver'] = "1000";
	$messages[$i]['body'] = $message;
	
	return $messages;

     }

/*
 * Log events to LogFile
 *
 * $params string $msg, string $type, $protocol, $level
 * 
 * $msg      = Text message to be logged (including HTTP status code)
 * $type     = INFO, WARNING or ERROR
 * $protocol = POP3 or ESL
 * $level    = 1, 2 or 3 (log level)
 * 
 */
   function logPOP($msg,$type, $protocol, $level){

   global $handle;
   
   	  if($level <= LogLevel){
   	    $string = date('M d H:i:s')." pop3_daemon ".$type." ".$protocol." ".$msg."\n";
	    fwrite($handle, $string);
	  }

   }

?>
