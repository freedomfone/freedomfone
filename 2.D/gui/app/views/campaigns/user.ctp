<?
   echo "<div id='user_div' class='user_div'>";

   if($user){

           echo "<table width='35%' cellspacing  = '0' class = 'stand-alone'>";
	   $row[] = array(array(__('User details',true),array('colspan'=> 2, 'align' => 'center')));
           $row[] = array(__('Name',true), $user['User']['name']);
           $row[] = array(__('Surname',true), $user['User']['surname']);
           $row[] = array(__('Phone numbers',true), date('Y-m-d H:i A',$user['User']['created']))
           $row[] = array(__('Skype',true), $user['User']['skype']);
           $row[] = array(__('Email',true), $user['User']['email']);

           echo $html->tableCells($row,array('class'=>'stand-alone'),array('class'=>'stand-alone'));
           echo "</table>";

           }

  echo "</div>";


?>

