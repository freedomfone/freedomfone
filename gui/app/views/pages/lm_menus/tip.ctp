<?
Configure::write('debug', 0);

echo "<h1>".__('Leave-a-message', true)."</h1>";
echo "<p>".__('The Leave-a-message voice menu consists of eight different messages. Each message can be generated in three different ways:',true)."</p>";
echo "<ul>";
echo "<li>".__('Customized audio files',true)."</li>";
echo "<li>".__('Customized text to speech',true)."</li>";
echo "<li>".__('Default text to speech',true)."</li>";
echo "</ul>";

echo "<p>".__('If the administrator associates an audio file with a message, that file will be played to the caller when she enters the voice menu.',true)."</p>";
echo "<p>".__('If no audio file is provided for a message, but a customized text message exists, the text message will be synthesized and played to the caller.',true)."</p>";
echo "<p>".__('If neither an audio file, nor a customized text is provided, the default text will be synthesized and played to the user.|The audio files must be uploaded in .mp3 or .wav format through the user interface. Once uploaded, they can be listened to from the administration GUI via the built-in Flashplayer. Audio files can at any time be overwritten with a new audio file.',true)."</p>";


?>