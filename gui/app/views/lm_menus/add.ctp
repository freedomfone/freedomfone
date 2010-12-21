<?php
/****************************************************************************
 * add.ctp	- Create a new Leave-a-message IVR menu
 * version 	- 1.0.362
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

$lm_settings = Configure::read('LM_SETTINGS');
$lm_default  = Configure::read('LM_DEFAULT');


$info = __("Leave-a-message| The Leave-a-message voice menu consists of eight different messages. Each message can be generated in three different ways:| (1) customized audio files| (2) customized text to speech, or| (3) default text to speech.||If the administrator associates an audio file with a message, that file will be played to the caller when she enters the voice menu.|If no audio file is provided for a message, but a customized text message exists, the text message will be synthesized and played to the caller.|If neither an audio file, nor a customized text is provided, the default text will be synthesized and played to the user.|The audio files must be uploaded in .mp3 or .wav format through the user interface. Once uploaded, they can be listened to from the administration GUI via the built-in Flashplayer. Audio files can at any time be overwritten with a new audio file.",true);

      echo "<h1>".__("Create Leave a Message IVR",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }

echo $html->div('frameInfoLeft', $html->link($html->image('icons/bulb.png',array('alt'=>'Tooltips')),'#',array('class'=>'infobox','title'=>$info),null,false));
echo "<div class ='instruction'>".__("Please upload either an .mp3 or a .wav audio file for each message. If no audio file is present, the fallback text will be used in the Leave-a-Message IVR Menu. You can listen to your uploaded audio files by pressing the Play button or download a copy of the files by using the Download icon.",true)."</div>";
echo "<div class ='instruction'>".__("Audio files should be recorded in mono, 8KHz, and be maximum 10MB.",true)."</div>";

$min = ' '.__('min',true);
$commentWelcome  = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmWelcomeMessage']."</div>";
$commentInform   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmInformMessage']."</div>";
$commentInvalid  = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmInvalidMessage']."</div>";
$commentLong     = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmLongMessage']."</div>";
$commentSelect   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSelectMessage']."</div>";
$commentDelete   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmDeleteMessage']."</div>";
$commentSave     = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSaveMessage']."</div>";
$commentGoodbye  = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmGoodbyeMessage']."</div>";

$commentTitle     = $html->div('formComment', __('Name of this Leave-a-message IVR menu.',true));
$commentMaxreclen = $html->div('formComment', __('Maximum duration of voice message left by user.',true));
$commentForceTTS  = $html->div('formComment', __('Check the box to force Text-to-speach (ignore uploaded files)',true));
$options          = array('60' => '1'.$min, '120' => '2'.$min, '180' => '3'.$min, '240' => '4'.$min , '300' => '5'.$min, '900' => __('Unlimited',true)); 


echo $form->create('LmMenu', array('type' => 'post', 'action' => 'add','enctype' => 'multipart/form-data') );
echo $form->hidden('lmOnHangup',array('value'=>'accept'));
echo $form->hidden('lmForceTTS',array('value'=>0));
echo $form->hidden('id',array('value'=>$this->data['LmMenu']['id']));
echo $form->hidden('instance_id',array('value'=>$this->data['LmMenu']['instance_id']));

     // ** General settings **//
     echo "<fieldset><legend>".__('General settings',true)."</legend>";
      echo $form->input('LmMenu.title', array('between'=>'<br />','type'=>'text','size'=>'50','label'=>__('Title',true),'after' => $commentTitle));
     echo $form->input('LmMenu.lmMaxreclen', array('between'=>'<br />','type'=>'select', 'options' => $options, 'label'=>__('Message duration',true),'after' => $commentMaxreclen));
     echo $form->hidden('lmForceTTS',array('value'=>0));
     echo $form->input('lmForceTTS',array('type' =>'checkbox','label' => false, 'before' => __('Do not use uploaded files',true).' '));    	    
     echo $form->hidden('lmOnHangup',array('value'=>'accept'));
     echo $commentForceTTS;
     echo "</fieldset>";



     // ** Welcome **//
     echo "<fieldset><legend>".__('Step 1: Welcome message',true)."</legend>";
     $lines1[0] = array($form->input('LmMenuFile.lmWelcome', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true))));
     $lines1[1] = array($form->input('lmWelcomeMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentWelcome,'between'=>'<br />' ))); 
     echo "<table cellspacing = 0 class='none'>";
     echo $html->tableCells($lines1,array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Record **//
     echo "<fieldset><legend>".__('Step 2: Record message instructions',true)."</legend>";
     $lines2[0] = array($form->input('LmMenuFile.lmInform', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true))));
     $lines2[1] = array($form->input('lmInformMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentInform,'between'=>'<br />' ))); 
     echo "<table cellspacing = 0 class='none'>";
     echo $html->tableCells($lines2,array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo "</fieldset>";

     // Show and collapse advanced menu.
     echo $html->tag('h3', __('Advanced options',true),array('class'=> 'trigger'));
     echo $html->div();
     echo $html->div('instruction', __("If you choose to enable the advanced Leave-a-Message service, you should ask the caller to finish the call by pressing # instead of hanging up (in Step 2).",true));



     // ** Invalid **//
     echo "<fieldset><legend>".__('Step 3: Invalid message',true)."</legend>";
     $lines3[0] = array($form->input('LmMenuFile.lmInvalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true))));
     $lines3[1] = array($form->input('lmInvalidMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentInvalid,'between'=>'<br />' )));      
     echo "<table cellspacing = 0 class='none'>";
     echo $html->tableCells($lines3,array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Long **//
     echo "<fieldset><legend>".__('Step 4: Long message',true)."</legend>";
     $lines4[0] = array($form->input('LmMenuFile.lmLong', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true))));
     $lines4[1] = array($form->input('lmLongMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentLong,'between'=>'<br />' ))); 
     echo "<table cellspacing = 0 class='none'>";
     echo $html->tableCells($lines4,array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Select **//
     echo "<fieldset><legend>".__('Step 5: Select message',true)."</legend>";
     $lines5[0] = array($form->input('LmMenuFile.lmSelect', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true))));
     $lines5[1] = array($form->input('lmSelectMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentSelect,'between'=>'<br />' ))); 
     echo "<table cellspacing = 0 class='none'>";
     echo $html->tableCells($lines5,array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Delete **//
     echo "<fieldset><legend>".__('Step 6: Delete message',true)."</legend>";
     $lines6[0] = array($form->input('LmMenuFile.lmDelete', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true))));
     $lines6[1] = array($form->input('lmDeleteMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentDelete,'between'=>'<br />' ))); 
     echo "<table cellspacing = 0 class='none'>";
     echo $html->tableCells($lines6,array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Save **//
     echo "<fieldset><legend>".__('Step 7: Save message',true)."</legend>";
     $lines7[0] = array($form->input('LmMenuFile.lmSave', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true))));
     $lines7[1] = array($form->input('lmSaveMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentSave,'between'=>'<br />' ))); 
     echo "<table cellspacing = 0 class='none'>";
     echo $html->tableCells($lines7,array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo "</fieldset>";


     // ** Goodbye **//
     echo "<fieldset><legend>".__('Step 8: Goodbye message',true)."</legend>";
     $lines8[0] = array($form->input('LmMenuFile.lmGoodbye', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true))));
     $lines8[1] = array($form->input('lmGoodbyeMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentGoodbye,'between'=>'<br />' )));           
     echo "<table cellspacing = 0 class='none'>";
     echo $html->tableCells($lines8,array('class' => 'none'),array('class' => 'none'));
     echo "</table>";
     echo "</fieldset>";


     echo "</div>";
     echo $form->end(__('Save',true)); 



?>