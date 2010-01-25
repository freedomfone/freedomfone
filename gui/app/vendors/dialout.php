<?php
/****************************************************************************
 * dialout.php		- Class for socket connecton with dialer.
 * version 		- 1.0.359
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
 *  Raymond Chandler intralaman@freeswitch.org
 *
 *
 ***************************************************************************/

class dialer_sock {
    /**
     * Sets Whether auth to socket was successful or not
     * Used to not send further commands until auth is successful
     *
     * @var boolean
     */
    public $auth;
    public $connected;
     /**
     * Class instantiation
     * This method will connect to the socket and authenticate
     *
     * @param array $vars
     *
     * @return bool $dialer_sock, on error return false
     */
    function dialer_sock($vars=null) {

        $initial_vars = $this -> set_initial_vars($vars);
        $this -> debug($initial_vars);

        if (!defined('BUFFER_SIZE')) {
            /**
             * This is the buffer size for fread/fgets operations (default 4096)
             * Define BUFFER_SIZE before instantiation to use a different size
             */
            define('BUFFER_SIZE', 4096);
        }

	if($this -> sock_connect($initial_vars)){
           $initial_output = $this -> sock_get();
            if ($initial_output['Content-Type'] == 'auth/request') {
               $this -> debug('---- authentication requested ----');
               $this -> sock_auth($initial_vars['pass']);
            }
	    $this->connected=true;
	 }

	 else {
	 $this->connected=false;
	  } 
  }
      

    /**
     * Close the connection to the event socket
     *
     */
    function sock_close() {
        $this -> send_command('exit');
        fclose($this -> sock);
    }

    /**
     * Sets connection info from array passed, or used a set of defaults if nothing is passed
     *
     * @param array $var_array array of connection settings to use (host|port|pass|timeout)
     * @return array
     */
    function set_initial_vars($var_array){

        $defaults = array(
        'host' => '127.0.0.1',
        'port' => '9999',
        'pass' => 'dialer',
        'timeout' => 30,
        'stream_timeout' => 5
        );

        foreach ($defaults as $key => $value) {

            if (array_key_exists($key, $var_array)) {
                $this -> debug("$key found in vars");
                $connection_settings[$key] = $var_array[$key];
            } else {
               $this -> debug("$key not found in vars");
                $connection_settings[$key] = $value;
            }
        }
        $this -> debug($connection_settings);
        return $connection_settings;
    }

   /**
     * Connect to the event socket using the array determined by set_initial_vars
     *
     * @param array $sock_array array of connection parameters
     * @return boolean
     */
   function sock_connect($sock_array) {

        $host = $sock_array['host'];
        $port = $sock_array['port'];
        $timeout = $sock_array['timeout'];
        $this -> sock = fsockopen($host, $port, $errno, $errstr, $timeout);
     
     if (!$this -> sock) {

	    $this->log("Unable to connect to FreeSWITCH","ERROR");

            return false;
        } else {

            $this -> set_stream_opts($sock_array);
            return true;
        }
    }

   /**
     * Write data to socket 
     *
     * @param string $data
     * 
     */
    function sock_write($data){

    return fwrite($this->sock,$data);

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