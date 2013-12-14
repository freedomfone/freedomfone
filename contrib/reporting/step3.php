<?php
/*
 * Wizard page 2 - Detect CSV Properties
 */
 

 
//Import needed scripts

include 'includes/vars.php';
include 'includes/functions.php';
include 'includes/validateSession.php';

//Get Filtered Dates from defined values
getFilterDates();
$filteredReport = $_SESSION['filteredReport'];
$granularity = $_SESSION['granularity'];
if($granularity =="daily"){
	$xAxisLabel = "Day of Month";
}elseif($granularity=="weekly"){
	$xAxisLabel = "Week number of Year";
}else{
	$xAxisLabel = "Month of Year";
}
$reportType = $_SESSION['reportType'];
$reports=array();

$type="byTitle";
if(isset($_GET['type']))
	$type=$_GET['type'];

$selected = "1";
if(isset($_GET['selected']))
	$selected=$_GET['selected'];

$cumulative=true;
if(isset($_GET['cumulative']))
	$cumulative=$_GET['cumulative'];
	
$typeName = "Cumulative_Menus";
if(isset($_GET['name']))
	$typeName = $_GET['name'];

if($type=='unique'){
	$series = getGraphScript($filteredReport, "byUnique", $reportType, $cumulative, $_SESSION['title'], $granularity);
}else if($type=='callLength'){
	$series = getGraphScript($filteredReport, "byCallLength", $reportType, $cumulative, $_SESSION['title'], $granularity);
}else{
	$series = getGraphScript($filteredReport, "byTitle", $reportType, $cumulative, $_SESSION['title'], $granularity);
}

$seriesKeyString = $series[0];
$seriesValueArray = $series[1];
$reportByTitle = $series[2];
$seriesCount = $series[3];
$csvFileName = $series[4];


$stats = getStats($filteredReport);


$totalSeconds = array_sum($stats['durations']);
$days=0;
$hours=0;
$mins=0;
$seconds=0;
$minFlag = false;
$hourFlag=false;
$dayFlag=false;
$seconds = $totalSeconds;

if($totalSeconds>60){
	$minFlag = true;
	$mins = floor($totalSeconds / 60);
	$seconds = $totalSeconds % 60;
}
if($mins >60){
	$hourFlag=true;
	$hours = floor($mins / 60);
	$mins = $mins % 60;
}
if($hours>24){
	$dayFlag=true;
	$days = floor($hours/24);
	$hours = $hours % 24;
}

$totalTimeString = $seconds."s";
if($minFlag)
	$totalTimeString = $mins."m ".$totalTimeString;
if($hourFlag)
	$totalTimeString = $hours."h ".$totalTimeString;
if($dayFlag)
	$totalTimeString = $days."d ".$totalTimeString;
	

?>

<?php
include 'includes/head.php';
?>

<script>
	$(document).ready(function(){
	<?php 
	
		echo("ticks = ".$seriesKeyString.";");
	
	?>
	plot2 = $.jqplot('chartdiv', [<?php 
			foreach ($seriesValueArray as $series) { 
				echo $series.", ";
			}												
			?>], {
			legend:{
				show:true, 
				location:'nw',
				<?php
				if($typeName=="Call_Length"){
					echo "labels:";
					print_r($seriesKeyString);
				}
				?>
			},							 
			title:'<?php 
			echo($_SESSION['title']);
			switch ($typeName) {
				case "Cumulative_Menus":
					echo ": Cumulative Menus";
					break;
				case "Menus_by_Month":
					echo ": Unique Menus";
					break;
				case "Unique_Vs_Total_by_Month":
					echo ": Unique Vs Total";
					break;
				case "Cumulative_Unique_Vs-Total":
					echo ": Cumulative Unique Vs Total";
					break;
				case "Call_Length":
					echo ": Call Length";
					break;
			}
			echo(" (".$_SESSION['fromDate']." - ".$_SESSION['toDate'].")");
			
			?>',
			seriesColors: [ "#4bb2c5", "#c5b47f", "#EAA228", "#579575", "#839557", "#958c12",
        "#953579", "#4b5de4", "#d8b83f", "#ff5800", "#0085cc"],
			<?php
				if($typeName=="Call_Length"){
			?>
				seriesDefaults: {
					// Make this a pie chart.
					renderer: jQuery.jqplot.PieRenderer, 
					rendererOptions: {
						// Put data labels on the pie slices.
						// By default, labels show the percentage of the slice.
						showDataLabels: true
					}
				}
			<?php
			}else{
			?>
			highlighter: {
        show: true,
				tooltipAxes: 'y',
        sizeAdjust: 7.5
      },
			seriesDefaults: { 
        showMarker:true,
        pointLabels: { 
					show:true,
					stackedValue:true
				} 
      },
			axes:{
					yaxis:{
						min:0,
						tickOptions:{ 
							formatString:'%.0f' 
						},
						autoscale:true,

					}, 
					xaxis:{
							<?php

								echo("ticks:ticks, renderer:$.jqplot.CategoryAxisRenderer,");
							
							?>
							
							tickRenderer: $.jqplot.CanvasAxisTickRenderer ,
							tickOptions: {
								fontSize: '10pt',
								angle: -90
							},
							label:'<?php echo($xAxisLabel); ?>'
					}
			},		
			series:[
			<?php 
			foreach ($reportByTitle as $seriesKey => $seriesValue) { 
				echo "{label:'".$seriesKey."'},";
			}												
			?>				
			],
			
			<?php
			}
			?>
									 
	});
	
		$("span.getImg").click(function(){
			saveAsPNG('<?php echo($_SESSION['title']);?>', '<?php echo($typeName); ?>');
		});

	});
	
	
	</script>
<div class="options"><span class="getCSV"><a href="<?php echo $csvFileName; ?>"><img src="images/csv_icon.png" /></a></span>  <span class="printGraph"><img src="images/print_icon.png" /></span>  <span class="getImg"><img src="images/download_icon.png" /></span></div>
<div class="content">
	<div class="report">

  <div class="reportBody">
  	<div class="atAGlance">
    	<h2>At a Glance</h2>
			<div class="statRow"><div class="stat"><?php echo sizeof($filteredReport); ?></div><div class="statLabel"> Total Calls</div></div>
      <div class="statRow"><div class="stat"><?php echo sizeof($stats['callers']); ?></div><div class="statLabel"> Unique Callers</div></div>
      <div class="statRow"><div class="stat"><?php echo $totalTimeString ?></div><div class="statLabel"> Total</div></div>
      <div class="statRow"><div class="stat"><?php 
				if(sizeof($filteredReport)>0){
					 $ave=  array_sum($stats['durations']) / sizeof($filteredReport); 
					 $secs = round($ave);
					 echo ($secs ."s");
				}else{
					echo "0";
				}
      ?></div>
      <div class="statLabel"> Ave. Call Length</div></div>
      <div class="buttons">
        <div class="button <?php if($selected=="1") echo"selected"; ?>" title="Cumulative calls to menus between selected dates"><a href="step3.php?type=menu&cumulative=true&selected=1&name=Cumulative_Menus">Cumulative Menus</a></div>
        <div class="button <?php if($selected=="2") echo"selected"; ?>" title="Calls to menus between selected dates by month"><a href="step3.php?type=menu&cumulative=false&selected=2&name=Menus_by_Month">Unique Menus</a></div>
        <div class="button <?php if($selected=="3") echo"selected"; ?>" title="Unique Calls Vs Total Calls to Freedom Fone, month by month"><a href="step3.php?type=unique&cumulative=false&selected=3&name=Unique_Vs_Total_by_Month">Unique Vs Total</a></div>
        <div class="button <?php if($selected=="4") echo"selected"; ?>" title="Unique Calls Vs Total Calls to Freedom Fone, Cumulative over selected duration"><a href="step3.php?type=unique&cumulative=true&selected=4&name=Cumulative_Unique_Vs-Total">Cumulative Unique Vs Total</a></div>
        <div class="button <?php if($selected=="5") echo"selected"; ?>" title="Number of calls sorted by call duration"><a href="step3.php?type=callLength&selected=5&name=Call_Length">Call Length</a></div>
        <div class="button startAgain" title="Start A New Report"><a href="step1.php"><img src="images/refresh.png" class="refreshIcon"/>Start Again</a></div>
      </div>

      
    </div>
   
    <div class="graph">
          	<div id="chartdiv" style="height:500px;width:610px; "></div>
    </div>
  </div>
</div>
  </div>
 <script>
  $(document).ready(function() {

	<?php
	for($i=0; $i<$seriesCount; $i++){
	?>
		var topVal=new Array();
	 $('.jqplot-point-<?php echo $i; ?>').each(function () {
			var position = $(this).position();
			var that = $(this);
			jQuery.each(topVal, function() {
																	 var valMin = position.top -8;
																	 var valMax = position.top +8;
																	
				if (this < valMax && this > valMin){
					that.css('top', position.top - 12);
				}
				
			});
			topVal.push(position.top);
	 });
	 <?php
	}
	?>
 });

 </script>
<?php
include 'includes/footer.php';
?>
