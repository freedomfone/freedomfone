<?php
$this->pageTitle = 'Functionality : ';           
echo "<h1>Freedom Fone v.1 functionality</h1>";

echo $html->para(null,"Please select one of the alternatives below, to read more about Freedom Fone's functionality.");

echo "<ul>";

echo "<li>".$html->link('Poll', '/functionality/poll', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link('Leave-a-message', '/functionality/leave-a-message', array('class'=>'foo','target'=>'_parent'))."</li>";
echo "<li>".$html->link('Voice Menus', '/functionality/ivr', array('class'=>'foo','target'=>'_parent'))."</li>";
echo "<li>".$html->link('Callback', '/functionality/callback', array('class'=>'foo','target'=>'_parent'))."</li>";
echo "</ul>";

?>
