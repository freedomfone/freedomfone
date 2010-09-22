<?php
include_once('pop3.php');
include_once('config.php');
require_once(ESLPath);

$host = $_SocketParam['host'];
$port = $_SocketParam['port'];
$pass = $_SocketParam['pass'];



////////////////
$_HostPOP = '192.168.46.109';
$_UserPOP = 'Admin';
$_PassPOP = '2n';

//$_UserPOP = '100';
//$_PassPOP = '1234';

$_PortPOP = '110';


/*global $_HostPOP;
global $_PortPOP;
global $_UserPOP;
global $_PassPOP;*/

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


	if(($error=$pop3->Open())=="")  {
		if(($error=$pop3->Login($user,$password,$apop))=="") {
			if(($error=$pop3->Statistics($msg_no,$size))==""){ 
				for($i=1;$i<=$msg_no;$i++){
					if(($error=$pop3->RetrieveMessage($i,$headers,$body,-1))==""){
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
							   //$date3 = date('l jS \of F Y h:i:s A',$date2);
							}
						
				       		} // for: lines headers
			
						$message = false;
						for($line=0; $line<count($body); $line++){

							$message = $message.$body[$line];


				       		} 

						//FIXME!
						$messages[$i]['receiver'] = "1000";
						$messages[$i]['body'] = $message;
			   		  } //if: retreive message
                     		  } // for iteration
		 	}  else {	
				$error=$result;
			} //stat

		} else { 
	
		$error=$result;
	
		} //loging
 
	} else {	
		//$error=$result;
	} //login



	//FIXME: log error

	//****************************************//
	//*  Connect to Freeswitch via ESL       *//
	//*  and create custom event for SMS     *//
	//*                                      *//
	//*                                      *//
	//****************************************//

     $sock = new ESLconnection($host, $port, $pass);

     if($sock->connected()){


	foreach ($messages as $message){
       $cmd = "jsrun freedomfone/sms/createSMS.js '".$message['sender']."' '".$message['receiver']."' '".$message['date']."' '".$message['body']."'";

       echo $cmd." \n";

       $sock->bgapi($cmd);
       }


       }
/*
	if ($obj -> auth != true) {
    	   die(printf("Unable to authenticate\r\n"));
	  
	} 

	if (!$obj -> subscribe_events('custom message')) {
    	   die(printf("Unable to subscribe to events"));
	   
	}

	foreach ($messages as $message){
       $cmd = "jsrun freedomfone/sms/createSMS.js '".$message['sender']."' '".$message['receiver']."' '".$message['date']."' '".$message['body']."'";

       echo $cmd." \n";
       }
       
     
		$bg_return = $obj -> bgapi_command($cmd);
    		$obj -> debug($bg_return);
    		$output[] = $obj -> wait_for_event(time());
		$obj -> sock_close(); 

*/




function print_message($values,$i){


	 echo $values[0]." \n";
	 echo $values[1]." \n";
	 echo $values[2]." \n";
	 echo $values[3]." \n";

	
	 }




?>


