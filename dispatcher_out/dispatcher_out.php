#!/usr/bin/php -q
<?php
/*
 * Based on echo_bouncer.php by Raymond Fain (ray@obi-graphics.com)
 * 
 * The Outgoing Dispacher (dispatcher_out.php) creates a master socket for CakePHP to connect to.
 * For each outgoing callback, Cake connects to the socket, and sends a requests for outgoing calls (callback)
 * For each request received by the dispatcher, a file is created containing id, protocol, sender and extension. 
 *
 *
 */
include_once('config.php');
 
 
error_reporting(E_ALL);
set_time_limit(0);
ob_implicit_flush();
global $handle;
 
$host = $_SpoolerOut['host'];
$port = $_SpoolerOut['port'];

$handle = fopen(LogFile,'a');

 
 if (($master = socket_create(AF_INET, SOCK_STREAM, SOL_TCP)) < 0) {

    	      echo "socket_create() failed, reason: " . socket_strerror($master) . "\n";
 }
 
 socket_set_option($master, SOL_SOCKET,SO_REUSEADDR, 1);
 
 
 if (($ret = socket_bind($master, $host, $port)) < 0) {

    	   debug("socket_bind() failed, reason: " . socket_strerror($ret),"ERROR");

 }
 
 
 if (($ret = socket_listen($master, 5)) < 0) {

    echo "socket_listen() failed, reason: " . socket_strerror($ret) . "\n";

  }
 
 
 $read_sockets = array($master);

debug("socket setup ok","OK"); 
ff_log("socket setup","OK");

//---- Create Persistent Loop to continuously handle incoming socket messages ---------------------

       while (true) {

       	     $changed_sockets = $read_sockets;
 	     $num_changed_sockets = socket_select($changed_sockets, $write = NULL, $except = NULL, NULL);
 

		foreach($changed_sockets as $socket) {
 
			if ($socket == $master) {
 
				if (($client = socket_accept($master)) < 0) {

				   echo "socket_accept() failed: reason: " . socket_strerror($msgsock) . "\n";
				   continue;
				   } 
				   else {
				   array_push($read_sockets, $client);
				   }

			} 
			else {
 
				$bytes = socket_recv($socket, $buffer, 2048, 0);

				       if ($bytes == 0) {

				       	  $index = array_search($socket, $read_sockets);
					  unset($read_sockets[$index]);
					  socket_close($socket);

					  }
					  else {

					  spooler_job($buffer);

					  }

			}
 

		}

}

/*
 * Create a spooler job 
 * Writes the string $cmd to a file named {id}.call, where id is the unique identifier of the callback request
 * The $cmd is first written to a temporary file,  and then moved to the position where is can be access by the outoging spooler. 
 * 
 * @parmas string $cmd
 * 
 */ 
	function spooler_job($cmd){

	 $data = explode(',',trim($cmd));
	 $id = $data[0];


     	 $tmp_file = SpoolerTmpDir.$id.".call";
         $new_file = BasePath.SpoolerOutDir.$id.".call";

	 $handle=fopen($tmp_file,'w');
	 fwrite($handle,$cmd);
	 fclose($handle);
	 rename($tmp_file, $new_file);
	 debug("New spooler job: ".$cmd);
	 ff_log("New spooler job: ".$cmd,"OK");
	 }


    function debug($input, $spaces=0) {

    	     printf("%s%s\r\n", str_repeat(' ', $spaces), $input);

    }


   function ff_log($msg,$type){

   global $handle;

   	    $string = date('c')." ".$type." ". $msg."\n";
	    fwrite($handle, $string);

   }

?>

