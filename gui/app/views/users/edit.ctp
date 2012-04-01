<?php 
/****************************************************************************
 * edit.ctp	- Edits user data in phone book
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
echo $html->addCrumb(__('Users',true), '/users');
echo $html->addCrumb(__('Edit',true), '/users/edit/'.$this->data['User']['id']);



echo $form->create('User',array('type' => 'post','controller' => 'users', 'action'=> 'edit'));
echo $html->div('frameRightAlone', $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

$acls  = Configure::read('ACL');
foreach($acls as $key => $acl){
	    $acls[$key] = __($acl,true);
}        


 if($data = $this->data){

     $button = $form->submit(__('Save',true),  array('name' =>'data[Submit]', 'class' => 'save_button'));
     echo "<h1>".__("Edit User",true)."</h1>";
     echo $html->div('content_wrap_inline');


     echo $form->create('User',array('type' => 'post','action'=> 'edit'));
     echo $form->hidden('new',array('value'=>0));
     echo $form->hidden('id');
     echo $form->hidden('created');
     echo $form->hidden('first_app');
     echo $form->hidden('last_app');
     echo $form->hidden('count_bin');
     echo $form->hidden('count_poll');
     echo $form->hidden('count_lam');
     echo $form->hidden('count_ivr');
     echo $form->hidden('last_seen');
     echo $form->hidden('last_epoch');

     $skype = $form->input('skype',array('label'=>false));

     $last_seen = __('Never',true);
     if($value = $data['User']['last_epoch']) {
                  $last_seen = date('Y-m-d',$value);
     }

   
    //** START LEFT FRAME **//
     echo "<div class='frameLeft'>";
     $row[] = array($html->div('table_sub_header',__('User data',true)), array($button,''));
     $row[] = array(__("Name",true),			 $form->input('name',array('label'=>false)));
     $row[] = array(__("Surname",true),			 $form->input('surname',array('label'=>false)));
     $row[] = array(__("Email",true),			 $form->input('email',array('label'=>false)));
     $row[] = array(__("Skype",true),			 $skype);
     $row[] = array(__("Organization",true),		 $form->input('organization',array('label'=>false)));
     $row[] = array(__("Access control list (ACL)",true), $form->input('acl',array('type'=>'select','options'=> $acls, 'label'=>false)));
     $row[] = array(array(__("Phone book",true),array('valign'=>'top')),		 $form->input('PhoneBook',array('type'=>'select','multiple' => true, 'options'=>$phonebook, 'empty'=>'- '.__('Select phone book',true).' -','label'=>false)));
     
     
     echo "<table width='400px' cellspacing='0' class='blue'>";
     echo $html->tableCells($row,array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo $form->end();
     unset($row);


     //** AJAX: Delete phone numbers **//
     echo "<div id ='numbers'>";  
     echo "<table width='400px' cellspacing='0' class='blue'>";
     $row[] = array(array($html->div('table_sub_header',__('Phone numbers',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom')));

     foreach ($phonenumbers as $key => $number){

             $delete = $ajax->link($html->image("icons/delete.png"),'/phone_numbers/delete/'.$number['PhoneNumber']['id'].'/'.$data['User']['id'], array('update' => 'numbers'), null, 1);
             $row[] = array(__('Phone number',true), $number['PhoneNumber']['number'], $delete);

     }
     echo $html->tableCells($row, array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo $form->input('PhoneNumber.user_id', array('type' =>'hidden', 'value' => $data['User']['id']));

     echo "</div>";
     //** END AJAX **//


     //** AJAX: Add phone number **//
     echo  $ajax->form(array('type' => 'post', 'options' => array('model'=>'User', 'update'=>'numbers', 'url' => array('controller' => 'phone_numbers','action' => 'add'))));
     echo "<table width='400px' cellspacing='0' class='blue'>";
     $add[] = array(__('Add phone number',true), $form->input('PhoneNumber.number',array('type' => 'text','label' => false, 'value' => false, 'autocomplete' => 'off')), $form->end(array('name' => __('Add',true), 'label' =>__('Add',true),'class' =>'button')));
     echo $html->tableCells($add,array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo $form->input('PhoneNumber.user_id', array('type' =>'hidden', 'value' => $data['User']['id']));
     echo $form->end();
     //** END AJAX **//

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

    echo "</div>";


    }
    else {

    echo "<h1>".__("No user with this id exists",true)."</h1>";
    }

 

?>

