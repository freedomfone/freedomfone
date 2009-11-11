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
 * Result: no verbose output to stdout, debug messages logged to file /tmp/dispatcher.log
 *
 */
include_once('config.php');
global $_SocketParam;
global $_DispatcherDB;
global $_AllowCURL;
global $obj;

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

define('FS_SOCK_DEBUG', $verbose);
include_once('esl/fs_sock.php');

       //Eternal loop, until the server crashes!
       while(1){

       sleep(5);

	       $obj = new fs_sock($_SocketParam,$logfile);



	       if(!$obj->connected){
     		   $obj->debug("Unable to open socket to FreeSWITCH","ERROR");
     		   $obj->log("Unable to open socket to FreeSWITCH","ERROR");
		   
	     }

	     else {
	     	   $alive=time();
	     	   $obj->debug("Connected to FreeSWITCH",'INFO');
     		   $obj->log("Connected to FreeSWITCH","INFO");
  
		   

     		//auth {password}
     		if ($obj -> auth != true){
     		   $obj->log("Unable to authenticate","ERROR");
     		   $obj->debug("Unable to authenticate",'ERROR');
		   }

		else {   

		     $obj->log("Successful authentication","INFO");
     		     $obj->debug("Successful authentication",'INFO');
		   

		     if (!$obj -> subscribe_events('heartbeat message')) {
      		     	$obj->debug("Unable to subscribe to heartbeat/message",'ERROR');
		   	}

	             else {
		     	  $obj->log("Successfully subscribed to heartbeat","INFO");
  		     	  $obj -> debug('Successfully subscribed to heartbeat','INFO');

		   	  //events plain custom {event1} {event 2}
     			  if (!$obj -> subscribe_events('custom tickle message leave_a_message')) {
      		   	     $obj->log("Unable to subscribe to FF events","ERROR");  
    		   	     $obj->debug("Unable to subscribe to FF events",'ERROR');
		   	     }

			  else {
  		     	  $obj -> log("Successfully subscribed to FF events","INFO");
  		     	  $obj -> debug('Successfully subscribed to FF events'.'INFO');
			  
				if (!db_connect($_DispatcherDB)) {
           			   $obj->log("Unable to connect to Spooler","ERROR");
           			   die(printf("Unable to connect to Spooler","ERROR"));
        			   }

				else { 
				     $obj -> log("Database connection successfully established","INFO"); 
				     $obj -> debug('Database connection successfully established'); 
	     			  
							$output = array();
							$i=0; 
							$i++;

    							//1. Fetch event
    							while($output = $obj -> wait_for_event($alive)){
						        
								$event_name = $output['Body']['Event-Name'];

								if ($event_name =='HEARTBEAT'){
								   	$alive=time(); 
									$obj->debug("HEARTBEAT","INFO");
								}
								else {
									$obj->log("Event type: ".$event_name,"INFO");
								}

	
								//print_r($output);									
									
								//2. Create XML object including all event data
								
	     							if($xml = createXML($output)){
		

									//3. Apply xsl template on XML object depending on Event-Subclass
    	     	   							if($xml = applyXSL($xml)){
										$obj->debug("XSL filter applied","INFO");

										//4. Apply rules to determine with application(s) to associate data with
    	     	   	 							if ($application = applyRules($xml)){
										      
			    	       
											//5. Create and execute MySQL query
    	     	    									if (XML2SQL($application,$xml)){
  					
											   //6. Request refresh method with CURL (only for time citical tasks)
											   if (requestURL($application)){
											    $obj->debug("CURL request ","INFO");
											    $obj->log("CURL REQUEST ","INFO");
											    }

											} //xml2sql

											else {
											$obj->log("SQL QUERY FAILED","ERROR");

											}
										} //applyRules
									} //applyXSL
								} //createXML

								//unset($output);
							} //while

						 	
					} //else database
			  } //else ff events
		     } //else heartbeat
		} //else auth
        }// else fs_sock
	

$obj -> sock_close();

}



/**
 * Creates an XML object composed by the selected fields of the event
 *
 * @param  object $event Freeswitch event object
 * @return object xml object
 */
function createXML($event){

global $obj;

	 //Extract data from event

	 $event_body =$event['Body'];
     	 $xmltext = "<?xml version=\"1.0\" encoding=\"utf-8\" ?><".ParentXML."></".ParentXML.">";
	 $xmlobj = simplexml_load_string($xmltext);

	 if (is_array($event_body)){

	    $fields = $xmlobj->addChild('fields');	 

	    	    foreach($event_body as $key=> $value){

	 	    	$child = $fields->addChild($key, $value);	 		 
	 		}


	 //convert to DOM
	 $dom = dom_import_simplexml($xmlobj)->ownerDocument;
	 $dom->formatOutput = true;
	 
	 $xml_string = $dom->saveXML();

	 //echo "XML before XSL".$xml_string;
	 return $xml_string;

	 }

	 else { 
	      return 0; 
	      }
}

/**
 * Applies XSL template to filter out required data. The template is chosen according to the Event-Subclass of the xml string.
 *
 * @param  string $string xml formated string
 * @return string xml formatted string, on error resturn falso
 */
function applyXSL($string){

global $obj;


         $xsl= DirXSL.DefaultXSL;
	 $xml   = simplexml_load_string($string);

	 //XML node name with hyphen needs to be within {''}
	 $event_name  = $xml->fields->{'Event-Name'};
	 $event_subclass  = $xml->fields->{'Event-Subclass'};



	 if($xml && $event_name!='HEARTBEAT'){

                 if($event_name == 'MESSAGE'){

	             $xsl= DirXSL.'message.xsl';

                 }

                 elseif($event_name == 'CUSTOM'){

               	     switch ($event_subclass){

	                    case 'leave_a_message':
	                    $xsl= DirXSL.'lmsm.xsl';
	                    break;

	                    case 'tickle':
	                    $xsl= DirXSL.'tickle.xsl';
	                    break;

                     }

                 }

	 $obj->debug("XSL applied: ".$xsl,"INFO");

   	 $xslDoc = new DOMDocument();
   	 $xslDoc->load($xsl);

   	 $xmlDoc = new DOMDocument();
   	 $xmlDoc->loadXML($string);

   	 $proc = new XSLTProcessor();
   	 $proc->importStylesheet($xslDoc);
   

	 return $proc->transformToXML($xmlDoc);

       }

       else {
       	    return 0;
	    }


}


/**
 * Applies application specific ACL rules. This function will be replaced with regex in XML or SQL format.
 *
 * @param $string xml formatted string
 *
 * @return array containing application names
 */
function applyRules($string){

global $obj;

	 $application=array();
	 $xml   = simplexml_load_string($string);


	 $event_name     = $xml->{'Event-Name'};
	 $event_subclass = $xml->fields->{'Event-Subclass'};
	 $body 		 = trim($xml->fields->{'Body'});


	 if ($xml && $event_name){
	 
       $obj->debug("Event name: ".$event_name,"INFO");

                //apply rules here
                if($event_name == 'MESSAGE'){
               
		
		$app = analyzeBody($body);
                      switch($app){

                      case 'poll':
                      $application[]='poll_in';
                      break;


                      case 'callback':
                      $application[]='callback_in';
                      break;
                 
                       }

                }
                elseif ($event_name=='CUSTOM') {

       		       $obj->debug("Event subclass: ".$event_subclass,"INFO");
	               switch($event_subclass){

	                 case 'leave_a_message':
	                 $application[]='lm_in';
	                 break;


	                 case 'tickle':
	                 $application[]='callback_in';
	                 break;


	                 case 'message':
	                 $application[]='poll_in';
	                 break;
	               }

                }




	 
	 }

	 if(sizeof($application)){

		foreach($application as $app){
       			     $obj->log("Application match: ".$app,"INFO");
       	  		     $obj->debug("Application match: ".$app,"INFO");
	         }
	}
	else {
 		 $obj->log("Application match: none","ERROR");
 		 $obj->debug("Application match: none","ERROR");

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

global $obj;
	     $xml   = simplexml_load_string($string);
	     
	     $body  = $xml->fields;



	     foreach ($body->children() as $child){

	     	     $field_name[] = $child->getName();
	     	     $field_value[] = $child;

	     }


	     return insertValues($table,$field_name,$field_value);

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

global $obj;

	 if (is_array($fields)){ $fields = implode(",",addQuotes($fields,"`"));}
	 if (is_array($values)){ $values = implode(",",addQuotes($values,"'"));}

	for($i=0; $i < sizeof($table); $i++){


	$query = "insert into $table[$i] ($fields) values ($values)";

	if( $link = mysql_query($query)){ 
 	    $obj->debug("SQL query: OK","INFO");
            $obj->log("SQL query: OK", "INFO");
	    }
	else {
	     $obj->debug("SQL query failed: ".$table[$i]." : ".$query,"ERROR");
	     $obj->log("SQL query failed: ".$table[$i]." :  ".$query,"ERROR");
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
		     $obj->log("CURL request: ".$url,"INFO");
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

?>
