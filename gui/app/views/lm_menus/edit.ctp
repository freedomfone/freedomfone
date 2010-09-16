<?php
/****************************************************************************
 * edit.ctp	- Edit Leave-a-message IVR menu
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

if($this->data){

$lm_settings = Configure::read('LM_SETTINGS');
$lm_default  = Configure::read('LM_DEFAULT');

$info = __("Leave-a-message| The Leave-a-message voice menu consists of eight different messages. Each message can be generated in three different ways:| (1) customized audio files| (2) customized text to speech, or| (3) default text to speech.||If the administrator associates an audio file with a message, that file will be played to the caller when she enters the voice menu.|If no audio file is provided for a message, but a customized text message exists, the text message will be synthesized and played to the caller.|If neither an audio file, nor a customized text is provided, the default text will be synthesized and played to the user.|The audio files must be uploaded in .mp3 or .wav format through the user interface. Once uploaded, they can be listened to from the administration GUI via the built-in Flashplayer. Audio files can at any time be overwritten with a new audio file.",true);


     echo "<h1>".__("Modify Leave a Message IVR",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }



         echo $html->div('frameInfoLeft', $html->link($html->image('icons/bulb.png',array('alt'=>'Tooltips')),'#',array('class'=>'infobox','title'=>$info),null,false));
         echo "<div class ='instruction'>".__("Please upload either an .mp3 or a .wav audio file for each message. If no audio file is present, the fallback text will be used in the Leave-a-Message IVR Menu. You can listen to your uploaded audio files by pressing the Play button or download a copy of the files by using the Download icon.",true)."</div>";
         echo "<div class ='instruction'>".__("Audio files should be recorded in mono, 8KHz, and be maximum 10MB.",true)."</div>";



$commentWelcome  = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmWelcomeMessage']."</div>";
$commentInform   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmInformMessage']."</div>";
$commentInvalid  = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmInvalidMessage']."</div>";
$commentLong     = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmLongMessage']."</div>";
$commentSelect   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSelectMessage']."</div>";
$commentDelete   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmDeleteMessage']."</div>";
$commentSave     = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSaveMessage']."</div>";
$commentGoodbye  = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmGoodbyeMessage']."</div>";


echo $form->create('LmMenu', array('type' => 'post', 'action' => 'edit','enctype' => 'multipart/form-data') );
$path = $lm_settings['path'].$this->data['LmMenu']['instance_id']."/".$lm_settings['dir_menu'];



$input1_3 = $input1_4 = false;
$input2_3 = $input2_4 = false;
$input3_3 = $input3_4 = false;
$input4_3 = $input4_4 = false;
$input5_3 = $input5_4 = false;
$input6_3 = $input6_4 = false;
$input7_3 = $input7_4 = false;
$input8_3 = $input8_4 = false;


echo $form->hidden('instance_id',array('value'=>$this->data['LmMenu']['instance_id']));

     
        //Checkbox for not using uploaded files
        echo $form->hidden('lmForceTTS',array('value'=>0));
        echo $form->hidden('lmOnHangup',array('value'=>'accept'));
        echo $form->input('lmForceTTS',array('type' =>'checkbox','label' => false, 'after' =>' '.__('Do not use uploaded files',true)));    	    


     // ** Title **//
     echo "<fieldset><legend>".__('Title',true)."</legend>";
     echo $form->input('LmMenu.title', array('between'=>'<br />','type'=>'text','size'=>'50','label'=>__('Name of your Leave-a-message IVR menu.',true)));
     echo "</fieldset>";


     // ** Welcome **//
     echo "<fieldset><legend>".__('Step 1: Welcome message',true)."</legend>";
     $input1_1 = $form->input('LmMenuFile.lmWelcome', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input1_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmWelcome','title'=>__('Welcome Message',true),'id'=>'welcome')),array('valign'=>'bottom'));
     $input1_5 = $form->input('lmWelcomeMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentWelcome,'between'=>'<br />' )); 
     $lines1[0] = array(array($input1_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));
  
      if (file_exists($path.'/lmWelcome.mp3')){      	    
      	    $input1_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Welcome",null, null, false);
      } 



     $lines1[1] = array($input1_1,array($input1_3,array('valign'=>'bottom','width'=>'25')), $input1_2);
     


     echo "<table>";
     echo $html->tableCells($lines1);
     echo "</table>";
     echo "</fieldset>";


     // ** Record **//
     echo "<fieldset><legend>".__('Step 2: Record message instructions',true)."</legend>";
     $input2_1 = $form->input('LmMenuFile.lmInform', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input2_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmInform','title'=>__('Inform Message',true),'id'=>'inform')),array('valign'=>'bottom'));
     $input2_5 = $form->input('lmInformMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentInform,'between'=>'<br />' )); 

     $lines2[0] = array(array($input2_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmInform.mp3')){ 
      	    $input2_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Inform",null, null, false);
       } 

     $lines2[1] = array($input2_1,array($input2_3,array('valign'=>'bottom','width'=>'25')), $input2_2);
    
 
     echo "<table>";
     echo $html->tableCells($lines2);
     echo "</table>";
     echo "</fieldset>";

     // Show and collapse advanced menu.

     echo $html->tag('h3', __('advanced options',true),array('class'=> 'trigger'));
     echo $html->div();


     echo $html->div('instruction', __("If you choose to enable the advanced Leave-a-Message service, you should ask the caller to finish the call by pressing # instead of hanging up (in Step 2).",true));


     // ** Invalid **//
     echo "<fieldset><legend>".__('Step 3: Invalid message',true)."</legend>";
     $input3_1 = $form->input('LmMenuFile.lmInvalid', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input3_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmInvalid','title'=>__('Invalid Message',true),'id'=>'invalid')),array('valign'=>'bottom'));
     $input3_5 = $form->input('lmInvalidMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentInvalid,'between'=>'<br />' )); 

     $lines3[0] = array(array($input3_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmInvalid.mp3')){ 
	    $input3_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Invalid",null, null, false);
      } 


     $lines3[1] = array($input3_1,array($input3_3,array('valign'=>'bottom','width'=>'25')), $input3_2);
     
     echo "<table>";
     echo $html->tableCells($lines3);
     echo "</table>";
     echo "</fieldset>";


     // ** Long **//
     echo "<fieldset><legend>".__('Step 4: Long message',true)."</legend>";
     $input4_1 = $form->input('LmMenuFile.lmLong', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input4_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmLong','title'=>__('Long Message',true),'id'=>'long')),array('valign'=>'bottom'));
     $input4_5 = $form->input('lmLongMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentLong,'between'=>'<br />' )); 

     $lines4[0] = array(array($input4_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmLong.mp3')){ 
            $input4_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Long",null, null, false);
	
     } 



     $lines4[1] = array($input4_1,array($input4_3,array('valign'=>'bottom','width'=>'25')), $input4_2);
          
     echo "<table>"; 
     echo $html->tableCells($lines4);
     echo "</table>";
     echo "</fieldset>";


     // ** Select **//
     echo "<fieldset><legend>".__('Step 5: Select message',true)."</legend>";
     $input5_1 = $form->input('LmMenuFile.lmSelect', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input5_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmSelect','title'=>__('Select Message',true),'id'=>'select')),array('valign'=>'bottom'));
     $input5_5 = $form->input('lmSelectMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentSelect,'between'=>'<br />' )); 

     $lines5[0] = array(array($input5_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));
      if (file_exists($path.'/lmSelect.mp3')){ 
      	 $input5_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Select",null, null, false);	
      } 


     $lines5[1] = array($input5_1,array($input5_3,array('valign'=>'bottom','width'=>'25')), $input5_2);
    
     echo "<table>";
     echo $html->tableCells($lines5);
     echo "</table>";
     echo "</fieldset>";


     // ** Delete **//
     echo "<fieldset><legend>".__('Step 6: Delete message',true)."</legend>";
     $input6_1 = $form->input('LmMenuFile.lmDelete', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input6_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmDelete','title'=>__('Delete Message',true),'id'=>'delete')),array('valign'=>'bottom'));
     $input6_5 = $form->input('lmDeleteMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentDelete,'between'=>'<br />' )); 
     
     $lines6[0] = array(array($input6_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmDelete.mp3')){ 
      	 $input6_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Delete",null, null, false);	
      } 


     $lines6[1] = array($input6_1,array($input6_3,array('valign'=>'bottom','width'=>'25')), $input6_2);
     
     echo "<table>";
     echo $html->tableCells($lines6);
     echo "</table>";
     echo "</fieldset>";


     // ** Save **//
     echo "<fieldset><legend>".__('Step 7: Save message',true)."</legend>";
     $input7_1 = $form->input('LmMenuFile.lmSave', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input7_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmSave','title'=>__('Save Message',true),'id'=>'save')),array('valign'=>'bottom'));
     $input7_5 = $form->input('lmSaveMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentSave,'between'=>'<br />' )); 

     $lines7[0] = array(array($input7_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmSave.mp3')){
      	    $input7_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Save",null, null, false); 
      } 


     $lines7[1] = array($input7_1,array($input7_3,array('valign'=>'bottom','width'=>'25')), $input7_2);
     

     echo "<table>";
     echo $html->tableCells($lines7);
     echo "</table>";
     echo "</fieldset>";


     // ** Goodbye **//
     echo "<fieldset><legend>".__('Step 8: Goodbye message',true)."</legend>";
     $input8_1 = $form->input('LmMenuFile.lmGoodbye', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>__('Audio file',true)));
     $input8_2 = array($this->element('player',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmGoodbye','title'=>__('Goodbye Message',true),'id'=>'goodbye')),array('valign'=>'bottom'));
     $input8_5 = $form->input('lmGoodbyeMessage',array('type'=>'textarea','rows' => '2','cols'=>'100%','label'=>__('Fallback text',true),'after' => $commentGoodbye,'between'=>'<br />' )); 

     $lines8[0] = array(array($input8_5,array('colspan'=>3,'height'=>20,'valign'=>'bottom')));

      if (file_exists($path.'/lmGoodbye.mp3')){ 
            $input8_3 =$html->link($html->image("icons/music.png", array("title" => __("Download",true))),"/lm_menus/download/{$this->data['LmMenu']['id']}/Goodbye",null, null, false);
      } 


     $lines8[1] = array($input8_1,array($input8_3,array('valign'=>'bottom','width'=>'25')), $input8_2);
          
     echo "<table>";
     echo $html->tableCells($lines8);
     echo "</table>";
     echo "</fieldset>";

     echo "</div>";

     echo $form->end(__('Save',true)); 

     }	else {

      echo "<h1>".__("Invalid page.",true)."</h1>";

      }

?>

