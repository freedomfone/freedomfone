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
	
