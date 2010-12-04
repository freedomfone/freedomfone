<?php


     echo "<table>";

     echo   $html->tableCells(array(array(array($html->div('table_sub_header',__('Phone numbers',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom')))));

     foreach ($phonenumbers as $key => $number){

             $delete = $ajax->link($html->image("icons/delete.png"),'/phone_numbers/delete/'.$number['PhoneNumber']['id'].'/'.$user, array('update' => 'numbers'), null, 1);
             echo $html->tableCells(array(__('Phone number',true),$number['PhoneNumber']['number'],$delete));

     }
     echo "</table>";



?>