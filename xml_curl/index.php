<?php

header('Content-Type: text/xml');

$postvar1 = $_REQUEST['key_value'];
$postvar2 = $_REQUEST['section'];

if ( $postvar1 == "ivr.conf" ) 
	{
	$static_page = file_get_contents('ivr.xml');
	die($static_page);
	}
	elseif ( $postvar2 == "dialplan" ) 
	{	
	$static_page = file_get_contents('dialplan.xml');
	die($static_page);
	}	
	else 
	{
	$static_page = file_get_contents('dialplan.xml');
	die($static_page);
	}	
?>

