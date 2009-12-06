<?php
/**
 * Incoming Dispatcher
 *
 * telnet localhost 8021
 * auth ClueCon
 * events plain custom msg1 msg2 msg3
 * 
 * php dispatcher.php -v --debug={true|false} --log={logfile}
 * 
 * Verbose mode will print to stdout
 * Debug mode will write to logfile. If the argument is left out, debug is set to true
 *
 * Example: php dispatcher_in.php -v --debug --log=/tmp/dispatcher.log
 * Result: Verbose output to stdout, debug messages logged to file /tmp/dispatcher.log
 *
 */
include_once('config.php');
require_once(ESLPath);
global $_SocketParam;
global $_DispatcherDB;
global $_AllowCURL;
global $obj;


$host = $_SocketParam['host'];
$port = $_SocketParam['port'];
$pass = $_SocketParam['pass'];

$param = parseArgs($argv);

       if (key_exists('v',$param)){  
			$verbose=true;
			}
			else {
			$verbose= false;
			}
	


       if (key_exists('debug',$param)){  
		if($param['debug']==false){
			$debug=false;
			}
			else {
			$debug= true;
			}
	}
	else {
	     $debug= true;
	     }


       if (key_exists('log',$param) && $param['log']){  
       	  $logfile = $param['log'];
	  }

	  else {
	  $logfile = LogFile;
	  }

	  $handle = fopen($logfile,'a');


     //Eternal loop, until the server crashes!
     while(1){

	sleep(5);
       	set_time_limit(0); // Remove the PHP time limit of 30 seconds for completion due to loop watching events

	//1. Connect to spooler database
	if (!db_connect($_DispatcherDB)) {
                logESL("Unable to connect to Spooler","ERROR",1);
                die(printf("Unable to connect to spooler database","ERROR"));
           } else { 
		logESL("Successfully connected to spooler database","INFO",1); 
	 
		//2. Connect to FreeSWITCH
       		$sock = new ESLconnection($host, $port, $pass);

       		if ($sock->connected()){
		logESL("Successfully connected to FreeSWITCH","INFO",1); 

	         //3. Subscribe to events
       	   	   //$sock->sendRecv("event xml heartbeat message");
       	   	   $sock->sendRecv("event xml custom tickle message leave_a_message");
		   logESL("Successfully subscribed to events","INFO",1); 

		   //4. Wait for events
       	  	    while($sock->connected()){
			$event = $sock->recvEvent();
			logESL("New event received; Type: ".$event->getType(),"INFO",1); 
			debugESL($event->getBody(),"ESL raw event data");
		
			//5. Apply XSL template
			$xml = applyXSL($event);
			debugESL($xml,"XML data after XSL filter");
			logESL("XSL template applied","INFO",2); 

				//6. Apply rules to determine with application(s) to associate data with
  				if ($application = applyRules($xml)){
				   logESL("Application match","INFO",1); 

				   	//7. Create and execute MySQL query
    	     	    			if (XML2SQL($application,$xml)){
				   	   
  					       //8. Request refresh method with CURL (only for time citical tasks)
					       if (requestURL($application)){
				   	       	  logESL("CURL request executed","INFO",1);
						  } 
					 } else {
				   	   logESL("SQL query FAILED","ERROR",1); 
					 }
			         } else {
 	   			   logESL("Application match not found","ERROR",1); 
				 }					      
		      }
		} else {
		logESL("Failed to connect to FreeSWITCH","ERROR",1); 
		}
	} //else
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

	 logESL("Event name: ".$event_name,"INFO",2); 
	 logESL("Event subclass: ".$event_subclass,"INFO",2); 

                 if($event_name == 'MESSAGE'){
	             $xsl= DirXSL.'message.xsl';
                 }  elseif($event_name == 'CUSTOM'){
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
                     }
                 }
	 logESL("XSL template: ".$xsl,"INFO",2); 

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
	 $body 		 = trim($xml->{'Body'});
	 
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
                       }

                }
                if ($event_name=='CUSTOM') {

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
	                 $application[]='poll_in';
			 logESL("Application match: poll (custom)","INFO",2); 
	                 break;
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

	     $fields[] = 'body';
	     $values[] = $xml->body;

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
	    logESL("SQL query OK","INFO",1); 
    	    logESL("SQL query: ".$query,"INFO",3); 

	    }
	else {
	    logESL("SQL query failed","ERROR",1); 
    	    logESL("SQL query: ".$query,"ERROR",3); 
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

   	  if($level<= LogLevel){
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
