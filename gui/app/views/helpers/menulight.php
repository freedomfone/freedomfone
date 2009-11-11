<?php
 /* /app/views/helpers/menulight.php 
  *
  * 
  *
  */

 class MenulightHelper extends AppHelper {


 
    function backNext($array){

    $data = '&#171;'.$html->link($array['back_text'],$array['back_link'])." | ".$html->link($array['fwd_text'],$array['fwd_link']).'&#187;';
    return  $html->div($array['div'],$frame);
   
   }

}

?>

