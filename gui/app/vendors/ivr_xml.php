<?php
/****************************************************************************
 * ivr_xml.php		- Class for creating XML files for Voice menus
 * version 		- 1.0.360
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
 * The Initial Developer of the Original Code is
 *   Louise Berthilson <louise@it46.se>
 *
 *
 ***************************************************************************/

class ivr_xml {

public $body;
public $inter_digit_timout;
public $invalid_sound;
public $timeout;
public $inter_digit_timeout;
public $max_failures;
public $max_timeouts;	    
public $digit_len;    
public $handle;
private $tts_engine;
private $tts_voice;
public $ivr_settings;
public $node_path;
public $menu_path;
public $file;
public $ext;


 function ivr_xml($instance_id = null){

     $ivr_settings = Configure::read('IVR_SETTINGS');
     $ivr_monitor  = Configure::read('IVR_MONITOR');
     $ext 	   = Configure::read('EXTENSIONS');
     

     $this->ivr_path = $ivr_settings['path'];
     $this->ivr_dir_node = $ivr_settings['dir_node'];
     $this->ivr_dir_menu = $ivr_settings['dir_menu'];

     $this->node_path	   = '$${base_dir}/scripts/'.$this->ivr_path.$this->ivr_dir_node;

     $this->file_individual	   = WWW_ROOT.$ivr_settings['path'].'/'.$instance_id.'/'.$ivr_settings['dir_conf']."/ivr.xml";
     $this->file_common	           = WWW_ROOT.$ivr_settings['curl']."ivr.xml"; 



     $this->ivr_monitor = '$${base_dir}/'.$ivr_monitor['script'];



     $this->inter_digit_timout      = 2000;
     $this->timeout 	      	    = 3000;			  
     $this->inter_digit_timeout     = 2000;
     $this->max_failures 	    = 10;
     $this->max_timeouts 	    = 4;
     $this->digit_len	    	    = 1;
     $this->tts_engine	    	    = 'cepstral';
     $this->tts_voice	    	    = 'allison';
     $this->ext		    	    = $ext;


  }


/*
 * Writes XML header
 * 
 *
 */

  function ivr_header(){

       $xmltext = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n<document></document>";	
       $xml = simplexml_load_string($xmltext);
       $xml -> addAttribute("type", "freeswitch/xml");
       $sec   = $xml -> addChild("section");
       $sec -> addAttribute("name", "configuration");
       $con   = $sec -> addChild("configuration");
       $con -> addAttribute("name","ivr.conf");
       $con -> addAttribute("description","IVR menus");
       $menus   = $con -> addChild("menus");
       $this->body  = $xml;
  }

/*
 * Writes IVR menu
 * 
 * @params array $data ivr_menus object
 *
 */

  function write_ivr_menu($ivr){

  $data      = $ivr['IvrMenu'];
  $mappings  = $ivr['Mapping'];



     $ivr_default = Configure::read('IVR_DEFAULT');
     $this->menu_path	   = '$${base_dir}/scripts/'.$this->ivr_path.$data['instance_id'].'/'.$this->ivr_dir_menu;
	  
	   $comment	    = "type: ".$data['ivr_type'];
	   $name            = 'freedomfone_ivr_'.$data['instance_id'];
	   $title           = $data['title'];
           $message_long    = $data['message_long'];
           $message_short   = $data['message_short'];
           $message_exit    = $data['message_exit'];
           $message_invalid = $data['message_invalid'];


	   $menus = $this->body -> section-> configuration-> menus->addChild('menu');
	   $menus -> addAttribute ("name",$name);  //Unique name {id}_{title}
	   $menus -> addAttribute ("tts-engine",$this->tts_engine);  //Text-to-speach setings
	   $menus -> addAttribute ("tts-voice",$this->tts_voice);  


	   if($data['file_long'] && !$data['mode_long']){
		$greet_long = 'file_long.wav';
		}
	   elseif (trim($message_long)) {
	   	$greet_long = "say: ".$message_long;
	   } else {
	     $greet_long = "say: ".$ivr_default['ivrLongMessage'];
	   }

	   $menus -> addAttribute ("greet-long",$greet_long);


	   if($data['file_short'] && !$data['mode_short']){
		$greet_short = 'file_short.wav';
		}
	   elseif (trim($message_short)) {
	   	$greet_short = "say: ".$message_short;
	   } else {
	     $greet_short = "say: ".$ivr_default['ivrShortMessage'];
	   }
	   $menus -> addAttribute ("greet-short",$greet_short);


	   if($data['file_invalid'] && !$data['mode_invalid']){
		$invalid = 'file_invalid.wav';
		}
	   elseif(trim($message_invalid)){
		$invalid = "say: ".$message_invalid;
	   }
	   else {
	   	$invalid = "say: ".$ivr_default['ivrInvalidMessage'];

	   }


	   if($data['file_exit'] && !$data['mode_exit']){
		$exit = 'file_exit.wav';
		}
	   elseif($message_exit){
		$exit = "say: ".$message_exit;
	   }
	   else {
	   	$exit = "say: ".$ivr_default['ivrExitMessage'];
	   }


	    $menus -> addAttribute ("invalid-sound",$invalid);
	    $menus -> addAttribute ("exit-sound",$exit);

	   $menus -> addAttribute ("timeout",$this->timeout);					 
	   $menus -> addAttribute ("inter-digit-timeout",$this->inter_digit_timeout);			 
           $menus -> addAttribute ("max-failures",$this->max_failures);					 
           $menus -> addAttribute ("max-timeouts",$this->max_timeouts);						 
 	   $menus -> addAttribute ("digit-len",$this->digit_len);							  


	   }

  function write_switcher_menu($ivr){


  $data      = $ivr['IvrMenu'];
  $mappings  = $ivr['Mapping'];

     $ivr_default = Configure::read('IVR_DEFAULT');
     $this->menu_path	   = '$${base_dir}/scripts/'.$this->ivr_path.$data['instance_id'].'/'.$this->ivr_dir_menu;
	  
	   $comment	    = "type: ".$data['ivr_type'];
	   $name            = 'freedomfone_ivr_'.$data['instance_id'];
	   $title           = $data['title'];
           $message_long    = $data['message_long'];
           $message_invalid = $data['message_invalid'];


	   $menus = $this->body -> section-> configuration-> menus->addChild('menu');
	   $menus -> addAttribute ("name",$name);  //Unique name {id}_{title}
	   $menus -> addAttribute ("tts-engine",$this->tts_engine);  //Text-to-speach setings
	   $menus -> addAttribute ("tts-voice",$this->tts_voice);  


	   if($data['file_long'] && !$data['mode_long']){
		$greet_long = 'file_long.wav';
		}
	   elseif (trim($message_long)) {
	   	$greet_long = "say: ".$message_long;
	   } else {
	     $greet_long = "say: ".$ivr_default['ivrLongMessage'];
	   }

	   $menus -> addAttribute ("greet-long",$greet_long);


	   if($data['file_invalid'] && !$data['mode_invalid']){
		$invalid = 'file_invalid.wav';
		}
	   elseif(trim($message_invalid)){
		$invalid = "say: ".$message_invalid;
	   }
	   else {
	   	$invalid = "say: ".$ivr_default['ivrInvalidMessage'];

	   }


	    $menus -> addAttribute ("invalid-sound",$invalid);
	   $menus -> addAttribute ("timeout",$this->timeout);					 
	   $menus -> addAttribute ("inter-digit-timeout",$this->inter_digit_timeout);			 
           $menus -> addAttribute ("max-failures",$this->max_failures);					 
           $menus -> addAttribute ("max-timeouts",$this->max_timeouts);						 
 	   $menus -> addAttribute ("digit-len",$this->digit_len);							  


	   }

       function write_switcher_entry($switcher_type, $digit , $id,  $file_invalid, $instance_id){


                $entry = $this->body -> section-> configuration-> menus -> menu[0] -> addChild("entry");

	 
                switch($switcher_type){

                        case 'ivr':

		        $action  = "menu-sub";
	                $param   = "freedomfone_ivr_".$instance_id;
                        break;

                        case 'lam':

		        $action  = "menu-exec-app";
		        $param   = "transfer 2".$instance_id." XML default";
                        break;

		      	//Node::interrupt
			case 'node':

		       	$obj = mysql_query("select * from nodes where id = '$id'");	 
		       	$arr = mysql_fetch_array($obj);
			$action = "menu-exec-app";

			//We wait 1 second after playing the file to return to head IVR
			$param  = 'play_and_get_digits 1 1 1 1000 # '.$this->node_path.$arr['file'].'.wav '.$file_invalid;
			break;


		      	//Node::non-interrupt
			Case 'node-non-interrupt':

		       	$obj = mysql_query("select * from nodes where id = '$id'");	 
		       	$arr = mysql_fetch_array($obj);
			$action = "menu-play-sound";
			$param  = $this->node_path.$arr['file'].'.wav';
			break;


	         }

		 $entry -> addAttribute("action",$action);
		 $entry -> addAttribute("digits",$digit);
		 $entry -> addAttribute("param",$param);


         }

	   function write_ivr_entry($type,$id,$digit,$key,$title,$file_invalid,$instance_id){

	            	switch ($type){

		      	   //Node::interrupt
			   case 'node':

		       	   $obj = mysql_query("select * from nodes where id = '$id'");	 
		       	   $arr = mysql_fetch_array($obj);
			   $action = "menu-exec-app";


			   //We wait 1 second after playing the file to return to head IVR
			   $param  = 'play_and_get_digits 1 1 1 1000 # '.$this->node_path.$arr['file'].'.wav '.$file_invalid;
			   break;


		      	   //Node::non-interrupt
			   Case 'node-non-interrupt':

		       	   $obj = mysql_query("select * from nodes where id = '$id'");	 
		       	   $arr = mysql_fetch_array($obj);
			   $action = "menu-play-sound";
			   $param  = $this->node_path.$arr['file'].'.wav';
			   break;



		      	   //Leave-a-message
			   case 'lam':

			   $ext = $this->ext['lam'].$instance_id;
			   $action = "menu-exec-app";
			   $param  = "transfer ".$ext." XML default";
			   $id='lam';
			   break;


		      	   //Leave-a-message
			   case 'ivr':

		           $action  = "menu-sub";
		           $param   = "freedomfone_ivr_".$instance_id;
                           break;

          		   }
				
		        $entry = $this->body -> section-> configuration-> menus -> menu[$key] -> addChild("entry");
      			$entry -> addAttribute("action",$action);
		        $entry -> addAttribute("digits",$digit);
			$entry -> addAttribute("param",$param);

			//ADD SWITCH TO GUI (global variable)
			$monitor=true;

			if($monitor){
				$action= "menu-exec-app";
				$param = "javascript $this->ivr_monitor \${uuid} '$title' '$digit' '$id' '\${caller_id_number}' '\${destination_number}'";
		        	$entry = $this->body -> section-> configuration-> menus -> menu[$key] -> addChild("entry");
      				$entry -> addAttribute("action",$action);
		        	$entry -> addAttribute("digits",$digit);
				$entry -> addAttribute("param",$param);
		   

			}
 
	   }


	  function write_entry_common($key){

		 $entryExit = $this->body -> section-> configuration-> menus -> menu[$key] -> addChild("entry");
	    	 $entryExit -> addAttribute("action","menu-top");
	     	 $entryExit -> addAttribute("digits","9");


		 $entryTop = $this->body -> section-> configuration-> menus -> menu[$key] -> addChild("entry");
	      	 $entryTop -> addAttribute("action","menu-back");
	         $entryTop -> addAttribute("digits","0");

	  }


	  function write_file(){


   	         $this->handle = fopen($this->file_individual,'w');
	  	 $dom = dom_import_simplexml($this->body)->ownerDocument;
    		 $dom->formatOutput = true;
     		 $xml = $dom->saveXML();

		 fwrite($this->handle,$xml);

	
	  }


          function write_all_ivr($contents){

   	         $this->handle = fopen($this->file_common, 'w');
		 fwrite($this->handle,$contents);
                 fclose($this->handle);

          }



/*
 * Closes file ivr.xml for writing 
 * 
 *
 */
 function close_file(){

       fclose($this->handle);

 }


}
?>
