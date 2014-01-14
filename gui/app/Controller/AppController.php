<?php
/**
 * Application level Controller
 *
 * This file is application-wide controller file. You can put all
 * application-wide controller-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Controller
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
App::uses('Controller', 'Controller');

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @package		app.Controller
 * @link		http://book.cakephp.org/2.0/en/controllers.html#the-app-controller
 */

App::import("Vendor", "ff_event", false, null, 'spooler_ff.php'); 
App::import("Vendor", "ESL", false, null, 'ESL.php'); 
App::import("Vendor", "mp3file", false, null, 'mp3file.php'); 
App::import("Vendor", 'SimpleDOM',false,null,'SimpleDOM.php'); 
App::import('Vendor', 'sms'); 

App::uses('AuthComponent', 'Controller/Component');




class AppController extends Controller {

var $helpers = array('Html','Form','Js','Session','Paginator','Text','Time','Access'); 

 public $components = array(
 	'RequestHandler',
	'DebugKit.Toolbar',
        'Acl',
        'Auth' => array(
            'authorize' => array(
  		'Actions' => array('actionPath' => 'controllers','userModel' => 'FfUser')
            ),
	    'authenticate' => array(
                    'Form' => array(
                        'userModel' => 'FfUser',
                        'fields' => array(
                            'username' => 'username',
                            'password'=>'password')
                    )
                )
        ),
        'Session'
    );


public function beforeFilter() {

         $this->Auth->allow('display','login','method','add');



        $this->Auth->loginAction = array(
          'controller' => 'ff_users',
          'action' => 'login'
        );


         //Customize Auth error messages
         $this->Auth->loginError = __("Wrong password, please try again.",true);
         $this->Auth->authError  = __("You do not have the authority to access this page.",true);

  

         //Configure Auth component
         //$this->Auth->authorize = 'actions';
         $this->Auth->logoutRedirect = array('controller' => 'cdr', 'action' => 'overview');
         $this->Auth->loginRedirect  = array('controller' => 'cdr', 'action' => 'overview');

         //Checking of default Admin password is in use


	 $user = $this->Auth->user();

	 if($user){ 
         $this->loadModel('FfUser');
         $res = $this->FfUser->findByUsername($user['username']);
 
	if(!$res){ 

         $this->Auth->loginRedirect  = array('controller' => 'ff_users', 'action' => 'login');
	 $this->Session->setFlash('You are not authorized');

	}
        elseif( $res['FfUser']['password'] == '6f04cfa963380dee68a9bfe8bdff14784af284a7'){
                       $this->Auth->loginRedirect  = array('controller' => 'ff_users', 'action' => 'index');

          } else {

         $this->Auth->loginRedirect  = array('controller' => 'cdr', 'action' => 'overview');

        }


	
        $authGroup = $res['FfUser']['group_id'];
        $authUser  = $res['FfUser']['username'];
        $this->set(compact('authGroup', 'authUser'));
	} 

	 if(!$timezone = $this->Session->read('Config.timezone')){
		$timezone = $this->getTimezone();
	 }
         date_default_timezone_set($timezone);

	 if(!$locale = $this->Session->read('Config.langauge')){
		$locale = $this->getLanguage();

                Configure::write('Config.language', $locale);
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
	      
	       	$permitted = array('audio/mpeg','audio/mp3','audio/mpg');
		$ext = 'mp3';
		break;	       

	       case 'wav':
	       	$permitted = array('audio/x-wav','audio/wav');
		$ext = 'wav';
		break;	       

	       case 'audio':
	       	$permitted = array('audio/mpeg','audio/x-wav','audio/wav','audio/mp3','audio/mpg');
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
		  
		     //$filename = time().'_'.Sanitize::paranoid($file['name'], array('.'));
		     $filename = time().'_'.preg_replace("/[^a-zA-Z0-9._]+/", "",$file['name']);

	      }

		$result['files'][$key]=$filename;
		$result['original'][$key]= $file['name'];



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
		if($typeOK)  {


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
						//ini_set('date.timezone', 'Europe/London');
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
						$result['urls'][$key] = $url;
					} else {
						$result['urls'][$key] = false;
						$result['errors'][$key] = "The file could not be uploaded. Please contact the system administrator.";
						$this->log("[ERROR] File upload, Move_uploaded_file","ivr");
											}
					break;
				case 1:
					// an error occured
					$result['errors'][$key] = "Error uploading $filename. The file is too large.";
					$this->log("[ERROR] File upload: ".$filename.", Type: filesize php.ini, ".$file['error'],"ivr");

					break;

				case 2:
					// an error occured
					$result['errors'][$key] = "Error uploading $filename. The file is too large.";
					$this->log("[ERROR] File upload: ".$filename.", Type: filesize html, ".$file['error'],"ivr");
					break;


				case 3:
					// an error occured
					$result['errors'][$key] = "Error uploading $filename. The file was only partially uploaded.";
					$this->log("[ERROR] File upload ".$filename.", Type: partial upload, ".$file['error'],"ivr");
					break;


				case 4:
					// an error occured
					$result['errors'][$key] = "No file selected. Please try again.";
					$this->log("[ERROR] File upload,  Type: no file selected, Code: ".$file['error'],"ivr");
					break;


				default:
					// an error occured
					$result['errors'][$key] = "System error uploading $filename. Please contact the system administrator.";
					$this->log("[ERROR] File upload: ".$filename.", Type: Unknown,  ".$file['error'],"ivr");
					break;
			} //switch

		

		} elseif ($file['error']==4){
			$result['errors'][$key] = __("No file selected. Please try again.",true);
			$this->log("[ERROR] File upload, Type: no file selected, ".$file['error'],"ivr");
			
		}

		else {
			// unacceptable file type

			$result['errors'][] = __('Failure (invalid file type)',true).' : '.$file['name'];
			$this->log("[ERROR] File upload ".$filename.", Type: invalid file type, ".$file['error'],"ivr");
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




/*
 * Returns duration (in seconds) of wav file
 *  
 * @param string $type type of media content (node, ivr_menu) 
 * @param string $filename name of file without extension
 * @param string $ext extension (wav/mp3) 
 * @return int $duration
 *
 * Source: http://snipplr.com/view/285/read-wav-header-and-calculate-duration/
 *
 */

  function wavDuration($type,$filename,$ext) {

  	   $path= false;

	   sleep(2);
  	   switch ($type){

    	     case 'node':
	     $path = BASE_DIR.'/freeswitch/scripts/freedomfone/ivr/nodes/';
	     break;

	    }

	    $file = $path.$filename.".".$ext;

            $fp = fopen($file, 'r');

     	    if (fread($fp,4) == "RIFF") {
    	       fseek($fp, 20);
    	       $rawheader = fread($fp, 16);
    	       $header = unpack('vtype/vchannels/Vsamplerate/Vbytespersec/valignment/vbits',$rawheader);
    	       $pos = ftell($fp);
    	         while (fread($fp,4) != "data" && !feof($fp)) {
      	       	     $pos++;
      		     fseek($fp,$pos);
    		 }
    	        $rawheader = fread($fp, 4);
    		$data = unpack('Vdatasize',$rawheader);

                if($header['bytespersec']){
                        $sec = $data['datasize']/$header['bytespersec'];
                 } else {
                        $sec = false;
                 }
    		return round($sec);
  	    }
   }



     function getExt($file){

       return strtolower(strrchr($file,'.'));

     }


     function getFilename($file){

       $pos =strripos ($file,'.');
       return substr($file,0,$pos);

     }


     function logRefresh($model, $method = null){

	if (!$method){ 
	   $method = 'manual'; 
	   }
	$this->log("[INFO] Model: ".$model.", Mode: ".$method, "refresh"); 

     }

     function getTimezone(){


        if (!isset($this->Setting)) {
     	    $this->loadModel('Setting');   
     	    $this->Setting =& new Setting();
         }
    	 $entry = $this->Setting->findByName('timezone');
	 return $entry['Setting']['value_string'];
     }

     function getLanguage(){


        if (!isset($this->Setting)) {
     	    $this->loadModel('Setting');   
     	    $this->Setting =& new Setting();
         }
    	 $entry = $this->Setting->findByName('language');
	 return $entry['Setting']['value_string'];
     }

     function checkMyIp(){

	$op_internal = array();
	$op_external = array();

        //$pid = (int)$op[0]; 

     $external = exec("/usr/bin/wget http://wim.freedomfone.org/wim/ -O - -q echo ",$op_internal);
     $internal = exec("/sbin/ip addr show dev eth0 | sed -e's/^.*inet \([^ ]*\)\/.*$/\1/;t;d'" ,$op_external);

     return array($op_internal[0], $op_external[0]);


     }


/*
 * getInstance: Get instance id for IVR and LAM
 *
 * @param array $data
 * @return int $instance_id 
 *
 */
 function getInstance($data){

          switch($data['type']){

          case 'lam':
          $model = 'LmMenu';       
          $table = 'lm_menus';       
          $field = 'lam_id';       
          break;

          case 'ivr':
          $model = 'IvrMenu';       
          $table = 'ivr_menus';
          $field = 'ivr_id';       
          break;

          case 'node':
          $table = false;
          break;

          }

          if ($table){
                $this->loadModel($model);   
                $data = $this->$model->findById($data[$field]);
                return $data[$model]['instance_id'];

          } else {

            return false;

          }

     }

/*
 * Checks if a node/ivr/lam is active in an existig IVR.
 *  
 * @param int $id, string $type {node,ivr,lam}
 * @return bool
 *
 */

      function isActive($id, $type){


               $this->loadModel('Mapping');
               $this->Mapping->unbindModel(array('belongsTo' => array('Node'), 'hasOne' => array('Node'), 'belongsTo' => array('IvrMenu'), 'belongsTo' => array('LmMenu')));      
               if ($this->Mapping->find('count', array('conditions' => array('Mapping.type' => $type, 'Mapping.'.$type.'_id' => $id)))){

	          return true;
	    
               } else {
	      
                 return false;
	      
              }
      }



/*
 * Deletes files in dir (and sub-directories) but keeps directories (used to delete IVR/LAM)
 *  
 * @param string $directory bool $empty, book $emptySubDir
 * 
 *
 */

      function emptyDir($directory, $empty = null, $emptySubDir= null){

               if(substr($directory,-1) == "/") {
                      $directory = substr($directory,0,-1);
                }

                if(!file_exists($directory) || !is_dir($directory)) {
                           return false;
                } elseif(!is_readable($directory)) {
                          return false;
                } else {
                          $directoryHandle = opendir($directory);
       
                while ($contents = readdir($directoryHandle)) {
                      if($contents != '.' && $contents != '..' && $contents != '.svn') {
                                   $path = $directory . "/" . $contents;
              

                        if(is_dir($path)) {

                             $this->emptyDir($path,$emptySubDir);
                        } elseif (!is_dir($path)) {

                        unlink($path);
                        }
                      }
                }
       
                closedir($directoryHandle);

                if($empty == false) {
                          if(!rmdir($directory)) {
                          return false;
                          }             
                }
       
                return true;
              }
     }



     function refreshAll(){


     $this->requestAction('/polls/refresh/manual');
     $this->requestAction('/messages/refresh');
     $this->requestAction('/cdr/refresh/manual');
     $this->requestAction('/monitor_ivr/refresh/manual');
     $this->requestAction('/processes/refresh/manual');
     $this->requestAction('/channels/refresh/manual');
     $this->requestAction('/bin/refresh/manual');

        return true;
     }

     
     function dateToString($date){

              return $date['year'].'-'.$date['month'].'-'.$date['day'].' '.$date['hour'].':'.$date['min'].':00 '.$date['meridian'];


     }



     function headerGetStatus($header){

              $status = false;

              switch(trim($header)){

                case 'HTTP/1.0 200 OK':
                $status = 1;
                break;

                case 'HTTP/1.1 200 OK':
                $status = 1;
                break;
              
                case 'HTTP/1.1 409 CONFLICT':
                $status = 2;
                break;

                case 'HTTP/1.1 500 INTERNAL SERVER ERROR':
                $status = 3;
                break;

                case 'HTTP/1.1 204 NO CONTENT':
                $status = 4;
                break;

                case 'HTTP/1.1 400 BAD REQUEST':
                $status = 5;
                break;

              }


              return $status;

     }


     function getServiceName($ext){

	$mapping = Configure::read('EXT_MAPPING');
        $application = $model = false;
	foreach($mapping as $app => $reg){
	      preg_match($reg,$ext,$matches);
		   if($matches){	
	 	       	$application = $app;
                        $instance_id = substr($ext,1,3);
		   }
         }


         switch($application){

         case 'lam':
         $model = 'LmMenu';
         break;

         case 'ivr':
         $model = 'IvrMenu';
         break; 
         }


         $this->loadModel($model);
         if($model == 'LmMenu'){ $this->{$model}->unbindModel(array('hasMany' => array('Mapping')));}
         $data = $this->{$model}->findByInstanceId($instance_id);
         return array('service_name' => $data[$model]['title'], 'application' => $application);

     }

/*
 * Get list of non-empty phone books (campaign::add)
 *  
 * @return array('PhoneBook.id', 'PhoneBook.name')
 * 
 *
 */
  function getPhoneBooks(){

        $this->loadModel('User');
        $users  = $this->User->find('all');
        foreach($users as $user){
            foreach($user['PhoneBook'] as $key => $entry){
                  $id[] = $entry['id'];
            }
        } 

        $this->loadModel('PhoneBook');
        $phonebooks = $this->PhoneBook->find('list', array('conditions' => array('id' => $id)));
        
        return $phonebooks;

 }

    function authAccess($msg){

             if($authGroup == 1){
                return $msg;
             } else {
                return false;
             }

     }


     function sweeper(){

          $config   = Configure::read('SWEEP_CONFIG');
          $settings = Configure::read('SWEEP_SETTINGS');
          $mode = $config['mode'];
          $status = true;


          if($config['enable'] && $mode ){

             foreach($settings as $model => $data){

                if(isset($data[$mode])){

                    foreach($data[$mode] as $key => $value){

                      $data[$mode][$key] = "'".$value."'";

                    }           
                    $this->loadModel($model);


                    if($data[$mode]){

                        $status = $this->$model->updateAll($data[$mode]); 

                        if(!$status){
                           return false;
                        }
                    }

                  } else {
                
                        return false;
                
                  }


             }

             return true;

          } else {

            return false;

          }

    }

}
