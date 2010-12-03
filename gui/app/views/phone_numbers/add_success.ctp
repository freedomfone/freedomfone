<?php


     echo "<table>";
     foreach ($phonenumbers as $key => $number){

             $delete = $ajax->link($html->image("icons/delete.png"),'/phone_numbers/delete/'.$number['PhoneNumber']['id'].'/'.$user, array('update' => 'numbers'), null, 1);
             echo $html->tableCells(array(__('Phone number',true).' '.($key+1),$number['PhoneNumber']['number'],$delete));

     }
     echo "</table>";



?>