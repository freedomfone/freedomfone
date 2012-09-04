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
