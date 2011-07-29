<?php 
/****************************************************************************
 * edit.ctp	- Edit existing phone books (used in Contacts)
 * version 	- 2.0.1139
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

echo $html->addCrumb('User Management', '');
echo $html->addCrumb('Phone books', '/phone_books');
echo $html->addCrumb('Edit', '/phone_books/edit/'.$this->data['PhoneBook']['id']);



if($this->data){

	echo "<h1>".__("Edit Phone book",true)."</h1>";
	$session->flash();
	
	$options_name = array('label' =>  array('text'=>false), 'type'=>'text','size'=>'20', 'div'=>'cell2');
	$options_longname = array('label' =>  array('text'=>false), 'type'=>'text','size'=>'50');


	echo $form->create('PhoneBook',array('type' => 'post','action'=> 'edit'));
	echo $form->hidden('id');


	echo "<div class='row'>";
		echo $html->div('cell1 label', 'Name');
		echo $form->input('name', array('label' => false, 'type'=>'text','size'=>'20', 'div'=>'cell2'));
	echo "</div>";
	echo "<div class='row'>";
		echo $html->div('cell1 label', 'Description');
		echo $form->input('description', array('label' =>  false, 'type'=>'text','size'=>'20', 'div'=>'cell2'));
	echo "</div>";
	
	echo "<select name='data[User][User][]' class='hiddenSelect' multiple='multiple' id='UsersSelect'>";
	$usersSelect = $users;	
	while ($userSelect = current($usersSelect)) {
		$userSelectDetail= $userSelect['User'];
		echo "<option value='".$userSelectDetail['id']."'>".$userSelectDetail['name']."</option>";
		next($usersSelect);
	}
	echo "</select>";
	
	echo "<div class='listAll users'>";
		echo "<div class='listHeader'>";
			echo $html->div('listTitle', 'All Users');
			echo $html->div('listAction', 'add all');
		echo "</div>";
		echo "<div class='listUsers'>";
			while ($user = current($users)) {
				$userDetail= $user['User'];
				echo "<div class='user' title='".$userDetail['id']."'>";
					echo "<div class='userName'>".$userDetail['name']." ".$userDetail['surname']."</div>";
					echo "<div class='userDetail'>";
						echo "<div class='userContactDetails'>";
							echo $html ->div('contact', 'tel: ' .$user['PhoneNumber'][0]['number']);
							echo $html ->div('contact', 'skype: '.$userDetail['skype']);
						echo "</div>";
						echo $html->div('contactAction add', 'click to add');
					echo "</div>";
				echo "</div>";
				next($users);
			}
			?>
			<div class="note">
				<div class="noteTitle">HINT:</div>
				<div class="noteDetail">Clicking 'click to add' will add the contact to your selected users list</div>
			</div>
			<?php
			
		echo "</div>";
	echo "</div>";
	$selectedUsers = $this->data['User'];
	
	echo "<div class='listSelected users'>";
		echo "<div class='listHeader'>";
			echo $html->div('listTitle', 'Selected Users');
			echo $html->div('listAction', 'remove all');
		echo "</div>";
		echo "<div class='listUsers'>";
			while ($user = current($selectedUsers)) {
				echo "<div class='user' title='".$user['id']."'>";
					echo "<div class='userName'>".$user['name']."</div>";
					echo "<div class='userDetail'>";
						
						echo $html->div('contactAction remove', 'click to remove');
					echo "</div>";
				echo "</div>";
				next($selectedUsers);
			}
			?>
			<div class="note">
				<div class="noteTitle">NOTE:</div>
				<div class="noteDetail">Clicking "remove all" will not remove the user from the system, just remove them from this list</div>
			</div>
			<?php
		echo "</div>";
	echo "</div>";
	
	echo "<div class='buttons'>";				
		echo $form->end(array('label'=>'Save', 'class'=>'saveBtn button', 'div'=>false));
		echo $form->button('Cancel', array('type'=>'reset', 'class'=>'cancelBtn button'));
	echo "</div>";

} else {
	echo "<h1>".__("No phone book with this id exists",true)."</h1>";
}



?>