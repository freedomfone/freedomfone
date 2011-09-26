<?php
/****************************************************************************
 * home.ctp	- Front page
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
 * Inspired by:
 * A Free Template by joomlajunkie.com
 * @version 1.0
 * @copyright (C) 2005-2006 by - Joomla Junkie
 * @web http://www.joomlajunkie.com
 * 
 ***************************************************************************/

$rand = rand();
$player = 'AudioPlayer.setup("'.MY_DOMAIN.'/app/webroot/swf/player.swf?randomcount='.$rand.'", { 
	         width: "200",
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

    <?=$html->css('customise');?>    		<!-- Freedom Fone -->
    <?=$html->css('style');?>	     		<!-- Freedom Fone -->
    <?=$html->css('flash_messages');?>	     	<!-- Flash messages -->
    <?=$html->css('vimeo');?>	     		<!-- Main menu -->
    <?=$html->css('modalbox');?>	        <!-- Modalbox cluetip -->
    <?=$html->meta('icon');?>

    <?=$html->meta('keywords','SMS, mobile, GMS, callback, development, IVR, poll, FreeSWITCH, GSMOpen, CakePHP, ICT4D, M4D, activism, NGO, civil society, citizen journalism, reporting, journalism, Freedom Fone, Kubatana, voice, voip');?>

    <?php echo $javascript->includeScript('confirmSubmit'); ?>  <!-- Confirmation of form submit -->
    <?php echo $html->script('prototype');?>
    <?php echo $html->script('scriptaculous.js?load=builder,effects');?>
    <?php echo $html->script('modalbox');?>
    <?php echo $html->script('cakemodalbox');?>


<!--    <?=$html->script('jquery.tableCorners');?>   -->  <!-- Cluetip -->
 

    <?=$html->script('audio-player');?>			  <!-- Audioplayer -->
    <?=$html->scriptBlock($player,array('safe'=>false));?>    <!-- Audioplayer -->

 
</head>

<body>
<div id="wrapper">
	 <div class="header">
         <? if (isset ($authUser)){ echo $html->div('login',__("Logged in as",true).": ".$authUser); } ?> </div>

	 <div id="top_nav"><?php 
              if($authGroup == 1){
                            echo $this->element('menuAdmin'); 
              } else {
                             echo $this->element('menuUser');
              } 

              ?>		<!-- horizonal menu -->

        <?php 
          if(isset($authGroup)){
             if ($authGroup) { 
               echo $this->Html->image("icons/logout.png", array("class" => "logout", "alt" => __("Logout",true), "title" => __("Logout",true), "url" => array("controller" => "ff_users", "action" => "logout")));
              }
           } ?>

           </div>
	 <div id="content_wrap">
        <?php echo $html->div('breadcrumb', $html->getCrumbs(' > ',__('Home',true))); ?>



		<div id="main_content">
                <?php echo $this->Session->flash('auth');?>

    		<?php 
                echo $content_for_layout; ?>  
		</div>								<!--main_content end-->
	 </div>									<!--content_wrap end-->
	 
	 <div class="footer"><?php echo VERSION_NAME." ".VERSION; ?>
         <?php echo "( Memory: ".round(memory_get_peak_usage()/1000000).' MB)'; ?>         
         </div>
</div>										<!--wrapper end-->
</body>
</html>
