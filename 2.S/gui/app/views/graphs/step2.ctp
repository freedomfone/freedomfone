<?php
echo '<div id="header">';
echo '<div class="logo">';
echo $this->Html->image('images/ff-banner.gif', array('alt' => 'Freedom Fone'));
echo '</div>';
echo '<div class="title">Reporting</div>';
echo "</div>";
echo '<div id="body">'; 
?>


<div class="content">
<form action="step2" method="post">
<div class="step">Now lets select the data you wish to use...</div>

<?php
//If form threw an error, display
if($hasErrors)
	echo $error;
?>
<div class='formRow'>
  <div class="label">
    <label>Select the the menu</label> 
  </div>
  <div class="input">
		<?php
    //Iterate through array and get titles

    foreach ($titleArray as $title) { 
			echo("<div class='formRow'><input type='checkbox' value='". seoString($title) ."' name='menus[]' class='menu' checked='checked'/>$title</div>");
		}	
		?>
  </div>
</div>


<div class='formRow'>
  <div class="label">
    <label>From:</label> 
  </div>
  <div class="input dateInputRange">
    <input value="<?php echo date('Y-m-d',$earliest) ?>" type="text" name="fromDate" id="fromDate" class="dateRange" />	<label>to</label> <input value="<?php echo date('Y-m-d',$GLOBALS['to']); ?>"type="text"  name="toDate" id="toDate" class="dateRange"/>	
  </div>
</div>

<div class="step">Tell me a little about the Data...</div>
<div class='formRow'>
  <div class="label">
    <label>Report on Menus (IVR)</label> 
  </div>
  <div class="input">
    <input value="IVR"type="radio"  name="reportType" id="reportType"/>
  </div>
</div>
<div class='formRow'>
  <div class="label">
    <label>Report on Messages (LAM)</label> 
  </div>
  <div class="input">
    <input value="LAM"type="radio"  name="reportType" id="reportType"/>
  </div>
</div>
<div class='formRow'>
  <div class="label">
    <label>Granularity</label> 
  </div>
  <div class="input">
  	<div class="monthly grainy"><input type="radio" name="granularity" value="monthly" /> Monthly</div>
    <div class="weekly grainy"><input type="radio" name="granularity" value="weekly" /> Weekly</div>
    <div class="daily grainy"><input type="radio" name="granularity" value="daily" /> Daily</div>
  </div>
</div>

<div class="step">and finally, provide a report title...</div>
<div class='formRow'>
  <div class="label">
    <label>Title</label> 
  </div>
  <div class="input">
    <input type="text"  name="title" id="title"/>
  </div>
</div>

<div class="formRow">
  <div class="input"><input type="hidden" name="hidden" value="true" /><button type="submit" value="submit">Generate Report</button></div>  
</div>


</form>

</div>
<script>

//Display Date Picker
$(function() {
	$( "#fromDate" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: '0', defaultDate: "-3m" });	
});
$(function() {
	$( "#toDate" ).datepicker({ dateFormat: 'yy-mm-dd', maxDate: '0', defaultDate: "0" });
});
</script>
<?php
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
    
echo '</div>';
echo '</div>'; 
?>




