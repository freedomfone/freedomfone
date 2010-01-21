<?php 
/****************************************************************************
 * leave-a-message.ctp	- Describes the Leave-a-messages functionality
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

$this->pageTitle = __("Functionality : Leave-a-Message",true);           
echo $this->element('menu_next',array('back_text'=>__('Poll',true),'back_link'=>'/functionality/poll','fwd_text'=>__('Voice Menus',true),'fwd_link'=>'/functionality/ivr','div'=>'frameRight'));

echo "<h1>".__("Functionality: Leave-a-Message",true)."</h1>";

echo __("<p>The Leave-a-Message service offers callers the option to call into Freedom Fone, and leave  their personal message. This may be a report, feedback, tip-off, response to a question, or perhaps a job application.</p>",true);
echo __("<p>A caller using the Leave-a-message service is connected to a voice menu created by the Freedom Fone administrator. The voice menu greets the caller and provides instructions as to how to use the service.  The Leave-a-message service allows the caller to </p><ul><li>Record a message</li><li>Listen to their recorded message</li><li>Delete and record a new message OR</li><li>Save their message and exit</li></ul>",true);

echo $html->image('illustrations/FF_LAM_state_machine.png', array('title' => 'CakePHP','border'=>0));
echo __("<p>By using the buttons # (hash), * (star), 0 (zero) and 1 (one), the user is able to navigate through the menu according to the illustration above.</p>",true);

echo "<h3>".__("The Leave-a-message Voice Menu",true)."</h3>";
echo __("<p>The Leave-a-message voice menu is created by the administrator. The menu consists of eight different messages. Each message can be generated in three different ways:</p><ol><li>Customized audio files</li><li>Customized text to speech</li><li>Default text to speech</li></ol>",true);


echo __("<p>If the administrator associates an audio file with a message, that file will be played to the caller when she enters the voice menu.</p>",true);
echo __("<p>If no audio file is provided for a message, but a customized text message exists, the text message will be synthesized and played to the caller.</p>",true);
echo __("<p>If neither an audio file, nor a customized text is provided, the default text will be synthesized and played to the user.</p>",true);
echo __("<p>The audio files must be uploaded in .mp3 or .wav format through the user interface. Once uploaded, they can be listened to from the administration GUI via the built-in Flashplayer. Audio files can at any time be overwritten with a new audio file.</p>",true);

echo "<h3>".__("Received voice messages",true)."</h3>";
echo __("<p>The Freedom Fone administrator receives all incoming messages to the “Inbox”. For each message, the administrator can</p><ul><li>listen to it (with a built-in Flashplayer)</li><li>name (give the message a title)</li><li>assign a category</li><li>associate the message with one or more tags</li><li>give the message a rating (1-5)</li></ul>",true);

echo __("<p>The administrator can choose to delete a message, or to archive it for future use.</p>",true);
echo __("<p>To call the Leave-a-message service, dial +39 340 47 80 434 or make a Skype call to 'skypiax2'.</p>",true);

?>