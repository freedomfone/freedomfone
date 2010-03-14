<?php 
/****************************************************************************
 * ivr.ctp	- Describes the Voice Menus functionality
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

$this->pageTitle = __('Functionality : Voice Menus',true);           

echo $this->element('menu_next',array('back_text'=>__('Leave-a-message',true),'back_link'=>'/functionality/leave-a-message','fwd_text'=>__('Dashboard',true),'fwd_link'=>'/functionality/dashboard','div'=>'frameRight'));
echo "<h1>".__('Functionality: Voice menus',true)."</h1>";
echo $html->div('frameRight',$html->image('illustrations/FF_IVR_design.png', array('title' => __('Freedon Fone v.1 Voice Menu design',true),'border'=>'0')));

echo __("<p>The administrator is able to build a variety of personal Voice Menus based on customized audio files, or synthesized text messages.<p>",true);
echo __("<p>A Voice menu consists of:</p><ul><li>Menu Instructions: a set of mandatory voice messages, such as a Welcome message, and instructions on how to navigate through the menu, </li><li>Menu Options: audio files or components assosiated with telephony keypad selections. </li></ul>",true);

echo "<h3>".__("Menu Instructions",true)."</h3>";
echo __("<p>A Menu Instruction can either be a text message (that is automatically synthesized) or an uploaded audio file. If an audio file is to be used it must be uploaded from your local computer by either clicking in the relevant Audio file text box or clicking the associated ‘Browse’ button.<p>You can revert to using a synthesized text message by “un-associating” the uploaded file. The audio file is not deleted and can be used in the Voice Menu at a later stage, by “associating” the file with the Menu Instruction once again.",true);

echo "<h3>".__("Menu Options",true)."</h3>";
echo __("<p>A <b>Menu Option</b> can either be <ul><li>an audio file previously uploaded through the Create Menu option page, or</li><li>a Leave-a-Message service</li></ul>",true);
echo __("<p>The administrator can at any time add, edit, listen to or delete existing Menu Options.",true);
echo __("<p>Menu option files can be .mp3 or .wav audio files. When they are uploaded into the system they are associated with a Title to help you manage your audio files.",true);
echo __("<p>A Menu option file can be used in one or more different Voice Menus. These files cannot be deleted if they are currently associated with a Voice Menu.",true);
echo __("<p>Freedom Fone v.1.5 offers the possibility to assign eight Menu Options to a Voice Menu.",true);

echo __("<p>The administrator can create multiple Voice Menus, but only one can be active at a time (marked as Default). The administrator can at any time edit or delete a Voice Menu. If the default Voice menu is deleted, the oldest existing Voice Menu will automatically become the new default.",true);
echo __("The administrator can at any time change the default Voice Menu.",true);

echo "<h3>".__("Monitoring",true)."</h3>";
echo __("<p>Freedom Fone offers the administrator a means to monitor the features and audio files accessed by callers via a voice menu. For each incoming call to a Voice Menu, the caller's options are recorded (time, ivr, digit pressed, menu option, caller number).<p>These call records can be exported to a CSV file. The administrator can choose to export All entries, or a range of entries using a start and end time. Where privacy is a concern, the administrator can choose to delete all monitoring data from the system (using start and end time).",true);






?>

