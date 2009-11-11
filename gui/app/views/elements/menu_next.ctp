<?

	if(isset($back_text) && isset($fwd_text)){

		      $frame = '&#171; '.$html->link($back_text,$back_link)." | ".$html->link($fwd_text,$fwd_link).' &#187;';
		     
		      }

		      elseif(isset($back_text) && !isset($fwd_text)){

		      $frame = '&#171; '.$html->link($back_text,$back_link);

		      }
		      elseif(!isset($back_text) && isset($fwd_text)){

		      $frame = $html->link($fwd_text,$fwd_link).' &#187;';

		      }


 echo $html->div($div,$frame);
?>