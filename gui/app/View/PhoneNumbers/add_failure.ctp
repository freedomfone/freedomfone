<?php

     echo $this->Html->div('error',__("Duplicated or invalid phone number format (numbers and plus (+) sign are allowed).",true));
     $row[] = array(array($this->Html->div('table_sub_header',__('Phone numbers',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom')));

     foreach ($phonenumbers as $key => $number){


             $delete = $this->Js->link($this->Html->image("icons/delete.png"),
                                   array('controller' => 'phone_numbers', 'action' => 'delete', $number['PhoneNumber']['id'], $user),
                                   array('update' => '#numbers', 'escape' => false, 'class' => 'numbers'));


             $row[] = array(__('Number',true), $number['PhoneNumber']['number'], $delete);

     }

     echo "<table width='400px' cellspacing='0' class='blue'>";  
     echo $this->Html->tableCells($row, array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";


?>