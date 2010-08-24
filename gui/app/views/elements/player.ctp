<?php 
/****************************************************************************
 * player.ctp			- Uses AudioPlayer to stream mp3 files
 * version 			- 1.0.362
 * 

 * Audio Player is a WordPress plugin developed by Martin Laine.
 * Audio Player is released under the Open Source MIT license, which gives you the possibility to use it and modify it in every circumstance.
 * 
 * Copyright (c) 2008 Martin Laine
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the “Software”), 
 * to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, 
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, 
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER 
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS 
 * IN THE SOFTWARE.
 *
 *
 * 
 *
 *
***************************************************************************/
      //if full url is provided
      if (isset($url) && $url){ 

      $check =1;
      $song_url = $url.$file.'.mp3';

      }


      //if absolute path is provided
      else { 
      	   if (file_exists($path.$file.'.mp3')){ 
      	      $check=1;
	      } else {
	      $check=0;
	    }
	    

      if (!isset($host)){ $host = MY_DOMAIN;}

      $song_url = $host.$path.$file.'.mp3';

      }


	

     if($check==1){ 

        echo $javascript->includeScript('detectFlash');        
        $script = 'AudioPlayer.embed("audio_player_'.$id.'", {soundFile: "'.$song_url.'",titles: "'.$title.'"});';
	echo $html->para(null,null,array('id'=>'audio_player_'.$id));
	echo $javascript->codeBlock($script,array('safe'=>false));

	}
 
     else { 
     	  echo __("No audio file available",true); 
     }

?>

