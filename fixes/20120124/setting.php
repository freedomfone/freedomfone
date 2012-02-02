<?php
/****************************************************************************
 * setting.php	- Model for global settings
 * version 	- 3.0.1500
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


class Setting extends AppModel{

      var $name = 'Setting';


	function getIP($type){
	
	  switch($type){

	    case 'internal':
	    $ip = $_SERVER['HTTP_HOST'];
	    break;

	    case 'external':
	    $cmd = "/usr/bin/wget http://wim.freedomfone.org/wim/ -O - -q echo";
  	    $op = array();
            exec($cmd,$op);

            if(sizeof($op)){
	        $ip = $op[0];
             } else {
                $ip = false;
             }
 
	    break;

	  }

	  return $ip;

	  }

	function validIP($ip) {

	     $cIP = ip2long($ip);
	     $fIP = long2ip($cIP);

	     if($fIP=='0.0.0.0'){ 
	 	return false;
		} else { 
		return true;
		}
	}

	function validDomain($domain){

		 
		 if (preg_match ("/^[a-z0-9.]+(\.[a-z]{2,4})+$/i", $domain)) {

    		    return true;

		 } elseif ($domain == 'localhost') {

                    return true;

                 } else {

		    return false;
		 }

	}



}

?>
