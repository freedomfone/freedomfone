<?php 
/****************************************************************************
 * poll.ctp	- Architecture: Links to components, show Poll illustration
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
$this->pageTitle = __('Architecture : Poll',true);           
echo "<h1>".__('Architecture: Poll',true)."</h1>";
echo $html->para(null,__("Please select one of the alternatives below, to read about each component's architecture.",true));

//echo $this->element('menu_next',array('fwd_text'=>__('Leave-a-message',true),'fwd_link'=>'/architecture/leave-a-message','div'=>'frameRight'));

echo "<ul>";
echo "<li>".$html->link(__('Poll',true), '/architecture/poll', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link(__('Leave-a-message',true), '/architecture/leave-a-message', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link(__('Voice Menus',true), '/architecture/ivr', array('target'=>'_parent'))."</li>";
echo "<li>".$html->link(__('Callback',true), '/architecture/callback', array('target'=>'_parent'))."</li>";
echo "</ul>";

echo $html->image('illustrations/freedomfone_v1.0_architecture_poll.png', array('title' => __('Poll architecture',true),'border'=>0,'width'=>'850px'))

?>