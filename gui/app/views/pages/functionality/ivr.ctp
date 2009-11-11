<?php echo $this->element('menu_next',array('back_text'=>__('Leave-a-message',true),'back_link'=>'/functionality/leave-a-message','fwd_text'=>__('Callback',true),'fwd_link'=>'/functionality/callback','div'=>'frameRight')); ?>

<h1>Voice Menus</h1>

<?php echo $html->div('frameRight',$html->image('illustrations/FF_IVR_design.png', array('alt' => 'Freedon Fone v.1 Voice Menu design','border'=>'0')));?>


<p>The administrator is able to build personal Voice Menus based on customized audio files, or synthesized text messages.<p>
<p>A voice menu consists of:</p>

<ul>
<li>a set of mandatory voice messages, such as a Welcome message, and instructions on how to navigate through the menu, </li>
<li>pointers to so called nodes, that contain the actual content. </li>
</ul>

<p>A node is the combination of a customized audio file, with a text based title. A node can be used in one or more Voice Menus. The administrator can at any time create, edit, or listen to existing nodes. Nodes may be deleted if they do not participate in an existing voice menu. 
Freedom Fone v.1 offers the possibility to assign five nodes to a Voice Menu. The design of a Voice Menu is illustrated to the right.</p>



<p>The administrator can create multiple Voice Menus, but only one can be active at a time (marked as Default). The administrator can at any time edit or delete a Voice Menu. If the default Voice menu is deleted, the oldest existing Voice Menu will automatically become the new default.</p>
<p>The administrator can at any time change the default Voice Menu. </p>


