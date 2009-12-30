<?php

class ivr_xml {
/**
 * Class for creating IVR xml files
 *
 */

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


	function ivr_xml(){

     $ivr_settings = Configure::read('IVR_SETTINGS');
     $ext 	   = Configure::read('EXTENSIONS');
     

     $this->node_path	   = '$${base_dir}/scripts/'.$ivr_settings['path'].IID."/".$ivr_settings['dir_node'];
     $this->menu_path	   = '$${base_dir}/scripts/'.$ivr_settings['path'].IID."/".$ivr_settings['dir_menu'];
     $this->file	   = WWW_ROOT.$ivr_settings['curl']."ivr.xml";




	$this->inter_digit_timout   = 2000;
	$this->timeout 	      	    = 3000;			  
	$this->inter_digit_timeout  = 2000;
	$this->max_failures 	    = 3;
	$this->max_timeouts 	    = 4;
	$this->digit_len	    = 4;
	$this->tts_engine	    = 'cepstral';
	$this->tts_voice	    = 'allison';
	$this->ext		    = $ext;

	$this->open_file();
	}

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


	function write_menu($data){


	$ivr_default = Configure::read('IVR_DEFAULT');


	//Parent IVR is named ivr_menu. Other menus are named {id}_{title}
	if ($data['parent']==1){ $name = $ivr_default['parent_ivr'];}
	else {
	$name = $data['id']."_".$data['title'];
	      }
	  
	   $title           = $data['title'];
           $message_long    = $data['message_long'];
           $message_short   = $data['message_short'];
           $message_exit    = $data['message_exit'];
           $message_invalid = $data['message_invalid'];

	   $option1_type  = $data['option1_type'];
           $option1_id    = $data['option1_id'];
           $option2_type  = $data['option2_type'];
           $option2_id    = $data['option2_id'];
           $option3_type  = $data['option3_type'];
           $option3_id    = $data['option3_id'];
           $option4_type  = $data['option4_type'];
           $option4_id    = $data['option4_id'];
           $option5_type  = $data['option5_type'];
           $option5_id    = $data['option5_id'];
           $option6_type  = $data['option6_type'];
           $option6_id    = $data['option6_id'];
           $option7_type  = $data['option7_type'];
           $option7_id    = $data['option7_id'];
           $option8_type  = $data['option8_type'];
           $option8_id    = $data['option8_id'];
  

	   $menus = $this->body -> section-> configuration-> menus->addChild('menu');
	   $menus -> addAttribute ("name",$name);  //Unique name {id}_{title}
	   $menus -> addAttribute ("tts-engine",$this->tts_engine);  //Text-to-speach setings
	   $menus -> addAttribute ("tts-voice",$this->tts_voice);  


	   if($data['file_long']){
		$menus -> addAttribute ("greet-long",$this->menu_path.$data['file_long']);
		}
	   else {
	   	$menus -> addAttribute ("greet-long","say: ".$message_long);
	   }



	   if($data['file_short']){
		$menus -> addAttribute ("greet-short",$this->menu_path.$data['file_short']);
		}
	   else {
	   	$menus -> addAttribute ("greet-short","say: ".$message_short);
	   }


	   if($data['file_invalid']){
		$invalid = $this->menu_path.$data['file_invalid'];
		}
	   elseif(trim($message_invalid)){
		$invalid = "say: ".$message_invalid;
	   }
	   else {
	   	$invalid = "say: ".$ivr_default['ivrInvalidMessage'];

	   }


	   if($data['file_exit']){
		$exit = $this->menu_path.$data['file_exit'];
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


	   function write_entry($type,$id,$digit,$key){

	            	switch ($type){

		      	   //Node
			   case 'node':

		       	   $obj = mysql_query("select * from nodes where id = '$id'");	 
		       	   $arr = mysql_fetch_array($obj);
			   $action = "menu-play-sound";
			   $param  = $this->node_path.$arr['file'];
			   break;

		      	   //Leave-a-message
			   case 'lam':

			   $ext = $this->ext['lam'];
			   $action = "menu-exec-app";
			   $param  = "transfer ".$ext." XML default";
			   break;
          		   }
				
		        $entry = $this->body -> section-> configuration-> menus -> menu[$key] -> addChild("entry");
      			$entry -> addAttribute("action",$action);
		        $entry -> addAttribute("digits",$digit);
			$entry -> addAttribute("param",$param);
		    
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

	  	 $dom = dom_import_simplexml($this->body)->ownerDocument;
     		 $dom->formatOutput = true;
     		 $xml = $dom->saveXML();

		 fwrite($this->handle,$xml);

	
	  }

	  function open_file(){

		 $this->handle = fopen($this->file,'w');

	  }

	  function close_file(){

		 fclose($this->handle);

	  }


}

?>
