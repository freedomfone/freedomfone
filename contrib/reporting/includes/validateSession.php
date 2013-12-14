 <?php
   //Has user started a valid session
 if(!isset($_SESSION['sessionid'])){
	header('Location: step1.php');
 }
 ?>