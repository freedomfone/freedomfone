<?php

//Handle File Upload
	define('UPLOAD_DIR', 'upload/');
	if(isset($_POST['img']) && isset($_POST['title']) && isset($_POST['type'])){
		
		$img = str_replace('data:image/png;base64,', '', $_POST['img']);
		$img = str_replace(' ', '+', $img);
		$data = base64_decode($img);
		$file = UPLOAD_DIR . $_POST['title'] . '_'.$_POST['type'].'.png';
		$success = file_put_contents($file, $data);
		echo $file;
	}else{
		echo "Error, could not retrieve image";
		
	}
	?>