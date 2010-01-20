<?php
/**
 * Dialer Engine
 *
 * The dialer engine is invoked by the FileSystem Watcher with the parameter (string $file).
 * The $file parameter is the absolute path to the spooler job to be executed. 
 * The dialer engine does the following:
 *  - connects to FreeSWITCH
 *  - fetch the data from the spooler job
 *  - moves the spooler job from 'incoming' to 'saved'.
 *  - checks if the FreeSWITCH channel is idle
 *    - if idle: sends the bgapi command for outgoing call
 *    - if busy: waits a random number of seconds, and tries again
 * - closes the FreeSWITCH socket 
 * 
 * The number of redials can be configured in config/config (Redials)
 * 
 * 
 * $params string $file
 */
include_once('config.php');
include_once('../esl/php/fs_sock.php');


define('FS_SOCK_DEBUG', true);

global $_SocketParam;

global $obj;

$file = $argv[1];



	       $obj = new fs_sock($_SocketParam);


$obj->log("*** NEW REQUEST ***","OK");

	    if(!$obj->connected){
     		   $obj->debug("Unable to open socket to FreeSWITCH\r\n");
     		   $obj->log("Unable to open socket to FreeSWITCH","ERROR");
		   
	     }

	     else {
	     	   $obj->debug("FreeSWITCH socket open \r\n");
     		   $obj->log("FreeSWITCH socket open","OK");
  
		   

     		//auth {password}
     		if ($obj -> auth != true){
     		   $obj->log("Unable to authenticate","ERROR");
     		   $obj->debug("Unable to authenticate\r\n");
		   }

		else {   

		     $obj->log("Successful authentication","OK");
     		     $obj->debug("Successful authentication\r\n");
		   


		   if($file && is_file($file)){

      		       $obj->log("Spooler job found","OK");

			//Open file and read content
		   	$content = file($file);
		   	$data = trim($content[0]);

			$cmd = command($data);
      		        $obj->log("Command to execute: ".$cmd,"OK");
		   
		   	//Move file to completed
			$filename = basename($file);

			echo "*** REMAME***";
			echo $file. " TO ".BasePath.SpoolerSavedDir.$filename;
			
		   	rename($file,BasePath.SpoolerSavedDir.$filename);

		   	$status  = true;
		   	$redial  = 0;
			sleep(DefaultSleep);

		  		 while($status  && $redial < Redial){
 
					$redial++;

					//Send api command
		     			$return = $obj -> api_command("show channels");		     
					$data = $return['Body'];

					$obj->debug($return);
		     			$status = strpos($data, 'GSMopen');

					$obj->debug("status: ".$status);
		     			if ($status === false){

		     			//Dial out
    		     			$obj->log("Outgoing call ok","OK");
    		     			$obj->debug("Outgoing call ok");
		     			$return = $obj -> bgapi_command($cmd);		     
		     			
		     			}

		     			else {


					//Wait random time and try again
    		     			$obj->log("Outgoing call: busy line","RETRY");
    		     			$obj->debug("Outgoing call: busy line");
		    			$wait= rand(1,RedialSleep);
    		     			$obj->log("Wait ".$wait." s","RETRY");
    		     			$obj->debug("Wait ".$wait." s");
		     			sleep($wait);
		     			}			
		  		}	//while

		    }  //if
 	    }  //else

	}//else

 $obj->log("Closing socket","OK");
 $obj -> sock_close();


function command($buffer){

global $_DialerParam;

	 $data = explode(',',trim($buffer));

	 $id = $data[0];
	 $mode = $data[1];
	 $sender = $data[2];
	 $ext  = $data[3];

	 if ($mode == 'SIP' || $mode == 'GSM'){

	    	   $cmd = $_DialerParam[$mode][0].$sender." ".$ext." ".$_DialerParam[$mode][1];

		   }

          else { 
	       	 $cmd = false; 
		 }

	 return $cmd;
}

?>
