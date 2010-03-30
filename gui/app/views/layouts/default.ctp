<?php
/****************************************************************************
 * home.ctp	- Front page
 * version 	- 1.0.356
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
 * Inspired by:
 * A Free Template by joomlajunkie.com
 * @version 1.0
 * @copyright (C) 2005-2006 by - Joomla Junkie
 * @web http://www.joomlajunkie.com
 * 
 ***************************************************************************/

$player = 'AudioPlayer.setup("'.MY_DOMAIN.'/app/webroot/swf/player.swf", {  
	         width: 200,
		 transparentpagebg: "yes",
		 leftbg: "CCCCCC",  
		 lefticon: "fe911c",
		 righticon: "fe911c",
		 righticonhover: "fe911c"
            });';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title><?php echo $title_for_layout?></title>

    <?php echo $html->charset('UTF-8'); ?>

    <?=$html->css('customise');?>    		<!-- joomla template -->
    <?=$html->css('layout');?>	     		<!-- joomla template -->
    <?=$html->css('style');?>	     		<!-- Freedom Fone -->
    <?=$html->css('vimeo');?>	     		<!-- Main menu -->
    <?=$html->css('jquery.cluetip');?>	     	<!-- JQuery Cluetip -->
    <?=$html->meta('icon');?>

    <?=$html->meta('keywords','SMS, mobile, GMS, callback, development, IVR, poll, FreeSWITCH, GSMOpen, CakePHP, ICT4D, M4D, activism, NGO, civil society, citizen journalism, reporting, journalism, Freedom Fone, Kubatana, voice, voip');?>

    <?=$javascript->link('jquery');?>		
    <?=$javascript->link('jquery.cluetip');?>     <!-- Cluetip -->
    <?=$javascript->includeScript('cluetip');?>   <!-- Cluetip -->
    <?=$javascript->link('audio-player');?>			  <!-- Audioplayer -->
    <?=$javascript->codeBlock($player,array('safe'=>false));?>    <!-- Audioplayer -->
   
    <?=$javascript->link('jquery.corner');?>	<!-- Rounded corner -->
    <?=$javascript->includeScript('corner');?>  <!-- Rounded corner -->

</head>

<body>
<div id="wrapper">
	 <div id="top_shadow"></div>
	 <div class="top_a">
		 <div id="top_a_left">Leave-a-message: Call +46 734 309 008, Voice menu: Call +46 733 140 416, Poll: SMS to any of the two numbers </div>
		 <div id="top_a_right"><?php echo $html->link(__('Freedom Fone',true), 'http://www.freedomfone.org',array('target' => '_blank','title' =>__("Visit the Freedom Fone website",true))); ?></div>

	 </div>
	 <div id="branding_header"></div>					<!-- banner -->
	 <div id="top_nav"><?php echo $this->element('menu'); ?></div>		<!-- horizonal menu -->

	 <div id="content_wrap">
		<div id="main_content">
    		<?php echo $content_for_layout; ?>  
		</div>								<!--main_content end-->
	 </div>									<!--content_wrap end-->
	 
	 <div class="footer">Lycaon Pictus Lupinus 1.5.3</div>
</div>										<!--wrapper end-->
</body>
</html>
