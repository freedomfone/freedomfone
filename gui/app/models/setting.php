<?php
/****************************************************************************
 * setting.php	- Model for global settings
 * version 	- 1.0.359
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
     	    //FIXME! Do you know a better way to deal with this problem?
	    //$cmd = "/usr/bin/python /var/tmp/mylocalip.py";
	    //$ip = gethostbyname(trim(`hostname`));
            $ip =  $_SERVER['SERVER_ADDR'];  	    
	    break;

	    case 'external':
	    $cmd = "/usr/bin/wget www.whatismyip.com/automation/n09230945.asp -O - -q echo";
  	    $op = array();
	    exec($cmd,$op);
	    $ip = $op[0]; 
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


}

?>
