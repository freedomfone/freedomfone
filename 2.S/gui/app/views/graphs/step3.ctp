<?php
echo '<div id="header">';
echo '<div class="logo">';
echo $this->Html->image('images/ff-banner.gif', array('alt' => 'Freedom Fone'));
echo '</div>';
echo '<div class="title">Reporting</div>';
echo "</div>";
echo '<div id="body">'; 
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
				location:'ne',
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
							 tickRenderer: $.jqplot.CanvasAxisTickRenderer,
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
		}); 
	
		$("span.getImg").click(function(){
			saveAsPNG('<?php echo($_SESSION['title']);?>', '<?php echo($typeName); ?>');			


   });
});
</script>	

<div class="options"><span class="getCSV"><a href="<?php echo $csvFileName; ?>"><?php echo $this->Html->image('images/csv_icon.png');?></a></span>  <span class="printGraph"><?php echo $this->Html->image('images/print_icon.png');?></span>  <span class="getImg"><?php echo $this->Html->image('images/download_icon.png');?></span></div>
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
        <div class="buttong <?php if($selected=="1") echo"selected"; ?>" title="Cumulative calls to menus between selected dates"><a href="step3?type=menu&cumulative=true&selected=1&name=Cumulative_Menus">Cumulative Menus</a></div>
        <div class="buttong <?php if($selected=="2") echo"selected"; ?>" title="Calls to menus between selected dates by month"><a href="step3?type=menu&cumulative=false&selected=2&name=Menus_by_Month">Unique Menus</a></div>
        <div class="buttong <?php if($selected=="3") echo"selected"; ?>" title="Unique Calls Vs Total Calls to Freedom Fone, month by month"><a href="step3?type=unique&cumulative=false&selected=3&name=Unique_Vs_Total_by_Month">Unique Vs Total</a></div>
        <div class="buttong <?php if($selected=="4") echo"selected"; ?>" title="Unique Calls Vs Total Calls to Freedom Fone, Cumulative over selected duration"><a href="step3?type=unique&cumulative=true&selected=4&name=Cumulative_Unique_Vs-Total">Cumulative Unique Vs Total</a></div>
        <div class="buttong <?php if($selected=="5") echo"selected"; ?>" title="Number of calls sorted by call duration"><a href="step4?type=callLength&selected=5&name=Call_Length">Call Length</a></div>
        <div class="buttong startAgain" title="Start A New Report">
<a href="index">
<?php echo $this->Html->image('images/refresh.png', array('class' => 'refreshIcon'));?>
Start Again</a>

</div>
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





  

