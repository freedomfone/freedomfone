<?php
/*
 * Wizard page 2 - Detect CSV Properties
 */
 

 
//Import needed scripts

include 'includes/vars.php';
include 'includes/functions.php';
//include 'includes/validateSession.php';


//Page Variables
$pageTitle = "Freedom Fone Reporting - Step 2";
$file = $_SESSION['file'];
	
if(isset($_POST['hidden'])){
	
	//Check to see if at least one menu has been selected
	if(!isset($_POST['menus'])){
		$error .= "<div class='error'>Please select at least one menu</div>";
		$hasErrors = true;
	}
	//Check to see if a type has been selected
	if(!isset($_POST['reportType'])){
		$error .= "<div class='error'>Please select a type of report</div>";
		$hasErrors = true;
	}
	//Check to see if date is valid
	$from = $_POST['fromDate'];
	if(!isValidDateTime($from)){
		$error .= "<div class='error'>Please enter a valid From Date (YYYY-MM-DD)</div>";
		$hasErrors = true;
	}
	$to = $_POST['toDate'];
	if(!isValidDateTime($to)){
		$error .= "<div class='error'>Please enter a valid To Date (YYYY-MM-DD)</div>";
		$hasErrors = true;
	}
	
	//Check to see if a Title has been provided
	if(!isset($_POST['title']) || $_POST['title']==""){
		$error .= "<div class='error'>Please provide a report title</div>";
		$hasErrors = true;
	}
	if(!$hasErrors){
		
		//Filter report by selected menus
		$report = filterByMenu($_SESSION['report'], $_POST['menus']);
		
		//Store type of Report
		$_SESSION['reportType'] =  $_POST['reportType'];
		
		//Store title of Report
		$_SESSION['title'] =  $_POST['title'];
		
		//Store from / to dates
		$_SESSION['toDate'] = $to;
		$_SESSION['fromDate'] = $from;
		
		//Store granularity
		$_SESSION['granularity'] = $_POST['granularity'];
		
		//Store the time this report was generated
		$timeNow = (string)time();
		$_SESSION['timeStarted'] =  $timeNow;
		

		//Filter report by selected dates
		$report = filter_dates($from, $to, $report);
		
		$_SESSION['filteredReport'] =  $report;
		
		//print_r($_SESSION['report']);
		//Everything ok, redirect
		header('Location: step3.php');
	}
}


//Get the CSV
//$report = getCSV(fopen("upload/".$file, "r"));
$report = getCSV($file_handle = fopen($file, "r"));

$titleArray = getTitles($report);

$dates = getEarliestDate($report);
$earliest = $dates['earliest'];
$latest = $dates['latest'];


$_SESSION['report'] =  $report;

//Get Filtered Dates from defined values
getFilterDates();

?>

<?php
include 'includes/head.php';
?>



<div class="content">
<form action="step2.php" method="post">
<div class="step">Now lets select the data you wish to use...</div>

<?php
//If form threw an error, display
if($hasErrors)
	echo $error;
?>
<div class='formRow'>
  <div class="label">
    <label>Select the the menu<?php if(sizeof($titleArray)>1) echo('s')?></label> 
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
include 'includes/footer.php';
?>
