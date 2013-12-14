<?php
/*
 * Wizard page 1 - Upload file and define contents (i.e. LAM or IVR)
 */
 
//Import needed scripts
include 'includes/vars.php';
include 'includes/functions.php';



//Page Variables
$pageTitle = "Freedom Fone Reporting - Step 1";

//Handle File Upload
	if(isset($_POST['hidden'])){
		$begin=false;
		$_SESSION['sessionid'] = session_id();
		
		//Check if file is of correct format (CSV)
		if ($_FILES["file"]["type"] == "text/csv" || $_FILES["file"]["type"] =="application/vnd.ms-excel" || $_FILES["file"]["type"] == "plain/text" || $_FILES["file"]["type"] == "application/octet-stream"){
			//Ensure that there is no error importing file
			$file_handle = fopen($_FILES["file"]["tmp_name"], "r");
			$line_of_text = fgets($file_handle, 1024);
			$formatError=false;
			if(strpos($line_of_text, "Year,Month,Day,Time,Title,Caller,Channel,Length")==0){
				$formatError = true;
			}
			if (($_FILES["file"]["error"] > 0) || $formatError){
				if($formatError){
					$error .= "<div class='error'>The file maybe in the incorrect format, please check and use a comma seperated file format (not tabs)</div>";
				}else{
					$error .= "<div class='error'>Problem reading file: " . $_FILES["file"]["error"] . "</div>";
				}
				$hasErrors = true;
				
			//Sucess, move file to upload directory
			}else{
				move_uploaded_file($_FILES["file"]["tmp_name"],
				$uploadPath ."". $_FILES["file"]["name"]);
				$file_handle = $uploadPath ."". $_FILES["file"]["name"];
				
				//Store file name to session for use later
				$_SESSION['file'] =  $uploadPath ."". $_FILES["file"]["name"];
				
				
			}
		}else{
			$error .= "<div class='error'>Invalid file, please use a CSV file (found ".$_FILES["file"]["type"]." )</div>";
			$hasErrors = true;
		}										 
	}else{
		session_destroy();
		session_start();
		$_SESSION = array();
		$begin=true;
		
	}
	//Redirect user if form is valid
	if(!$hasErrors && !$begin){
		header('Location: step2.php');
	}

?>

<?php
include 'includes/head.php';
?>


<div class="content">
  <form action="step1.php" method="post" enctype="multipart/form-data">
  <div class="step">Let's get started by uploading the log file you wish to generate the report on...</div>
    
    <?php
    //If form threw an error, display
    if($hasErrors && isset($_SESSION['sessionid']))
      echo $error;
    ?>
    <div class="formRow">
      <div class="label"><label for="file">Filename:</label></div>
      <div class="input"><input type="file" name="file" id="file" /></div> 
    </div>
    <div class="buttons"><input type="hidden" name="hidden" value="true" /><button type="submit" value="submit">Upload</button></div> 
  </form>
</div>

<?php
include 'includes/footer.php';
?>
