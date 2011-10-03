<?php
/**
 * Sweeps sensitive user data from the Freedom Fone database (GUI). 
 * This sweeper has the same effect as running the System Sweeper from the Freedom Fone user interface. 
 *
 */



$_Mode = 1;  //0 = low, 1 = high
$_FreedomfoneDB = array(
       'host'     => 'localhost',
       'database' => 'freedomfone',
       'user'     => 'freedomfone',
       'password' => 'thefone',
       );
$_LogFile = '/opt/freedomfone/log/gui_sweeper.log';

//Bin (other SMS)
$query['bin'][0] = "update bin set sender = NULL";
$query['bin'][1] = "update bin set sender = NULL";

//Call data records (CDR)
$query['cdr'][0] = "update cdr set caller_number = NULL";
$query['cdr'][1] = "update cdr set caller_number = NULL";

//Monitor IVR
$query['monitor_ivr'][0] = "update monitor_ivr set caller_number = NULL";
$query['monitor_ivr'][1] = "update monitor_ivr set caller_number = NULL";

//Callers phone numbers
$query['phone_numbers'][0] = "delete from phone_numbers";
$query['phone_numbers'][1] = "delete from phone_numbers";

//Callers user data
$query['users'][0] = "select * from users";
$query['users'][1] = "update users set name = 'John', surname = 'Doe', email = 'john.doe@gmail.com', skype = 'john.doe', organization = NULL";


//******************************************************************************//

$handle = fopen($_LogFile,'a');
global $handle;
$link = db_connect($_FreedomfoneDB);


   foreach($query as $key => $entry){

      $result = mysql_query($entry[$_Mode]);

      if (!$result) {
         sweeper_log('Invalid query: ' . mysql_error());
      } else {
         sweeper_log('GUI sweeper executed on model: '.$key);
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
 * Logs actions to $_LogFile
 *
 * @param string $msg
 * 
 */

   function sweeper_log($msg){

   global $handle;


   	    $string = date('M d H:i:s')." ".$msg."\n";
	    fwrite($handle, $string);


   }

?>