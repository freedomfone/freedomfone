<?php
class LmMenu extends AppModel {

	var $name = 'LmMenu';
	


    function beforeSave(){

    //DEMO FIX
    if($this->data['LmMenu']['id']!=1){

    	$lm_default  = Configure::read('LM_DEFAULT');
     	$lm_settings = Configure::read('LM_SETTINGS');

	    $handle = fopen($lm_settings['path'].IID."/conf/".IID.".conf","w");

    	    foreach ($lm_default as $key => $default){


	    	    $text = $this->data['LmMenu'][$key];
	    	    if (!$text){
		       $text = $default;
		    }
    	    	    $line = "var ".$key." = \"".$text."\";\n";
	    	    fwrite($handle, $line);

	    }
	    
	    fclose($handle);

	    }

    return true;
    }

   // DEMO FIX
    function demoReset(){


        $lm_default  = Configure::read('LM_DEFAULT');

            $data = file("http://localhost/freedomfone/app/webroot/defaults/lm/conf/100.conf");

            foreach($data as $line){

            $_line = explode(";",$line);

            $this->data['LmMenu'][$_line[0]]= $_line[1];

            }
            $this->data['LmMenu']['id']= 1;

            $this->updateAll($this->data['LmMenu']);
    return true;
    }


}
?>
