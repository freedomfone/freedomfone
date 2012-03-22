<?php 
/****************************************************************************
 * view.ctp	- View user data in phone book
 * version 	- 2.0.1244
 * 
 * Version: MPL 1.1
 *
 * The contents of this file are subject to the Mozilla Public License Version
 * 1.1 (the "License"); you may not use this file except in compliance with
 * the License. You may obtain a copy of the License at
 * http://www.mozilla.org/MPL/
 *
 * Software distributed under the License is distributed on an "AS IS" basis,
 * WITHOUT WARRANTY OF ANY KIND, either express or implied. See the License
 * for the specific language governing rights and limitations under the
 * License.
 *
 *
 * The Initial Developer of the Original Code is
 *   Louise Berthilson <louise@it46.se>
 *
 *
 ***************************************************************************/

echo $html->addCrumb(__('User Management',true), '');
$acls  = Configure::read('ACL');
Configure::write('debug', 0);

 if($data){

     $last_seen = __('Never',true);
     if($value = $data['User']['last_epoch']) {
                  $last_seen = date('Y-m-d',$value);
     }

     foreach ($data['PhoneNumber'] as  $entry){

             $phonenumber[] = $entry['number'];

     }
     foreach ($data['PhoneBook'] as  $entry){

             $phonebook[] = $entry['name'];

     }

   
    //** START LEFT FRAME **//
     $row[] = array($html->div('table_sub_header',__('User data',true)), false);
     $row[] = array(__("Name",true),			 $data['User']['name']);
     $row[] = array(__("Surname",true),			 $data['User']['surname']);
     $row[] = array(__("Email",true),			 $data['User']['email']);
     $row[] = array(__("Skype",true),			 $data['User']['skype']);
     $row[] = array(__("Organization",true),		 $data['User']['organization']);
     $row[] = array(__("Access control list (ACL)",true), $acls[$data['User']['acl']]);
     $row[] = array(array(__("Phone numbers",true),array('valign'=>'top')), implode('<br/>',$phonenumber));
     $row[] = array(array(__("Phone book",true),array('valign'=>'top')), implode('<br/>',$phonebook));
     


     echo "<div class='frameLeft'>";
     echo "<table width='400px' cellspacing='0' class='blue'>";
     echo $html->tableCells($row,array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     unset($row);
     echo "</div>";
     //END LEFT FRAME **//


     //** START RIGHT FRAME **//

     echo "<div class='frameRight'>";
     echo "<table width='300px' cellspacing='0' class='blue'>";
     echo $html->tableCells(array (
     array(array($html->div('table_sub_header',__('Statistics',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom'))),
     array(__("In the system since",true),	date('Y-m-d',$data['User']['created'])),
     array(__("Last seen",true),		$last_seen),
     array(__("First application",true),	$formatting->appMatch($data['User']['first_app'])),
     array(__("Last application",true),	     	$formatting->appMatch($data['User']['last_app'])),
     array(array($html->div('table_sub_header',__('Activity',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom'))),
     array(__("Poll",true),			$data['User']['count_poll']),
     array(__("Voice Menu",true),		$data['User']['count_ivr']),
     array(__("Leave-a-message",true),		$data['User']['count_lam']),
     array(__("SMS",true),		        $data['User']['count_bin']),
     array(__("Callback",true),		        $data['User']['count_callback']),
     array(__("Campaign",true),		        $data['User']['count_campaign']),
     ),array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo "</div>";

    //** END RIGHT FRAME **//




    }
    else {

    echo "<h1>".__("No user with this id exists",true)."</h1>";
   
    }


//    echo "</div>"; 

?>

