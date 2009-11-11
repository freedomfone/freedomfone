<?php echo $this->element('menu_next',array('back_text'=>__('Poll',true),'back_link'=>'/functionality/poll','fwd_text'=>__('Voice Menu',true),'fwd_link'=>'/functionality/ivr','div'=>'frameRight')); ?>

<h1>Leave a message</h1>


<p>The Leave-a-Message service offers callers the option to call into Freedom Fone, and leave  their personal message. This may be a report, feedback, tip-off, response to a question, or perhaps a job application.</p>
<p>A caller using the Leave-a-message service is connected to a voice menu created by the Freedom Fone administrator. The voice menu greets the caller and provides instructions as to how to use the service.  The Leave-a-message service allows the caller to </p>

<ul>
<li>Record a message</li>
<li>Listen to their recorded message</li>
<li>Delete and record a new message OR</li>
<li>Save their message and exit</li>
</ul>

<?php echo $html->image('illustrations/FF_LAM_state_machine.png', array('alt' => 'CakePHP','border'=>0))?>

<p>By using the buttons # (hash), * (star), 0 (zero) and 1 (one), the user is able to navigate through the menu according to the illustration above.</p>


<h3>The Leave-a-message Voice Menu</h3>
<p>The Leave-a-message voice menu is created by the administrator. The menu consists of eight different messages. Each message can be generated in three different ways:</p>

<ol>
<li>Customized audio files</li>
<li>Customized text to speech</li>
<li>Default text to speech</li>
</ol>

<p>If the administrator associates an audio file with a message, that file will be played to the caller when she enters the voice menu.</p>
<p>If no audio file is provided for a message, but a customized text message exists, the text message will be synthesized and played to the caller.</p>
<p>If neither an audio file, nor a customized text is provided, the default text will be synthesized and played to the user.</p>
<p>The audio files must be uploaded in .wav format through the user interface. Once uploaded, they can be listened to from the administration GUI via the built-in Flashplayer. Audio files can at any time be overwritten with a new audio file.</p>

<h3>Received voice messages</h3>
<p>The Freedom Fone administrator receives all incoming messages to the “Inbox”. For each message, the administrator can</p>

<ul>
<li>listen to it (with a built-in Flashplayer)</li>
<li>name (give the message a title)</li>
<li>assign a category</li>
<li>associate the message with one or more tags</li>
<li>give the message a rating (1-5)</li>
</ul>

<p>The administrator can choose to delete a message, or to archive it for future use.</p>