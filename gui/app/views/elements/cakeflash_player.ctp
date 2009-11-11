<?php

echo $flash->renderSwf('cakeflash_soundtracker.swf',160,25,false,array(
					'params' => array(
						  'wmode'=>'transparent',
						  'scale'=>'exactfit',
						  'allowscriptaccess'=>'samedomain'
						  ),
					'flashvars'=>array(
						  'mp3path'=>'/cake_1_2/files/messages/file1.mp3',
						  'title'=>$data['Message']['title'] )
							)
			);

?>