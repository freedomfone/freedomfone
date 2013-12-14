<?php
     if ($_REQUEST ['getfile']){
        $file = $_REQUEST ['getfile'];
     
     }

$save_as_name = basename($file);   
ini_set('session.cache_limiter', '');
header('Expires: Thu, 19 Nov 1981 08:52:00 GMT');
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Pragma: no-cache');
header("Content-Type: application/octet-stream");
header("Content-Disposition: disposition-type=attachment; filename=\"$save_as_name\"");

readfile($file);

?>