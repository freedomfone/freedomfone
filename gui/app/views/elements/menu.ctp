<div>
<ul id='menu'>

<li class='logo'>
<?php echo $html->image('menu/menu_left.png',array('style'=>'float:left')); ?>
</li>

<li>
<?php echo $html->link(__("Home",true),'/'); ?>
</li>


<li><?php echo __("Freedom Fone",true);?>
<ul>

<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("About",true),'/about'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Architecture",true),'/architecture'); ?>
</li>

<li>
<?php echo $html->link(__("Functionality",true),'/functionality'); ?>
</li>


<li>
<?php echo $html->link(__("Download",true),'http://dev.freedomfone.org',array('target'=>'blank')); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.gif',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>


<li><?php echo __("Poll",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Create poll",true),'/polls/add/'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>


<li>
<?php echo $html->link(__("Manage polls",true),'/polls/'); ?>
</li>


<li>
<?php echo $html->link(__("Unclassified",true),'/bin/'); ?>
</li>


<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.gif',array('class'=>'middle'));?>
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
<?php echo $html->image('menu/dot.gif',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>



<li><?php echo __("Voice menus",true);?>
<ul>
<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Audio files",true),'/nodes/index'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li>
<?php echo $html->link(__("Voice menus",true),'/ivr_menus'); ?>
</li>

<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.gif',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>



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
<?php echo $html->image('menu/dot.gif',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>


<li><?php echo __("Dashboard",true);?>
<ul>

<li>
<?php echo $html->image('menu/corner_inset_left.png',array('class'=>'corner_inset_left')); ?>
<?php echo $html->link(__("Processes",true),'/processes'); ?>
<?php echo $html->image('menu/corner_inset_right.png',array('class'=>'corner_inset_right')); ?>
</li>

<li class='last'>
<?php echo $html->image('menu/corner_left.png',array('class'=>'corner_left')); ?>
<?php echo $html->image('menu/dot.gif',array('class'=>'middle'));?>
<?php echo $html->image('menu/corner_right.png',array('class'=>'corner_right'));?>
</li>
</ul>
</li>



<li>
<a href='https://dev.freedomfone.org/' target='_blank'><?php echo $html->image('menu/menu_mid_svn.png',array('style'=>'float:left'));?></a>
</li>


<li class='logo'>
<?php echo $html->image('menu/menu_right_long.png',array('style'=>'float:left'));?>
</li>

</ul>
</div>
