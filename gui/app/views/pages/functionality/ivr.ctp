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

echo $this->element('menu_next',array('back_text'=>__('Leave-a-message',true),'back_link'=>'/functionality/leave-a-message','fwd_text'=>__('Callback',true),'fwd_link'=>'/functionality/callback','div'=>'frameRight'));
echo "<h1>".__('Functionality: Voice menus',true)."</h1>";
echo $html->div('frameRight',$html->image('illustrations/FF_IVR_design.png', array('title' => __('Freedon Fone v.1 Voice Menu design',true),'border'=>'0')));

echo __("<p>The administrator is able to build personal Voice Menus based on customized audio files, or synthesized text messages.<p>",true);
echo __("<p>A Voice menu consists of:</p><ul><li>Menu instructions: a set of mandatory voice messages, such as a Welcome message, and instructions on how to navigate through the menu, </li><li>Pointers to so called Menu Options, that contain the actual content. </li></ul>",true);

echo __("<p>A Menu Option is the combination of a customized audio file, with a text based title. A Menu Option can be used in one or more Voice Menus. The administrator can at any time create, edit, or listen to existing Menu Options. Menu Optios may be deleted if they do not participate in an existing voice menu. Freedom Fone v.1 offers the possibility to assign eight Menu Options to a Voice Menu. The design of a Voice Menu is illustrated to the right.</p>",true);

echo __("<p>The administrator can create multiple Voice Menus, but only one can be active at a time (marked as Default). The administrator can at any time edit or delete a Voice Menu. If the default Voice menu is deleted, the oldest existing Voice Menu will automatically become the new default.</p>",true);
echo __("<p>The administrator can at any time change the default Voice Menu.</p>",true);


?>

