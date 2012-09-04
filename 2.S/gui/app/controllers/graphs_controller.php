/****************************************************************************
 * graphs_controller.php		- Controller for producing graphs from 
 *                                         csv exports from CDR
 * version 		 	- 3.0.1700
 * 
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 *
 * This Code was initially done by Olaf Dunn <olaf@mstance.com>
 *  in php and later redone in CakePHP
 * and intergrated into Freedom Fone by Tichafara Sigauke 
 *  <tichsig@gmail.com>
 * 
 *
 *
 ***************************************************************************/

<?php



class GraphsController extends AppController{

      var $name = 'Graphs';
      var $helpers = array('Js','Ajax','Session','Text');

      public function beforeFilter(){
      parent::beforeFilter();
      $this->Auth->allow('index');
      $this->Auth->allow('step2');
      $this->Auth->allow('step3');
      $this->Auth->allow('step4');
      }


      function index(){
         include 'includes/vars.php';
	 include 'includes/functions.php';
	 $this->layout = 'graph';
		//Page Variables
	 $this->pageTitle = "Freedom Fone Reporting - Step 1";

		//Handle File Upload
	 if(isset($_POST['hidden'])){
		$begin=false;
		$_SESSION['sessionid'] = session_id();
		
		//Check if file is of correct format (CSV)
		if ($_FILES["file"]["type"] == "text/csv" || $_FILES["file"]["type"] =="application/vnd.ms-excel" ||      		     $_FILES["file"]["type"] == "plain/text"){
			//Ensure that there is no error importing file
			if ($_FILES["file"]["error"] > 0){
				$error .= "<div class='error'>Problem reading file: " . $_FILES["file"]["error"] . "</div>";
				$hasErrors = true;
				//Sucess, move file to upload directory
			}else{
				move_uploaded_file($_FILES["file"]["tmp_name"],
				$uploadPath);
				$file_handle = $uploadPath;
                                $this->Session->write('file_hande', $uploadPath);
				
				//Store file name to session for use later
				$_SESSION['file'] =  $uploadPath;
				
				
			}
		}else{
			$error .= "<div class='error'>Invalid file, please use a CSV file</div>";
			$hasErrors = true;
		}										 
	}else{
		
		$begin=true;
		
	}
	//Redirect user if form is valid
	if(!$hasErrors && !$begin){
	$this->redirect(array('action' => 'step2'));
	
	}

}

    function step2(){

	   include 'includes/vars.php';
	   include 'includes/functions.php';
           $this->layout = 'graph';
    	   $this->pageTitle = 'Freedom Fone Reporting - Step 2';
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
		
                $this->redirect(array('action' => 'step3'));

	}	

     }  
	   $report = getCSV($file_handle = fopen($file, "r"));
	    //$report = getCSV($file_handle = fopen($file, "r"));

	    $titleArray = getTitles($report);

	    $dates = getEarliestDate($report);
	    $earliest = $dates['earliest'];
	    $latest = $dates['latest'];

            $_SESSION['report'] =  $report;
            getFilterDates();
	    $this->set(compact('report','titleArray','dates','earliest','latest','hasErrors','error'));	
		
				

		
}




 function step3(){

	include 'includes/vars.php';
	include 'includes/functions.php';
	include 'includes/validateSession.php';
	$this->layout = 'graph';


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
	
       $this->set(compact('stats','filteredReport','csvFileName','totalTimeString','selected','seriesKeyString','seriesValueArray','typeName','reportByTitle','seriesCount','xAxisLabel'));
	
     }
   
   
 function step4(){

	include 'includes/vars.php';
	include 'includes/functions.php';
	include 'includes/validateSession.php';
        $this->layout = 'graph';

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
	
     $this->set(compact('stats','filteredReport','csvFileName','totalTimeString','selected','seriesKeyString','seriesValueArray','typeName','reportByTitle','seriesCount','xAxisLabel'));
	
     }
   
   
}



?>
