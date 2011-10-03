<?php
/****************************************************************************
 * formatting.php	- Helper for formatting of timestamps.
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
 *  PHPRO.ORG http://www.phpro.org/
 *
 * Modified by:
 *   Louise Berthilson <louise@it46.se>
 *    
 *
 *
 ***************************************************************************/

 class FormattingHelper extends AppHelper {

 
    function epochToWords($seconds){

    /*** return value ***/
    $ret = "";

    $hours = intval(floor( $seconds/3600 ));
    $partdays = fmod($seconds, 86400);
    $parthours = fmod($partdays, 3600);
    $minutes = intval(floor( $parthours/60 ));
    $seconds = fmod($parthours, 60);

    /*** get the hours ***/

    if($hours > 0)
    {
        $ret .= $hours." ".__("h",true)." ";
    }
    /*** get the minutes ***/

    if($hours > 0 || $minutes > 0)
    {
        $ret .= $minutes." ".__("min",true)." ";
    }
  
    /*** get the seconds ***/

    $ret .= $seconds." ".__("sec",true);

    return $ret;
    }

    function changeExt($file,$ext){

    $part=substr($file,0,strlen($file)-3);

    return $part.$ext;

    }

    function appMatch($code){

     switch($code){

	     case 'poll':
	     return __('Poll',true);
	     break;

	     case 'lam':
	     return __('Leave-a-message',true);
	     break;

	     case 'ivr':
	     return __('Voice menu',true);
	     break;

	     case 'callback':
	     return __('Callback',true);
	     break;

	     case 'bin':
	     return __('Other SMS',true);
	     break;    
      }

    }


    function dialerStatus($code){

     switch($code){

	     case '1':
	     return __('Poll',true);
	     break;

	     case '2':
	     return __('Leave-a-message',true);
	     break;

	     case '3':
	     return __('Voice menu',true);
	     break;

      }

    }





}

?>
