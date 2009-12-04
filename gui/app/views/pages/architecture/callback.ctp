<?php 
$this->pageTitle = 'Architecture : Callback';           
echo "<h1>Architecture: Callback</h1>";
echo $html->para(null,"Please select one of the alternatives below, to read about each component's architecture.");

//echo $this->element('menu_next',array('back_text'=>__('Voice menu',true),'back_link'=>'/architecture/ivr','div'=>'frameRight'));

echo "<ul>";
echo "<li>".$html->link('Poll', '/architecture/poll', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link('Leave-a-message', '/architecture/leave-a-message', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link('Voice Menus', '/architecture/ivr', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link('Callback', '/architecture/callback', array('target'=>'_parent'))."</li>";
echo "</ul>";

echo $html->image('illustrations/freedomfone_v1.0_architecture_callback.png', array('alt' => 'Callback architecture','border'=>0,'width'=>'850px'))

?>
