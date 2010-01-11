<?php

if($this->data){

$lm_settings = Configure::read('LM_SETTINGS');
$lm_default  = Configure::read('LM_DEFAULT');

echo "<h1>".__("Create Leave a Message IVR",true)."</h1>";

        if($session->check('Message.flash')){
                  $session->flash();
		}  

echo "<div class ='instruction'>".__("Please upload a .wav audio file for each of the eight messages. If no audio file is present, the fallback text will be used in the Leave-a-Message IVR. You can listen to your uploaded audio files by pressing the Play button.",true)."</div>";
  	


$commentWelcome  = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmWelcomeMessage']."</div>";
$commentInform   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmInformMessage']."</div>";
$commentInvalid  = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmInvalidMessage']."</div>";
$commentLong     = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmLongMessage']."</div>";
$commentSelect   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSelectMessage']."</div>";
$commentDelete   = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmDeleteMessage']."</div>";
$commentSave     = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmSaveMessage']."</div>";
$commentGoodbye  = "<div class='formComment'>".__("Default",true).': '.$lm_default['lmGoodbyeMessage']."</div>";


echo $form->create('LmMenu', array('type' => 'post', 'action' => 'settings','enctype' => 'multipart/form-data') );
$path = $lm_settings['path'].IID."/".$lm_settings['dir_menu'];
echo $form->hidden('id');

?>

<fieldset>
<legend><?php __('Step 1: Welcome message');?> </legend>
<?php echo $form->input('LmMenuFile.lmWelcome', array('between'=>'<br />','type'=>'file','size'=>'50','label'=>'Audio file','after'=> $this->element('musicplayer_button',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmWelcome.mp3','title'=>'Welcome Message')))); ?>
<?php echo $form->input('lmWelcomeMessage',array('type'=>'text','size' => '75','label'=>'Fallback text','after' => $commentWelcome,'between'=>'<br />' )); ?>
</fieldset>


<fieldset>
<legend><?php __('Step 2: Inform message');?> </legend>
<?php echo $form->input('LmMenuFile.lmInform', array('between'=>'<br />','type'=>'file','label'=>'Audio file','after'=>$this->element('musicplayer_button',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmInform.mp3','title'=>'Inform Message')))); ?>
<?php echo $form->input('lmInformMessage',array('type'=>'text','size' => '75','label'=>'Fallback text','after' => $commentInform,'between'=>'<br />' )); ?>
</fieldset>


<fieldset>
<legend><?php __('Step 3: Invalid message');?> </legend>
<?php echo $form->input('LmMenuFile.lmInvalid', array('between'=>'<br />','type'=>'file','label'=>'Audio file','after'=>$this->element('musicplayer_button',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmInvalid.mp3','title'=>'Invalid Message')))); ?>
<?php echo $form->input('lmInvalidMessage',array('type'=>'text','size' => '75','label'=>'Fallback text','after' => $commentInvalid,'between'=>'<br />' )); ?>
</fieldset>



<fieldset>
<legend><?php __('Step 4: Long message');?> </legend>
<?php echo $form->input('LmMenuFile.lmLong', array('between'=>'<br />','type'=>'file','label'=>'Audio file','after'=>$this->element('musicplayer_button',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmLong.mp3','title'=>'Long Message')))); ?>
<?php echo $form->input('lmLongMessage',array('type'=>'text','size' => '75','label'=>'Fallback text','after' => $commentLong,'between'=>'<br />' )); ?>
</fieldset>

<fieldset>
<legend><?php __('Step 5: Select message');?> </legend>
<?php echo $form->input('LmMenuFile.lmSelect', array('between'=>'<br />','type'=>'file','label'=>'Audio file','after'=>$this->element('musicplayer_button',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmSelect.mp3','title'=>'Select Message')))); ?>
<?php echo $form->input('lmSelectMessage',array('type'=>'text','size' => '75','label'=>'Fallback text','after' => $commentSelect,'between'=>'<br />')); ?>
</fieldset>

<fieldset>
<legend><?php __('Step 6: Delete message');?> </legend>
<?php echo $form->input('LmMenuFile.lmDelete', array('between'=>'<br />','type'=>'file','label'=>'Audio file','after'=>$this->element('musicplayer_button',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmDelete.mp3','title'=>'Delete Message')))); ?>
<?php echo $form->input('lmDeleteMessage',array('type'=>'text','size' => '75','label'=>'Fallback text','after' => $commentDelete,'between'=>'<br />')); ?>
</fieldset>

<fieldset>
<legend><?php __('Step 7: Save message');?> </legend>
<?php echo $form->input('LmMenuFile.lmSave', array('between'=>'<br />','type'=>'file','label'=>'Audio file','after'=>$this->element('musicplayer_button',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmSave.mp3','title'=>'Save Message')))); ?>
<?php echo $form->input('lmSaveMessage',array('type'=>'text','size' => '75','label'=>'Fallback text','after' => $commentSave,'between'=>'<br />')); ?>
</fieldset>


<fieldset>
<legend><?php __('Step 8: Goodbye message');?> </legend>
<?php echo $form->input('LmMenuFile.lmGoodbye', array('between'=>'<br />','type'=>'file','label'=>'Audio file','after'=>$this->element('musicplayer_button',array('host'=>$lm_settings['host'],'path'=>$path,'file'=>'lmGoodbye.mp3','title'=>'Goodbye Message')))); ?>
<?php echo $form->input('lmGoodbyeMessage',array('type'=>'text','size' => '75','label'=>'Fallback text','after' => $commentGoodbye,'between'=>'<br />' )); ?>
</fieldset>


<?php 
echo $form->end('Save'); 

}

	else {

   	 echo "<h1>".__("Invalid page.",true)."</h1>";
	}

