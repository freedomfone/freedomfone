<?php
/****************************************************************************
 * spooler_ff.php	- Class for connecting to spooler database and fetch new events.
 * version 		- 3.0.1500
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
 *
 ***************************************************************************/

class ff_event {
    /**
     * sql table name 
     *
     * @var string
     */
    public $table;

    /**
     * Sets Whether connection to database was successful or not
     * 
     *
     * @var boolean
     */
    public $auth;

     /**
     * Class instantiation
     * This method will connect to the database and authenticate
     *
     * @param array $vars
     *
     * @return object $link mysql resource, on error return false
     */
    function ff_event($vars=null) {
        
        if ($link =$this -> db_connect($vars)) {
                $this -> auth = true;
	    $this -> table = $vars['user'];
        }

	else { 
	     $link=false;
	}

	return $link;
    }

    /**
     * Close the connection to the database
     *
     */
    function ff_close($link) {
 
	mysql_close($link);
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
     *
     * Set status for entry with id
     *
     * @param int $id id for entry
     * @param bool $status status to be set
     * 
     * @return bool on error return false
     * 
     */
     function setStatus($id,$status){

     $table = $this->table;

     $result = mysql_query("update $table set status= $status where id = $id");
     	     if (!$result) {

		return false;
		}

		else {

		return  true;
		}
     }


   /**
     *
     * Delete entry with id = $id
     *
     * @param int $id
     *
     * @return bool on error return false
     * 
     */ 
     function deleteEntry($id){

     $table = $this->table;
     $result = mysql_query("delete from $table where id = $id");

     	     if (!$result) {

		return false;
		}

		else {

		return  true;
		}
     }

   /**
     *
     * Delete all entries where status= $status
     *
     * @param bool $status
     *
     * @return bool on error return false
     * 
     */ 
     function deleteAll($status){

     $table = $this->table;

     $result = mysql_query("delete $table where status = $status");
     	     if (!$result) {

		return false;
		}

		else {

		return  true;
		}
     }



    /**
     *
     * Fetch next entry that has not been processed (status=0) and either (1) updates the status to processed (status=1), or (2) deletes the entry.
     *
     * @param string $action action to be executed {update|delete}
     * @return array $data
     * 
     */
    function lock(){

    mysql_query("use spooler_in");
    mysql_query("LOCK TABLES ".$this->table." WRITE");

    } 

    function unlock(){

    mysql_query("UNLOCK TABLES");

    } 

    function getNext($action){

     $table = $this->table;


     $result = mysql_query("select * from $table where status = 0 order by id asc limit 0,1;");



     	     if (!$result) {

		return false;
		}

	     else {


		if ($no = mysql_affected_rows()){

		$data = mysql_fetch_array($result);

		      switch ($action){

		      case 'update':
		      $this->setStatus($data['id'],1);
		      break;

		      case 'delete':
		      
		      $this->deleteEntry($data['id']);
		      break;


		      }
		
               // mysql_query("UNLOCK TABLES");

		return  $data;

		}

		else {

                     //mysql_query("UNLOCK TABLES");
		     return 0;
		     }
		}
     }

    /**
     *
     * Fetch all entries that has not been processed (status=0) and either (1) updates status to processed (status=1) or (2) deletes all entries
     *
     * @return object mysql array $data
     * 
     */
     function getAll($action){

     $table = $this->table;

      $object = mysql_query("select * from $table where status= 0");
      $result = mysql_query("select * from $table where status= 0");

     	       if (!$object) {

		return false;
		}

		else {

		while($data = mysql_fetch_array($result)){

			    switch ($action){

			    case 'update':
			    $this->setStatus($data['id'],1);
			    break;

			    case 'delete':
			    $this->deleteEntry($data['id']);
			    break;

			    }

		}
		
		return $object;
		}
     }





    /**
     * Function to print out debugging info
     * This method will recieve arbitrary data and print it to the screen
     * enable/disable by defining FS_SOCK_DEBUG to true/false
     * @param mixed $input what to debug, arrays and strings tested, objects MAY work
     * @param integer $spaces
     */
    function debug($input, $spaces=0) {


            if (is_array($input)) {
                foreach ($input as $key=>$val) {
                    if (is_array($val) || is_object($val)) {
                       $this -> debug("[$key] => $val", $spaces+4);
                       $this -> debug('(', $spaces + 8);
                       $this -> debug($val, $spaces + 8);
                    } else {
                        $this -> debug("[$key] => '$val'", $spaces + 4);
                    }
                }
                $this -> debug(")", $spaces);
            } else {
                if (is_array($_SERVER)
                && array_key_exists('HTTP_HOST', $_SERVER)) {
                    printf("<!--%s%s-->\r\n"
                    , str_repeat(' ', $spaces)
                    , htmlentities($input)
                    );
                } else {
                    $input = trim($input);
                    printf("%s%s\r\n", str_repeat(' ', $spaces), $input);
                }
            }
        }

}
?>
