<?php

     $row[] = array(array($html->div('table_sub_header',__('Phone numbers',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom')));

     foreach ($phonenumbers as $key => $number){



             $delete = $ajax->link($this->Html->image("icons/delete.png"),
                                   array('controller' => 'phone_numbers', 'action' => 'delete', $number['PhoneNumber']['id'].'/'.$user),
                                   array('update' => 'numbers', 'escape' => false), 
                                   __('Are you sure you want to delete this number?', true), 
                                   true);

             $row[] = array(__('Number',true), $number['PhoneNumber']['number'], $delete);

     }

     echo "<table width='400px' cellspacing='0' class='blue'>";  
     echo $html->tableCells($row, array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";






?>

