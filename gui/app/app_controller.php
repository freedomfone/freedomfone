<?php
/* SVN FILE: $Id: app_controller.php 6311 2008-01-02 06:33:52Z phpnut $ */
/**
 * Short description for file.
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * PHP versions 4 and 5
 *
 * CakePHP(tm) :  Rapid Development Framework <http://www.cakephp.org/>
 * Copyright 2005-2008, Cake Software Foundation, Inc.
 *								1785 E. Sahara Avenue, Suite 490-204
 *								Las Vegas, Nevada 89104
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @filesource
 * @copyright		Copyright 2005-2008, Cake Software Foundation, Inc.
 * @link				http://www.cakefoundation.org/projects/info/cakephp CakePHP(tm) Project
 * @package			cake
 * @subpackage		cake.app
 * @since			CakePHP(tm) v 0.2.9
 * @version			$Revision: 6311 $
 * @modifiedby		$LastChangedBy: phpnut $
 * @lastmodified	$Date: 2008-01-01 22:33:52 -0800 (Tue, 01 Jan 2008) $
 * @license			http://www.opensource.org/licenses/mit-license.php The MIT License
 */
/**
 * Short description for class.
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		cake
 * @subpackage	cake.app
 */

App::import("Vendor", "ff_event", false, null, 'spooler_ff.php'); 
App::import("Vendor", "ESL", false, null, 'ESL.php'); 

App::import('Core','L10n');

class AppController extends Controller {

var $helpers = array('Html','Form','Ajax','Javascript','Session','Number','Time','Paginator','Formatting');




 function beforeFilter() {


 	  	date_default_timezone_set($this->Session->read('Config.timezone'));

    	     	$locale = Configure::read('Config.language');


     	     if ($locale && file_exists(VIEWS . $locale . DS . $this->viewPath)) {
		     	
			// e.g. use /app/views/fre/pages/tos.ctp instead of /app/views/pages/tos.ctp
			$this->viewPath = $locale . DS . $this->viewPath;
	      }

    }



/**
 * Source: http://www.jamesfairhurst.co.uk
 * uploads files to the server
 * @params:
 *		$folder 	= the folder to upload the files e.g. 'img/files'
 *		$formdata 	= the array containing the form files
 *		$itemId 	= id of the item (optional) will create a new sub folder
 * @return:
 *		will return an array with the success of each file upload
 */
function uploadFiles($folder, $data, $itemId = null, $filetype, $useKey, $overWrite) {


	// setup dir names absolute and relative
	$folder_url = WWW_ROOT.$folder;
	$rel_url = $folder;

	// create the folder if it does not exist
	if(!is_dir($folder_url)) {
		mkdir($folder_url);
	}
		
	// if itemId is set create an item folder
	if($itemId) {
		// set new absolute folder
		$folder_url = WWW_ROOT.$folder.'/'.$itemId; 
		// set new relative folder
		$rel_url = $folder.'/'.$itemId;
		// create directory
		if(!is_dir($folder_url)) {
			mkdir($folder_url);
		}
	}
	
	// list of permitted file types, this is only images but documents can be added

	$permitted=false;

	switch ($filetype){

	       case 'image':
	       	$permitted = array('image/gif','image/jpeg','image/pjpeg','image/png');
		break;	       

	       case 'file':
	       	$permitted = array('file/pdf','file/doc','file/odt','file/txt');
		break;	       

	       case 'mp3':
	       	$permitted = array('audio/mpeg','audio/mp3');
		$ext = 'mp3';
		break;	       

	       case 'wav':
	       	$permitted = array('audio/x-wav','audio/wav');
		$ext = 'wav';
		break;	       

	       case 'audio':
	       	$permitted = array('audio/mpeg','audio/x-wav','audio/wav','audio/mp3');
		break;	       


	}

	$result = array();

	// loop through and deal with the files
	foreach($data as $key =>$file) {


		// set filename
		if($useKey){
		    $ext = $this->getExt($file['name']); 
		    $filename = $file['fileName'].$ext;
		}
		
		else {
		     $filename = time().'_'.str_replace(' ', '_', $file['name']);
		}

		$result['files'][]=$filename;

		// assume filetype is false
		$typeOK = false;

		// check filetype is ok
		foreach($permitted as $type) {

			if($type == $file['type']) {
				$typeOK = true;
				break;
			}
		}		
				
		// if file type ok upload the file
		if($typeOK) 
			    {
			// switch based on error code
			switch($file['error']) {
	
				//NO ERROR
				case 0:
					// check filename already exists
					if(!file_exists($folder_url.$filename) || $overWrite) {
						// create full filename
						$full_url = $folder_url.$filename;
						$url = $rel_url.$filename;
						// upload the file
						$success = move_uploaded_file($file['tmp_name'], $url);

				
					} else {
						// create unique filename and upload file
						ini_set('date.timezone', 'Europe/London');
						$now = date('Y-m-d-His');
						$full_url = $folder_url.'/'.$now.$filename;
						$url = $rel_url.'/'.$now.$filename;
						$success = move_uploaded_file($file['tmp_name'], $url);
					}


					// if upload was successful
					if($success) {

						$old = umask(0);
						chmod($url, 0644);
						umask($old);

						// save the url of the file
						$result['urls'][] = $url;
					} else {
						$result['errors'][] = "The file could not be uploaded. Please contact the system administrator.";
						$this->log("Msg: ERROR; Action: file upload; Type: move_uploaded_file; Code: N/A","ivr");
											}
					break;
				case 1:
					// an error occured
					$result['errors'][] = "Error uploading $filename. The file is too large.";
					$this->log("Msg: ERROR; Action: file upload (".$filename."); Type: filesize php.ini; Code: ".$file['error'],"ivr");

					break;

				case 2:
					// an error occured
					$result['errors'][] = "Error uploading $filename. The file is too large.";
					$this->log("Msg: ERROR; Action: file upload (".$filename."); Type: filesize html; Code: ".$file['error'],"ivr");
					break;


				case 3:
					// an error occured
					$result['errors'][] = "Error uploading $filename. The file was only partially uploaded.";
					$this->log("Msg: ERROR; Action: file upload (".$filename."); Type: partial upload; Code: ".$file['error'],"ivr");
					break;


				case 4:
					// an error occured
					$result['errors'][] = "No file selected. Please try again.";
					$this->log("Msg: ERROR; Action: file upload; Type: no file selected; Code: ".$file['error'],"ivr");
					break;


				default:
					// an error occured
					$result['errors'][] = "System error uploading $filename. Please contact the system administrator.";
					$this->log("Msg: ERROR; Action: file upload (".$filename."); Type: Unknown; Code: ".$file['error'],"ivr");
					break;
			} //switch

		

		} elseif ($file['error']==4){
			$result['errors'][] = __("No file selected. Please try again.",true);
			$this->log("Msg: ERROR; Action: file upload; Type: no file selected; Code: ".$file['error'],"ivr");
			
		}

		else {
			// unacceptable file type

			$result['errors'][] = __('The following file could not be uploaded due to invalid file type:',true).' '.$file['name'];
			$this->log("Msg: ERROR; Action: file upload (".$filename."); Type: invalid file type; Code: ".$file['error'],"ivr");
		}
	} //foreach

return $result;
}

/**
 * Converts a wav file to mp3 using Lame. 
 * The code is based on the following snipper: http://www.rjvrijhof.com/download/wav2mp3.php
 *
 * @param  string $file wav file to be converted to mp3
 * @creates a mp3 file in the same dir
 */

   function wav2mp3($file){

     if (file_exists($file) && eregi("^.+\.[Ww][Aa][Vv]$", $file)) {

      	$mp3 = substr($file, 0, -3) . "mp3";
      	$cmd = "/usr/bin/lame -V2 -S " . escapeshellarg(WWW_ROOT.$file) . " " . escapeshellarg(WWW_ROOT.$mp3);
      	passthru($cmd);
  	}
     }


     function getExt($file){

     return strrchr($file,'.');

     }


     function getFilename($file){


     $pos =strripos ($file,'.');

     return substr($file,0,$pos);


     }


}
?>
