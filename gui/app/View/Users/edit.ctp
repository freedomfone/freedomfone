<?php 
/****************************************************************************
 * edit.ctp	- Edits user data in phone book
 * version 	- 3.0.1500
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

echo $this->Html->addCrumb(__('User Management',true), '');
echo $this->Html->addCrumb(__('Callers',true), '/users');
echo $this->Html->addCrumb(__('Edit',true), '/users/edit/'.$this->request->data['User']['id']);

echo $this->Form->create('User',array('type' => 'post','controller' => 'users', 'action'=> 'edit'));
echo $this->Html->div('frameRightAlone', $this->Form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $this->Form->end();


 if($data = $this->data){

     $button = $this->Form->submit(__('Save',true),  array('name' =>'data[Submit]', 'class' => 'save_button'));
     echo "<h1>".__("Edit Caller",true)."</h1>";
     echo $this->Html->div('content_wrap_inline');


     echo $this->Form->create('User',array('type' => 'post','action'=> 'edit'));
     echo $this->Form->hidden('new',array('value'=>0));
     echo $this->Form->hidden('id');
     echo $this->Form->hidden('created');
     echo $this->Form->hidden('first_app');
     echo $this->Form->hidden('last_app');
     echo $this->Form->hidden('count_bin');
     echo $this->Form->hidden('count_poll');
     echo $this->Form->hidden('count_lam');
     echo $this->Form->hidden('count_ivr');
     echo $this->Form->hidden('last_seen');
     echo $this->Form->hidden('last_epoch');

     $skype = $this->Form->input('skype',array('label'=>false));

     $last_seen = __('Never',true);
     if($value = $data['User']['last_epoch']) {
                  $last_seen = date('Y-m-d',$value);
     }


   
    //** START LEFT FRAME **//
     echo "<div class='frameLeft'>";
     $row[] = array($this->Html->div('table_sub_header',__('Caller data',true)), array($button,''));
     $row[] = array(__("Name",true),			 $this->Form->input('name',array('label'=>false)));
     $row[] = array(__("Surname",true),			 $this->Form->input('surname',array('label'=>false)));
     $row[] = array(__("Email",true),			 $this->Form->input('email',array('label'=>false)));
     $row[] = array(__("Skype",true),			 $skype);
     $row[] = array(__("Organization",true),		 $this->Form->input('organization',array('label'=>false)));
     $row[] = array(__("Access control list (ACL)",true), $this->Form->input('acl_id',array('type'=>'select','options'=> $acls, 'label'=>false)));
     $row[] = array(array(__("Phone book",true),array('valign'=>'top')),		 $this->Form->input('PhoneBook',array('type'=>'select','multiple' => true, 'options'=>$phonebook, 'empty'=>'- '.__('Select phone book',true).' -','label'=>false)));
     
     
     echo "<table width='400px' cellspacing='0' class='blue'>";
     echo $this->Html->tableCells($row,array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo $this->Form->end();
     unset($row);


     //** AJAX: Delete phone numbers **//
     echo "<div id ='numbers'>";  
     echo "<table width='400px' cellspacing='0' class='blue'>";
     $row[] = array(array($this->Html->div('table_sub_header',__('Phone numbers',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom')));

     foreach ($phonenumbers as $key => $number){

             $delete = $this->Js->link($this->Html->image("icons/delete.png"),
                                   array('controller' => "phone_numbers", "action" => "delete", $number['PhoneNumber']['id'], $data['User']['id']),
                                   array('update' => '#numbers', 'escape' => false, 'class' => 'numbers'));

             $row[] = array(__('Phone number',true), $number['PhoneNumber']['number'], $delete);



     }
     echo $this->Html->tableCells($row, array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo $this->Form->input('PhoneNumber.user_id', array('type' =>'hidden', 'value' => $data['User']['id']));

     echo "</div>";
     //** END AJAX **//


     //** AJAX: Add phone number **//
       echo "<table cellspacing='0' class='blue'>";
       $add[] = array(
       	      __('Phone number',true), 
       	      $this->Form->input('PhoneNumber.number',array('type' => 'text','label' => false, 'value' => false, 'width' => '30px')), 
	      $this->Js->submit(__('Add phone number',true), array('url' => '/phone_numbers/add', 'update' => '#numbers')),
     	      $this->Form->input('PhoneNumber.user_id', array('type' =>'hidden', 'value' => $data['User']['id'])),
	      );
       echo $this->Html->tableCells($add,array('class' => 'blue'),array('class' => 'blue'));
       echo "</table>";


     echo "</div>";
     //END LEFT FRAME **//

     //** START RIGHT FRAME **//
     echo "<div class='frameRight'>";
     echo "<table width='300px' cellspacing='0' class='blue'>";
     echo $this->Html->tableCells(array (
     array(array($this->Html->div('table_sub_header',__('Statistics',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom'))),
     array(__("In the system since",true),	date('Y-m-d',$data['User']['created'])),
     array(__("Last seen",true),		$last_seen),
     array(__("First application",true),	$this->Formatting->appMatch($data['User']['first_app'])),
     array(__("Last application",true),	     	$this->Formatting->appMatch($data['User']['last_app'])),
     array(array($this->Html->div('table_sub_header',__('Activity',true)),array('colspan'=>2,'height'=>30,'valign'=>'bottom'))),
     array(__("Poll",true),			$data['User']['count_poll']),
    array(__("Voice Menu",true),		$data['User']['count_ivr']),
     array(__("Leave-a-message",true),		$data['User']['count_lam']),
     array(__("SMS",true),		        $data['User']['count_bin']),
     ),array('class' => 'blue'),array('class' => 'blue'));
     echo "</table>";
     echo "</div>";
     //** END RIGHT FRAME **//

    echo "</div>";


    }
    else {

    echo "<h1>".__("No caller with this id exists",true)."</h1>";
    }

 

?>

