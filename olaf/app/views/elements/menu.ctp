<?php
/****************************************************************************
 * menu.ctp	- Main horizontal menu
 * version 	- 2.0.1170
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
<?php echo $html->link(__("Create poll",true),'/polls/add/'); ?>
</li>



<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>


<li><?php echo __("Message Centre",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Inboxes",true),'/messages/'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Archives",true),'/messages/archive'); ?>
</li>


<li>
<?php echo $html->link(__("Tags",true),'/tags/'); ?>
</li>

<li>
<?php echo $html->link(__("Categories",true),'/categories/'); ?>
</li>

<li>
<?php echo $html->link(__("Manage LAM",true),'/lm_menus/index'); ?>
</li>

<li>
<?php echo $html->link(__("Incoming SMS",true),'/bin/'); ?>
</li>



<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>



<li><?php echo __("IVR Centre",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Language selectors",true),'/selectors'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>


<li>
<?php echo $html->link(__("Voice menus",true),'/ivr_menus'); ?>
</li>


<li>
<?php echo $html->link(__("Content",true),'/nodes/index'); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>


<li><?php echo __("User Management",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Phone books",true),'/phone_books'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Users",true),'/users'); ?>
</li>

<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>




<li><?php echo __("Dialer",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Campaigns",true),'/campaigns'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Callback services",true),'/callback_services'); ?>
</li>


<li>
<?php echo $html->link(__("Settings",true),'/callback_settings'); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>


<li><?php echo __("System data",true);?>
<ul>

<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Call data records",true),'/cdr/'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Statistics",true),'/cdr/statistics'); ?>
</li>

<li>
<?php echo $html->link(__("Monitoring",true),'/monitor_ivr'); ?>
</li>

<li>
<?php echo $html->link(__("Reporting",true),'/cdr/general'); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.png',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>

<li><?php echo __("Dashboard",true);?>
<ul>

<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Health",true),'/processes'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>


<li>
<?php echo $html->link(__("Settings",true),'/settings'); ?>
</li>


<li>
<?php echo $html->link(__("GSM channels",true),'/channels'); ?>
</li>


<li>
<?php echo $html->link(__("Logs",true),'/logs'); ?>
</li>


<li>
<?php echo $html->link(__("About",true),'/dashboard/about'); ?>
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
