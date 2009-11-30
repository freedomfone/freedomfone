<?php 
echo "<h1>Architecture: Voice menu</h1>";
echo $html->para(null,"Please select one of the alternatives below, to read about each component's architecture.");

//echo $this->element('menu_next',array('back_text'=>__('Leave-a-message',true),'back_link'=>'/architecture/leave-a-message','fwd_text'=>__('Callback',true),'fwd_link'=>'/architecture/callback','div'=>'frameRight')); 

echo "<ul>";
echo "<li>".$html->link('Poll', '/architecture/poll', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link('Leave-a-message', '/architecture/leave-a-message', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link('Voice Menus', '/architecture/ivr', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link('Callback', '/architecture/callback', array('target'=>'_parent'))."</li>";
echo "</ul>";


echo $html->image('illustrations/freedomfone_v1.0_architecture_voiceMenu.png', array('alt' => 'Voice Menu architecture','border'=>0,'height'=>'400px'))
?>
