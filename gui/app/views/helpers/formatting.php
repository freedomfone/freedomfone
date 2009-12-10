<?php
 /* /app/views/helpers/formatting.php 
  *
  * Source to epochToWords : http://www.phpro.org/
  *
  */

 class FormattingHelper extends AppHelper {
 


 
    function epochToWords($seconds){


    /*** return value ***/
    $ret = "";

    $hours = floor( $seconds/3600 );
    $partdays = fmod($seconds, 86400);
    $parthours = fmod($partdays, 3600);
    $minutes = floor( $parthours/60 );
    $seconds = fmod($parthours, 60);

    /*** get the hours ***/

    if($hours > 0)
    {
        $ret .= $seconds." ".__("h",true)." ";
    }
    /*** get the minutes ***/

    if($hours > 0 || $minutes > 0)
    {
        $ret .= $seconds." ".__("min",true)." ";
    }
  
    /*** get the seconds ***/

    $ret .= $seconds." ".__("sec",true);

    return $ret;
    }

    function changeExt($file,$ext){

    $part=substr($file,0,strlen($file)-3);

    return $part.$ext;

    }

}

?>