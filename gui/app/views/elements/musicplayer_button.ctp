<?php 

      //if full url is provided
      if (isset($url) && $url){ 

/*    if (file_exists($url.$file)){ 

      	 $check=1;
	 } else {
	 $check=0;
	 }*/
 
      $check =1;
      $song_url = $url.$file;


      }


      //if absolute path is provided
      else { 
      	   if (file_exists($path.$file)){ 
      	      $check=1;
	      } else {
	      $check=0;
	      }

	   if (!isset($host)){ $host = MY_DOMAIN;}

      $song_url = $host.$path.$file;

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

