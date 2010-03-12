<?php 
/****************************************************************************
 * leave-a-message.ctp	- Architecture: Links to components, show Leave-a-message illustration
 * version 		- 1.0.356
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
$this->pageTitle = __('Architecture : Leave-a-Message',true);           
echo "<h1>".__('Architecture: Leave-a-Message',true)."</h1>";
echo $html->para(null,__("Please select one of the alternatives below, to read about each component's architecture.",true));

//echo $this->element('menu_next',array('back_text'=>__('Poll',true),'back_link'=>'/architecture/poll','fwd_text'=>__('Voice Menu',true),'fwd_link'=>'/architecture/ivr','div'=>'frameRight')); 

echo "<ul>";
echo "<li>".$html->link(__('Poll',true), '/architecture/poll', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link(__('Leave-a-message',true), '/architecture/leave-a-message', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link(__('Voice Menus',true), '/architecture/ivr', array('target'=>'_parent'))."</li>";
echo "</ul>";

echo $html->image('illustrations/freedomfone_v1.0_architecture_leaveMessage.png', array('title' => __('Leave-a-Message architecture',true),'border'=>0,'width'=>'850px'))

?>

