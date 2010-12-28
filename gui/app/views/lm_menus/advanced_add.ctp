<?php
/****************************************************************************
 * advanced_add.ctp	- AJAX view for advanced LAM settings (create LAM)
 * version 	        - 2.0.1041
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

$commentInvalid   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmInvalidMessage']."</div>";
$commentLong      = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmLongMessage']."</div>";
$commentSelect    = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSelectMessage']."</div>";
$commentDelete    = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmDeleteMessage']."</div>";
$commentSave      = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSaveMessage']."</div>";
$commentGoodbye   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmGoodbyeMessage']."</div>";


$input3_3 = $input3_4 = false;
$input4_3 = $input4_4 = false;
$input5_3 = $input5_4 = false;
$input6_3 = $input6_4 = false;
$input7_3 = $input7_4 = false;
$input8_3 = $input8_4 = false;


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

?>