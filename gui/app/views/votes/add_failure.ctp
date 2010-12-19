<?php

     echo $html->div('error',__("Invalid format",true));


     foreach ($votes as $key => $vote){

             $delete = $ajax->link($html->image("icons/delete.png"),'/votes/delete/'.$vote['Vote']['id'].'/'.$poll, array('update' => 'votes'), null, 1);
             $row[] = array(__('Option',true).' '.($key+1), $vote['Vote']['chtext'], $delete);

     }

     echo "<table width='400px' cellspacing='0' class='blue'>";  
     echo $html->tableCells($row, array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";



?>