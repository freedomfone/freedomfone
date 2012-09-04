<?php 


echo '<div id="header">';
echo $this->Html->image('images/ff-banner.gif', array('alt' => 'Freedom Fone'));
echo $this->Html->div('title','Reporting');
echo "</div>";

echo '<div id="body">';

echo '<div class="content">';
echo $this->Form->create("graphs", array( 'type'=> "post", 'action' => 'index', 'enctype' => "multipart/form-data"));
echo $this->Html->div('step','Let us get started by uploading the log file you wish to generate the report on...');

    
echo '<div class="formRow">';
echo '<div class="label"><label for="file">Filename:</label></div>';
echo '<div class="input"><input type="file" name="file" id="file" /></div>'; 
echo '<div class="buttons"><input type="hidden" name="hidden" value="true" /><button type="submit" value="submit">Upload</button></div>' ;
echo $this->Form->end();
echo "</div>"; 
echo "</div>";
echo '</div>';
echo '<div id="footer">	Developed by <a href="http://www.mstance.com" target="_blank">MStance</a> for <a href="http://www.freedomfone.org" target="_blank">Freedom Fone</a><div id="downloadLink">';
echo '<a href="reporting.zip">';
echo $this->Html->image('images/download-project.png', array('alt' => 'Download'));
echo '</a></a>';
echo '</div>';
echo '<div id="version">';
echo '<span class="versionNumber">Version: </span>';
echo '<a href="http://mstance.com/svn/repos/clients/freedomfone/projects/reporting/tags/">';
echo('Version: 0.1.1' );
echo '</a>';    
 
?>




