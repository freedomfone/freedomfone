<?php
/**
*** A Free Template by joomlajunkie.com
*** @version 1.0
*** @copyright (C) 2005-2006 by - Joomla Junkie
*** @web http://www.joomlajunkie.com
**/
//defined( '_VALID_MOS' ) or die( 'Direct Access to this location is not allowed.' );
//$iso = split( '=', _ISO );
//echo '<?xml version="1.0" encoding="'. $iso[1] .'"?' .'>'; ?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title_for_layout?></title>

    <?php echo $html->charset('UTF-8'); ?>

    <?=$html->css('templete_css');?>		<!-- joomla template -->
    <?=$html->css('customise');?>    		<!-- joomla template -->
    <?=$html->css('layout');?>	     		<!-- joomla template -->
    <?=$html->css('style');?>	     		<!-- Freedom Fone -->
    <?=$html->css('vimeo');?>	     		<!-- Main menu -->
    <?=$html->meta('icon');?>

    <?=$javascript->link('swfobject');?>	<!-- Flashhelper -->
    
    <?=$javascript->link('prototype');?>
    <?=$javascript->link('jquery');?>
    <?=$javascript->link('jquery.corner');?>
    <?=$javascript->includeScript('corner');?>

</head>

<body>
<div id="wrapper">
	 <div id="top_shadow"></div>
	 <div class="top_a">
		<div id="top_a_right"><?php echo $html->link('Contact us', '/contact'); ?></div>
	 </div>
	 <div id="branding_header"></div>
	 <div id="top_nav">
	 <?php echo $this->element('menu'); ?>
	 </div>

	 <div id="content_wrap">

		<div id="main_content">

    <?php echo $content_for_layout; ?>  

		</div>
	 </div><!--content_wrap end-->
	 <div class="footer">Lycaon Pictus Pictus</div>
</div><!--wrapper end-->
</body>
</html>
