<?php 
/****************************************************************************
 * musicplayer_button.ctp	- Displays flashplayer if given file exists.
 * version 			- 1.0.362
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

      //if full url is provided
      if (isset($url) && $url){ 

/*    if (file_exists($url.$file)){ 

      	 $check=1;
	 } else {
	 $check=0;
	 }*/
 
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


    echo $html->image("icons/space.png");
     if($check==1){ 
     		 echo $flash->renderSwf('swf/musicplayer.swf',30,17,false,array(
					'params' => array(
						  'scale'=>'exactfit',
						  'allowscriptaccess'=>'samedomain'
						  ),
					'flashvars'=>array(
						  'song_url'=> $song_url,
						  'song_title'=>$title)
							)
			);

			}
 
     else { 
     	  echo __("No audio file available",true); 
     }

?>

