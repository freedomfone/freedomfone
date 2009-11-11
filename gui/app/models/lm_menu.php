<?php
class LmMenu extends AppModel {

	var $name = 'LmMenu';
	


    function beforeSave(){


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

    return true;
    }


}
?>
