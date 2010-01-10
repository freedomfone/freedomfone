<?php
/****************************************************************************
 * dispatcherESL.php	- Incoming dispatcher based on FreeSWITCH ESL. Manages events from FreeSWITCH to spooler (db).
 * version 		- 1.0.1
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
 * events xml <type1> <type2>
 * 
 * How to run dispatcher:
 * 
 * php dispatcher.php -v --debug={true|false} --log={logfile}
 * 
 * Verbose mode (-v) will print to stdout
 * Debug mode will write to logfile. If all arguments are left out, verbose = false, debug = true
 *
 * Example: php dispatcherESL.php -v --log=/tmp/dispatcher.log
 * Result: Verbose output to stdout, debug messages logged to file /tmp/dispatcher.log
 *
 ***************************************************************************/

include_once('config.php');
require_once(ESLPath);
global $_SocketParam;
global $_DispatcherDB;
global $_AllowCURL;

global $obj;


$host = $_SocketParam['host'];
$port = $_SocketParam['port'];
$pass = $_SocketParam['pass'];



      //Write pid to file
      $handle = fopen(PidFile,'w');
      $int = fwrite($handle,getmypid());
      fclose($handle);

      //Write version to file
      $handle = fopen(VersionFile,'w');
      $int = fwrite($handle,Version);
      fclose($handle);


      //Set default values
      $param = parseArgs($argv);
      $verbose=false;
      $debug=true;
      $logfile = LogFile;

      //Read passed arguments

       if (key_exists('V',$param)){  
	  echo Version;
	  exit;
	} 


       if (key_exists('v',$param)){  
	  $verbose=true;
	} 

       if (key_exists('debug',$param) && ($param['debug']==false)){
       	  $debug=false;
	}

       if (key_exists('log',$param) && $param['log']){  
       	  $logfile = $param['log'];
	  }
    
    $handle = fopen($logfile,'a');


     //Eternal loop, until the server crashes!
     while(1){

	sleep(5);
       	set_time_limit(0); // Remove the PHP time limit of 30 seconds for completion due to loop watching events

	//1. Connect to FreeSWITCH
       	$sock = new ESLconnection($host, $port, $pass);

	if ($sock->connected()){
	    logESL("Successfully connected to FreeSWITCH","INFO",1); 

	    //2. Connect to spooler database
	    if (!$link = db_connect($_DispatcherDB)) {
                logESL("Unable to connect to Spooler","ERROR",1);
                die(printf("Unable to connect to spooler database","ERROR"));
             } else { 
		logESL("Successfully connected to spooler database","INFO",1); 
		
	         //3. Subscribe to events	   
       	   	   $sock->sendRecv("event xml message CHANNEL_STATE");
       	   	   $sock->sendRecv("event xml custom message tickle leave_a_message monitor_ivr");
		   logESL("Successfully subscribed to events","INFO",1); 

		   //4. Wait for events
       	  	    while($sock->connected()){
			$event = $sock->recvEvent();
			logESL("New event: ".$event->getType(),"INFO",1); 
			debugESL($event->getBody(),"ESL raw event data");
		
		       //4.5 APPLY BLACKLIST WITH XSL

			//5. Apply XSL template
			$xml = applyXSL($event);
			debugESL($xml,"XML data after XSL filter");
			

				//6. Apply rules to determine with application(s) to associate data with
  				if ($application = applyRules($xml)){
				   

   				    if (!mysql_ping ($link)) {
                                        mysql_close($link);
                                        $link = db_connect($_DispatcherDB);
                                        logESL("SQL connection down. Trying to re-establish", "INFO",1);
				    }

				   	//7. Create and execute MySQL query
    	     	    			if (XML2SQL($application,$xml)){
				   	   
  					       //8. Request refresh method with CURL (only for time citical tasks)
					       if (requestURL($application)){
				   	       	  logESL("CURL request executed","INFO",1);
						  } 
					 } else {
				   	   logESL("SQL query FAILED","ERROR",1); 
					 }
			         }else {
 	   			   logESL("Application match not found","ERROR",1); 
				 }					      
		      }
		} 
	} else {
	logESL("Failed to connect to FreeSWITCH","ERROR",1); 
	}
     } //while



/**
 * Applies XSL template to filter out required data. The template is chosen according to the Event-Subclass of the xml string.
 *
 * @param  string $string xml formated string
 * @return string xml formatted string, on error resturn falso
 */
function applyXSL($event){

	 $body = $event->getBody();
	 $event_name = $event->getType();

         $xsl= DirXSL.DefaultXSL;
	 $xml = simplexml_load_string($body);
	 $event_subclass  = $xml->headers->{'Event-Subclass'};
	 $event_name_alt  = $xml->headers->{'Event-Name'};



	 //PATCH FOR BROKEN RESPONSE OF getType() in ESL for CHANNEL_STATE
	 if($event_name!=$event_name_alt){ $event_name= $event_name_alt;}

	 logESL("Event name: ".$event_name,"INFO",2); 
	 

                 if($event_name == 'MESSAGE'){
	             $xsl= DirXSL.'message.xsl';

                 } elseif($event_name == 'CHANNEL_STATE'){
	             $xsl= DirXSL.'channel_state.xsl';

                 } elseif($event_name == 'CUSTOM'){

		 logESL("Event subclass: ".$event_subclass,"INFO",2); 

               	     switch ($event_subclass){

	                    case 'leave_a_message':
	                    $xsl= DirXSL.'lmsm.xsl';
	                    break;

	                    case 'tickle':
	                    $xsl= DirXSL.'tickle.xsl';
	                    break;

	                    case 'message':
	                    $xsl= DirXSL.DefaultXSL;
	                    break;

	                    case 'monitor_ivr':
	                    $xsl= DirXSL.'monitor_ivr.xsl';
	                    break;
                     }
                 }
	 logESL("XSL: ".$xsl,"INFO",2); 

   	 $xslDoc = new DOMDocument();
   	 $xslDoc->load($xsl);

   	 $xmlDoc = new DOMDocument();
   	 $xmlDoc->loadXML($body);

   	 $proc = new XSLTProcessor();
   	 $proc->importStylesheet($xslDoc);
   

	 return $proc->transformToXML($xmlDoc);


}


/**
 * Applies application specific ACL rules. This function will be replaced with regex in XML or SQL format.
 *
 * @param $string xml formatted string
 *
 * @return array containing application names
 */
function applyRules($string){

	 $application=array();
	 $xml   = simplexml_load_string($string);

	 $event_name     = $xml->{'Event-Name'};
	 $event_subclass = $xml->headers->{'Event-Subclass'};
	 $body 		 = trim($xml->headers->{'Body'});
	 
                if($event_name == 'MESSAGE'){
		$app = analyzeBody($body);

                      switch($app){
                      case 'poll':
                      $application[]='poll_in';
		      logESL("Application match: poll (SMS/Skype)","INFO",2); 
	 	      break;

                      case 'callback':
                      $application[]='callback_in';
		      logESL("Application match: callback (call/Skype)","INFO",2); 
	 	      break;             

                      case 'bin':
                      $application[]='bin';
		      logESL("Application match: bin (SMS/Skype)","INFO",2); 
	 	      break;

                       }

                }
                elseif ($event_name=='CUSTOM') {

	               switch($event_subclass){

	                 case 'leave_a_message':
	                 $application[]='lm_in';
			 logESL("Application match: leave-a-message","INFO",2); 
	 	         break;

	                 case 'tickle':
	                 $application[]='callback_in';
			 logESL("Application match: callback (tickle)","INFO",2); 
                         break;
	
                         case 'message':
			 $application[] = analyzeBody($body);
	                 //$application[]='poll_in';
			 logESL("Application match: poll (custom)","INFO",2); 
	                 break;

	                 case 'monitor_ivr':
	                 $application[]='monitor_ivr';
			 logESL("Application match: monitor_ivr (custom)","INFO",2); 
	 	         break;

	               }

                }
		elseif ($event_name == 'CHANNEL_STATE'){

		         $channel_state = $xml->headers->{'Channel-State'};
			 if($channel_state == 'CS_ROUTING' || $channel_state == 'CS_DESTROY'){
		         	$application[]='cdr';
			 	logESL("Application match: channel_state","INFO",2);
			 }
	 	 }
 		return $application;
}



/**
 * Creates and executes an SQL query based on an XML object
 *
 * @param array $table containing SQL table names
 * @param string $string an XML formatted string
 * 
 * @return bool on error return false
 */

function XML2SQL($table,$string){

	     $xml   = simplexml_load_string($string); 
	     $headers  = $xml->headers;

	     foreach ($headers->children() as $child){
	     	     $fields[] = $child->getName();
		     $values[] = $child[0];
	     }

	     return insertValues($table,$fields,$values);

}



/**
 * Creates and execute an insert SQL query 
 *
 * @param string $table table name
 * @param array $fields table field names
 * @param array $values table values 
 *
 * @return bool
 */
function insertValues($table,$fields,$values){

 if (is_array($fields)){ $fields = implode(",",addQuotes($fields,"`"));}
 if (is_array($values)){ $values = implode(",",addQuotes($values,"'"));}

    for($i=0; $i < sizeof($table); $i++){


	$query = "insert into $table[$i] ($fields) values ($values)";
        debugESL($query, "SQL query");
 
	if( $link = mysql_query($query)){ 
    	    logESL("SQL OK: ".$query,"INFO",3); 

	    }
	else {
    	    logESL("SQL failure: ".$query,"ERROR",3); 
    	    logESL("SQL error: ".mysql_error(),"ERROR",3); 
	}

     }
    return $link;
}

/**
 * Makes a CURL request to a Cake refresh method for applications requiring an urgent response (for example: callback)
 *
 * @param string $url
 *
 */
function requestURL($apps){
global $_AllowCURL;
global $obj;

      foreach ($apps as $app){
 	 if(array_key_exists($app,$_AllowCURL)){	
	    $method = $_AllowCURL[$app];
 
		$url = LocalDomain.$method.'/refresh';

         	  $ch = curl_init($url);
         	  curl_setopt($ch, CURLOPT_FRESH_CONNECT,true);  //do not use cached data
	          curl_setopt($ch, CURLOPT_RETURNTRANSFER,true); //return data as string
	  	  curl_setopt($ch, CURLOPT_CONNECTTIMEOUT_MS,1000); //timout: 1s
		  $data = curl_exec($ch);
		  if ($data){
		     logESL("CURL request: ".$url,"INFO",2);
		     }
         	  curl_close($ch);

		  return true;
	 }

	 else {
	      return false;
	      }
      }
}

/**
 * Connects to FreedomFone application database
 *
 * @param string $host $database $user $password
 * @return bool on error false
 */

function db_connect($initial_vars){

     $host	= $initial_vars['host'];
     $database	= $initial_vars['database'];
     $user 	= $initial_vars['user'];
     $password	= $initial_vars['password'];

     	      $link = mysql_connect(trim($host), trim($user), trim($password))
   	      	    or die("Could not connect : " . mysql_error());

		    mysql_select_db(trim($database)) or die("Could not select database");
		    mysql_query("SET NAMES 'utf8'");
 		    return $link;
     }



/**
 * Adds single quotes around each element in an array
 *
 * @param array $data data to apply operation on
 *
 * @return array $data 
 */
function addQuotes($data,$quote){

	 foreach($data as $key => $value){
	 	$data[$key]=$quote.$value.$quote;

	 }

	 return $data;


}


function analyzeBody($body){

global $obj;

        $data =  explode(' ',$body);
	foreach ($data as $token){
	echo $token;
		if ($token){
		$message[] =$token;
		}
		
	}

        if (strpos($body,'CALLBACK')!== false){

                $app ='callback';
        }

        elseif(sizeof($message)==2){
                $app = 'poll';
        }

        else{
                $app = 'bin';
        }

        return $app;
}




function parseArgs($argv){
    array_shift($argv);
    $out = array();
    foreach ($argv as $arg){
        if (substr($arg,0,2) == '--'){
            $eqPos = strpos($arg,'=');
            if ($eqPos === false){
                $key = substr($arg,2);
                $out[$key] = isset($out[$key]) ? $out[$key] : true;
            } else {
                $key = substr($arg,2,$eqPos-2);
                $out[$key] = substr($arg,$eqPos+1);
            }
        } else if (substr($arg,0,1) == '-'){
            if (substr($arg,2,1) == '='){
                $key = substr($arg,1,1);
                $out[$key] = substr($arg,3);
            } else {
                $chars = str_split(substr($arg,1));
                foreach ($chars as $char){
                    $key = $char;
                    $out[$key] = isset($out[$key]) ? $out[$key] : true;
                }
            }
        } else {
            $out[] = $arg;
        }
    }
    return $out;
}

   function logESL($msg,$type,$level){

   global $handle;

   	  if($level <= LogLevel){
   	    $string = date('c')." ".$type." ". $msg."\n";
	    fwrite($handle, $string);
	    }

   }


   function debugESL($data,$title=null){

   global $debug;

   	  if($debug){
		echo "******* ".$title." ***********\n";
		if(is_array($data)){ print_r($data."\n");}
		else { echo $data."\n";}
	    }

   }



?>
