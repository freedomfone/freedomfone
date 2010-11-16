<?php
/****************************************************************************
 * menu.ctp	- Main horizontal menu
 * version 	- 1.0.354
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
?>

<div>
<ul id='menu'>

<li class='logo'>
<?php echo $html->image('menu/menu_left.png',array('style'=>'float:left')); ?>
</li>

<li>
<?php echo $html->link(__("Home",true),'/'); ?>
</li>




<li><?php echo __("Poll",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Manage polls",true),'/polls/'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Other SMS",true),'/bin/'); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>


<li><?php echo __("Leave-a-Message",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Inbox",true),'/messages/'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Archive",true),'/messages/archive'); ?>
</li>


<li>
<?php echo $html->link(__("Tags",true),'/tags/'); ?>
</li>

<li>
<?php echo $html->link(__("Categories",true),'/categories/'); ?>
</li>

<li>
<?php echo $html->link(__("IVR Menu",true),'/lm_menus/settings'); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>



<li><?php echo __("Voice menus",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Voice menus",true),'/ivr_menus'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Menu options",true),'/nodes/index'); ?>
</li>

<li>
<?php echo $html->link(__("Monitoring",true),'/monitor_ivr'); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>


<!--
<li><?php echo __("Callback",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Callbacks",true),'/callback/index'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Settings",true),'/callback_settings/index'); ?>
</li>

<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>
!-->

<li><?php echo __("System data",true);?>
<ul>


<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Call data records",true),'/cdr/'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Statistics",true),'/cdr/overview'); ?>
</li>


<li>
<?php echo $html->link(__("Reporting",true),'/cdr/general'); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</li>
</ul>
</li>

<li><?php echo __("Dashboard",true);?>
<ul>

<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("System Health",true),'/processes'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>


<li>
<?php echo $html->link(__("Settings",true),'/settings'); ?>
</li>


<li>
<?php echo $html->link(__("Software",true),'/processes/software'); ?>
</li>

<li>
<?php echo $html->link(__("GSM channels",true),'/channels'); ?>
</li>

<li>
<?php echo $html->link(__("System logs",true),'/logs'); ?>
</li>



<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>


<li><?php echo __("Help",true);?>
<ul>

<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Downloads",true),'http://www.freedomfone.org/page/downloads',array('target'=>'blank')); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>


<li>
<?php echo $html->link(__("Website",true),'http://www.freedomfone.org',array('target'=>'blank')); ?>
</li>

<li>
<?php echo $html->link(__("Wiki/SVN",true),'http://dev.freedomfone.org/wiki',array('target'=>'blank')); ?>
</li>


<li>
<?php echo $html->link(__("Feedback",true),'http://www.freedomfone.org/page/feedback',array('target'=>'blank')); ?>
</li>


<li>
<?php echo $html->link(__("About",true),'/about'); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>


<li class='logo'>
<?php echo $html->image('menu/menu_right_long.png',array('style'=>'float:left'));?>
</li>

</ul>
</div>
