<?php
//Function to set the Filter Dates
function getFilterDates(){
	if(isset($_POST['fromDate']) && $_POST['fromDate']!="" && isset($_POST['toDate'])&&$_POST['toDate']!=""){
		$GLOBALS['from'] = strtotime($_POST['fromDate']);
		$GLOBALS['to'] = strtotime($_POST['toDate']);
	}else{
		$GLOBALS['to'] = time();
		$GLOBALS['from'] = time() - (90 * 24 * 60 * 60);
	}
}
//Function to sory array by Date
function date_compare($a, $b)
{
		
		$t1 = strtotime($a[$GLOBALS['dateColumn']]);
    $t2 = strtotime($b[$GLOBALS['dateColumn']]);
    return $t1 - $t2;
}    

//Create an array of Call Durations from an Call Log Array
function callDurations($dateArray){
	$dArray = array();
	foreach ($dateArray as $call) {  
		array_push($dArray, $call[$GLOBALS['durationColumn']]);
	}
	return $dArray;
}

//Create an array of unique Callers from an Call Log Array
function getUniqueCallers($dateArray){
	$dArray = array();
	foreach ($dateArray as $call) {  
		$caller = $call[$GLOBALS['callersColumn']];
		if(!in_array($caller, $dArray)){	
			array_push($dArray, $caller);
		}					
	}
	return $dArray;
}

//Create an array of unique Callers from an Call Log Array
function filterByMenu($dateArray, $menus){
	$dArray = array();
	foreach ($dateArray as $call) {  
		$menu = $call[$GLOBALS['titleColumn']];
		if(in_array(seoString($menu), $menus)){	
			array_push($dArray, $call);
		}					
	}
	return $dArray;
}

//Create an array of unique Callers from an Call Log Array
function getTitles($dateArray){
	$dArray = array();
	foreach ($dateArray as $call) {  
		$title = $call[$GLOBALS['titleColumn']];
		if(!in_array($title, $dArray)){	
			array_push($dArray, $title);
		}					
	}
	return $dArray;
}

//Create an array based on a Filter on Caller Log Array between dates
function filter_dates($from, $to, $dateArray){
	$fArray = array();
	foreach ($dateArray as $call) {  
		$callDate = $call[$GLOBALS['dateColumn']];
		if(check_in_range($from, $to, $callDate)){
			array_push($fArray, $call);			
		}
	}
	return $fArray;
}  

//Checks to see if a date lies between a range of dates
function check_in_range($start_ts, $end_ts, $date_from_array){
  // Convert to timestamp
  $user_ts = strtotime($date_from_array);
	$start_ts = strtotime($start_ts);
	$end_ts = strtotime($end_ts);
	if ($start_ts <= $user_ts && $user_ts <= $end_ts) {
     return true;
	} else {
		return false;
	}
}

//Gets the CSV File
function getCSV($file){
	$reportArray = array();
	$lineCount = 0;
	
	while (!feof($file) ) {
		$line_of_text = fgetcsv($file, 1024);
		if($lineCount>0 && $line_of_text[$GLOBALS['dateColumn']]!=null){
			array_push($reportArray, $line_of_text);
		}
		$lineCount++;
	}
	fclose($file);
	usort($reportArray, 'date_compare');
	return $reportArray;
}

//Gets the earliest date in the log
function getEarliestDate($array){
	$dates['earliest'] = strtotime('+1 week');
	$dates['latest'] = 0;
	foreach ($array as $call) {  
		$callDate = strtotime($call[$GLOBALS['dateColumn']]);
		if($callDate < $dates['earliest']){
			$dates['earliest']=$callDate;
		}
		if($callDate > $dates['latest']){
			$dates['latest']=$callDate;
		}
	}
	return $dates;
}

function splitDates($dateFrom, $dateTo, $granularity){
	$brokenArray =array();
	if($granularity=="daily"){
		while ($dateFrom<=$dateTo) {
			$dateFromM = date('d-M',$dateFrom);
			if(!array_key_exists($dateFromM, $brokenArray)){
				$brokenArray[$dateFromM] = 0;
			}

			$dateFrom = strtotime('+1 day',$dateFrom);
		}
	}elseif($granularity=="weekly"){
		while ($dateFrom<=$dateTo) {
			$dateFromM = date('W',$dateFrom);
			if(!array_key_exists($dateFromM, $brokenArray)){
				$brokenArray[$dateFromM] = 0;
			}
			
			$dateFrom = strtotime('+1 week',$dateFrom);
		}
	}else{
		while ($dateFrom<=$dateTo) {
			$dateFromM = date('M-Y',$dateFrom);
			if(!array_key_exists($dateFromM, $brokenArray)){
				$brokenArray[$dateFromM] = 0;
			}
			$dateFrom = strtotime($dateFromM);
			$dateFrom = strtotime('+1 month',$dateFrom);
		}
		
	}
	return $brokenArray;
	
	
}
function splitDataByDates($dateArray, $titleCompare, $granularity, $cumulative, $brokenArray){
	if($granularity=="daily"){
		$dateSplitter = "d-M";
	}elseif($granularity=="weekly"){
		$dateSplitter = "W";
	}else{
		$dateSplitter = "M-Y";
	}
	
	$callerTotal = 0;
	foreach ($dateArray as $call) {  
		$title = $call[$GLOBALS['titleColumn']];
		
		
		if($titleCompare==''||$title==$titleCompare){
			$callDate = $call[$GLOBALS['dateColumn']];
			$theDate = date($dateSplitter, strtotime($callDate));
			$callerTotal++;
			if($cumulative=='true'){
				//Cumulative Data
				$brokenArray[$theDate] = $callerTotal;
			}else{
				//Monthly Data
				$brokenArray[$theDate] ++;
			}
			
		}
	}
	return $brokenArray;
}
	

//Break report down into groupings of Months/Day of Months/Dates
function getBrokenReport($dateArray, $granularity, $titleCompare='', $cumulative){
	$dateFrom =  strtotime($_SESSION['fromDate']);
	$dateTo = strtotime($_SESSION['toDate']);
	$brokenArray = splitDates($dateFrom, $dateTo, $granularity);
	$brokenArray = splitDataByDates($dateArray, $titleCompare, $granularity, $cumulative, $brokenArray);
	if($cumulative=='true'){
		$zeroValue = true;
		$largestValue = 0;
		foreach($brokenArray as $key => $value){
			if($value>$largestValue)
				$largestValue=$value;
			if($value>0)
				$zeroValue=false;
			if($value==0 && !$zeroValue)
				$brokenArray[$key]=$largestValue;
		}
	}
	return $brokenArray;
}

function seoString($string){
	$string = preg_replace("`\[.*\]`U","",$string);
	$string = preg_replace('`&(amp;)?#?[a-z0-9]+;`i','-',$string);
	$string = htmlentities($string, ENT_COMPAT, 'utf-8');
	$string = preg_replace( "`&([a-z])(acute|uml|circ|grave|ring|cedil|slash|tilde|caron|lig|quot|rsquo);`i","\\1", $string );
	$string = preg_replace( array("`[^a-z0-9]`i","`[-]+`") , "-", $string);
	return strtolower(trim($string, '-'));
}

function isValidDateTime($dateTime){
	if (preg_match("/^(\d{4})-(\d{2})-(\d{2})$/", $dateTime, $matches)) {
		if (checkdate($matches[2], $matches[3], $matches[1])) {
				return true;
		}
	}
	return false;
}

function sortArrayByTitle($array, $cumulative, $granularity){
	$titleArray = getTitles($array);
	foreach ($titleArray as $title) {  
		$reportByTitle[$title] = getBrokenReport($array, $granularity, $title, $cumulative);
	}
	return $reportByTitle;
}
function sortArrayByUnique($array, $cumulative, $granularity){
	$titleArray = getTitles($array);
	$reportByUnique['Uniques'] = getUniqueReport($array, $granularity, $cumulative);
	$reportByUnique['Total'] = getTotalsReport($array, $granularity, $cumulative);
	return $reportByUnique;
}
function sortArrayByLength($array, $type){
	$titleArray = getTitles($array);
	$reportByUnique['Call Length'] = getLengthReport($array, $type);
	return $reportByUnique;
}
function getGraphScript($array, $type, $reportType, $cumulative, $reportTitle, $granularity){
	$report = array();
	if($type=="byTitle"){
		$report = sortArrayByTitle($array, $cumulative, $granularity);
	}else if($type=="byCallLength"){
		$report = sortArrayByLength($array, $reportType);
	}else{
		$report = sortArrayByUnique($array, $cumulative, $granularity);
	}
		
	$seriesValueArray = array();
	$seriesKeyArray = array();
	$seriesKeyString="[";
	$seriesCount = 0;
	foreach ($report as $series) { 
		$seriesValueString="[";
		$seriesCount =  count($series);
		foreach ($series as $key => $value) { 

				$seriesValueString .= "".$value.",";
				if (strpos($seriesKeyString,"'".$key."'") == false) {
					$seriesKeyString .= "'".$key."',";
					array_push($seriesKeyArray, $key);
				}
			
			
		}
		$seriesValueString.="]";
		
		array_push($seriesValueArray, $seriesValueString);
	}
	$seriesKeyString.="]";
	$series[0] = $seriesKeyString;
	$series[1] = $seriesValueArray;
	$series[2] = $report;
	$series[3] = $seriesCount;
	$series[4] = saveCSV($report, $seriesKeyArray, $reportTitle);
	
	return $series;
}
function saveCSV($report, $seriesKeyArray, $reportTitle){
	//Store to csv
	$csv = array();
	$csvFileName = 'upload/'.$reportTitle.'-'.date('Ymd-his').'.csv';
	foreach ($report as $seriesKey => $seriesValue) { 
		$data = $seriesValue;
		array_unshift($data, $seriesKey);
		array_push($csv, $data);
	}	
	array_unshift($seriesKeyArray, "");
	array_unshift($csv, $seriesKeyArray);
	
	$fp = fopen($csvFileName, 'w');
	foreach ($csv as $fields) {
    fputcsv($fp, $fields);
	}
	fclose($fp);
	
	return $csvFileName;
}
	
	

function getStats($array){
	$stats = array();
	$stats['callers'] = getUniqueCallers($array);
	$stats['durations'] = callDurations($array);
	return $stats;
	
}




//Break report down into groupings of Months/Day of Months/Dates
function getUniqueReport($dateArray, $granularity, $cumulative){
	$dateFrom =  strtotime($_SESSION['fromDate']);
	$dateTo = strtotime($_SESSION['toDate']);
	$brokenArray = splitDates($dateFrom, $dateTo, $granularity);
	
	if($granularity=="daily"){
		$dateSplitter = "d-M";
	}elseif($granularity=="weekly"){
		$dateSplitter = "W";
	}else{
		$dateSplitter = "M-Y";
	}
	
	$callerArray = array();
	$callerTotal = 0;
	foreach ($dateArray as $call) {  
		$caller = $call[$GLOBALS['callersColumn']];	
		if(!in_array($caller,$callerArray)){
			$callerTotal++;
			$callerArray[]=$caller;
			$callDate = $call[$GLOBALS['dateColumn']];
			$theDate = date($dateSplitter, strtotime($callDate));
			if($cumulative=='true'){
				//Cumulative Data
				$brokenArray[$theDate] = $callerTotal;
			}else{
				//Monthly Data
				$brokenArray[$theDate] ++;
			}
			
		}
	}
	if($cumulative=='true'){
		$zeroValue = true;
		$largestValue = 0;
		foreach($brokenArray as $key => $value){
			if($value>$largestValue)
				$largestValue=$value;
			if($value>0)
				$zeroValue=false;
			if($value==0 && !$zeroValue)
				$brokenArray[$key]=$largestValue;
		}
	}
	return $brokenArray;
}

//Break report down into groupings of Months/Day of Months/Dates
function getTotalsReport($dateArray, $granularity, $cumulative){
	$dateFrom =  strtotime($_SESSION['fromDate']);
	$dateTo = strtotime($_SESSION['toDate']);
	$brokenArray = splitDates($dateFrom, $dateTo, $granularity);
	
	if($granularity=="daily"){
		$dateSplitter = "d-M";
	}elseif($granularity=="weekly"){
		$dateSplitter = "W";
	}else{
		$dateSplitter = "M-Y";
	}
	
	$callerTotal = 0;
	foreach ($dateArray as $call) {  
		$caller = $call[$GLOBALS['callersColumn']];	
		$callerTotal++;
		$callerArray[]=$caller;
		$callDate = $call[$GLOBALS['dateColumn']];
		$theDate = date($dateSplitter,strtotime($callDate));
		
		if($cumulative=='true'){
			//Cumulative Data
			$brokenArray[$theDate] = $callerTotal;
		}else{
			//Monthly Daya
			$brokenArray[$theDate] ++;
		}
		
		
	}
	if($cumulative=='true'){
		$zeroValue = true;
		$largestValue = 0;
		foreach($brokenArray as $key => $value){
			if($value>$largestValue)
				$largestValue=$value;
			if($value>0)
				$zeroValue=false;
			if($value==0 && !$zeroValue)
				$brokenArray[$key]=$largestValue;
		}
	}
	return $brokenArray;
}





//Break report down into groupings of Months/Day of Months/Dates
function getLengthReport($dateArray, $type){
	
	$brokenArray = array();
	if($type=="LAM"){
		$brokenArray = array("0-4s" => 0, "5-10s" => 0, "11-30s" => 0, "31-60s" => 0, "61s+" => 0);
	}else{
		$brokenArray = array("0-15s" => 0, "16-30s" => 0, "31-60s" => 0, "61-90s" => 0, "91s+" => 0);
	}
	foreach ($dateArray as $call) {  
		$length = intval($call[$GLOBALS['durationColumn']]);	
		if($type=="LAM"){
			if($length <=4){
				$brokenArray['0-4s']=$brokenArray['0-4s']+1;
			}else if($length >=5 && $length<=10){
				$brokenArray['5-10s']=$brokenArray['5-10s']+1;
			}else if($length >=11 && $length<=30){
				$brokenArray['11-30s']=$brokenArray['11-30s']+1;
			}else if($length >=31 && $length<=60){
				$brokenArray['31-60s']=$brokenArray['31-60s']+1;
			}else if($length >=61 ){
				$brokenArray['61s+']=$brokenArray['61s+']+1;
			}
		}else{
			if($length <=15){
				$brokenArray['0-15s']=$brokenArray['0-15s']+1;
			}else if($length >=16 && $length<=30){
				$brokenArray['16-30s']=$brokenArray['16-30s']+1;
			}else if($length >=31 && $length<=60){
				$brokenArray['31-60s']=$brokenArray['31-60s']+1;
			}else if($length >=61 && $length<=90){
				$brokenArray['61-90s']=$brokenArray['61-90s']+1;
			}else if($length >=91 ){
				$brokenArray['91s+']=$brokenArray['91s+']+1;
			}
		}
	
	}
	return $brokenArray;
}

?>