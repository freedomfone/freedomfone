<?php
/**
 * Sweeps sensitive user data from the Freedom Fone database (GUI). 
 * This sweeper has the same effect as running the System Sweeper from the Freedom Fone user interface. 
 *
 * If the Sweeper is enabled, this script updates the CakePHP database 
 * according to the settings in the Sweeper config file (/opt/freedomfone/config/gui_config_sweeper.php).
 *
 */


include_once('config.php');
include_once(SVNROOT.'config/gui_config_database.php');
include_once(SVNROOT.'config/gui_config_sweeper.php');


$sweep_config  = $config['SWEEP_CONFIG'];
$sweep_queries = $config['SWEEP_SETTINGS'];
$db_config     = get_class_vars('DATABASE_CONFIG');


$_Mode   = $sweep_config['mode'];  
$_Enable = $sweep_config['enable'];

$_FreedomfoneDB = array(
       'host'     => $db_config['default']['host'],
       'database' => $db_config['default']['database'],
       'user'     => $db_config['default']['login'],
       'password' => $db_config['default']['password'],
       );

$handle = fopen($_LogFile,'a');
global $handle;
$link = db_connect($_FreedomfoneDB);


 if($_Enable){


	foreach($sweep_queries as $key => $entry){

	       $model = $_Models[$key];
    	       $data = $entry[$_Mode];
   	       $result = mysql_query(getQuery($data, $model, $_Mode));

      	       if (!$result) {
               	  sweeper_log('Invalid query: ' . mysql_error());
      	       } else {
                  sweeper_log('GUI sweeper executed on model: '.$key);
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


/**
 * Create MySQL query
 *
 * @param array $data
 * 
 */

 function getQuery($data, $model, $mode){

 	  $string = false;

 	  foreach($data as $key => $value){

	     $string .= $key.' = "'.$value.'",';
	  
	  }

 	  $query = "update ".$model." set ".rtrim($string,',');
	  return $query;
 }

?>
