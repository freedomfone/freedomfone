
<?php
/****************************************************************************
 * index.ctp	- Functionality: List components and links
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
 *
 ***************************************************************************/

$this->pageTitle = __('Functionality : ',true);           
echo "<h1>".__('Freedom Fone v.1 functionality',true)."</h1>";

echo $html->para(null,__("Please select one of the alternatives below, to read more about Freedom Fone's functionality.",true));

echo "<ul>";

echo "<li>".$html->link(__('Poll',true), '/functionality/poll', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link(__('Leave-a-message',true), '/functionality/leave-a-message', array('class'=>'foo','target'=>'_parent'))."</li>";
echo "<li>".$html->link(__('Voice Menus',true), '/functionality/ivr', array('class'=>'foo','target'=>'_parent'))."</li>";
echo "<li>".$html->link(__('Callback',true), '/functionality/callback', array('class'=>'foo','target'=>'_parent'))."</li>";
echo "<li>".$html->link(__('Dashboard',true), '/functionality/dashboard', array('class'=>'foo','target'=>'_parent'))."</li>";
echo "</ul>";

?>
