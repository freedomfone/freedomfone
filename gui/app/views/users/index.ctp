<?php
/****************************************************************************
 * index.ctp	- List all users in system
 * version 	- 1.0.362
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


echo $javascript->includeScript('toggle');

echo $form->create('User',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRightAlone', $form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('User',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRight',$form->submit(__('Add user',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();


     echo "<h1>".__('Users',true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
     }

   

     if ($users){

     echo $form->create('User',array('type' => 'post','action'=> 'index','name'  => 'phone_book'));
     echo "<table cellspacing = '0' class='none'>";
     echo $html->tableCells(array($form->input('phone_book_id',array('id'=>'ServiceType','type'=>'select','options'=>$options,'label'=> false,'empty'=>'-- '.__('Select phone book',true).' --')), $form->submit(__('Submit',true),array('name' =>'submit','class' =>'button'))), array('class' => 'none'));

     
     ?>
     <tr class='none'><td><input type="button" class="button" name="CheckAll" value="<? echo __('Check All',true);?>" onClick="checkAll(document.User)"></td>
     <td><input type="button" class="button" name="UnCheckAll" value="<? echo __('Uncheck All',true);?>" onClick="uncheckAll(document.User)"></td></tr>
     <?
     echo "</table>";
     echo $form->end();


     echo $html->div('space', false);
     echo $html->div("paginator'",$paginator->counter(array('format' => __("User:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
     echo $form->create('User',array('type' => 'post','action'=> 'process','name'  => 'User'));

     echo "<table width='800px' class='collapsed' cellspacing=0>";
     echo $html->tableHeaders(array(
	'',
	$paginator->sort(__("New",true), 'User.new'),
 	$paginator->sort(__("Name",true), 'User.name'),
 	$paginator->sort(__("Surname",true), 'User.surname'),
 	$paginator->sort(__("Email",true), 'User.email'),
	$paginator->sort(__("Skype",true), 'User.skype'),
 	$paginator->sort(__("Acl",true), 'Acl.name'),
 	$paginator->sort(__("Phone",true), 'User.phone'),
	__("Edit",true),
	__("Delete",true)));

 
      foreach ($users as $key => $user){

      $status='';
	$id = "<input name='user[$key]['User']' type='checkbox' value='".$user['User']['id']."' id='check' class='check'>";

	if($user['User']['new']){
		$status = $html->image("icons/star.png",array("title" => __("New",true)));
	}

	$name     = $user['User']['name'];
	$surname     = $user['User']['surname'];
	$email     = $text->autoLinkEmails($user['User']['email']);
	$skype     = $user['User']['skype'];
	$acl       = $user['Acl']['name'];

        $phone = false;
        $phone_numbers = false;

        if($phone_numbers  = sizeof($user['PhoneNumber'])){
                $phone     = $user['PhoneNumber'][0]['number'];
                               
        } 


        $popup = false;
	$edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/users/edit/{$user['User']['id']}",null, null, false);
	$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/users/delete/{$user['User']['id']}",null, __("Are you sure you want to delete this user?",true),false);
        if ($phone_numbers > 1) { 
           $info = __('Phone numbers',true).'|';

             foreach($user['PhoneNumber'] as  $number){
 
               $info = $info.$number['number'].'|';
              
             }

             $phone = $html->div('frameInfoLeft', $phone.' '.$html->link($html->image('icons/plus.png',array('alt'=>__('Alternative phone numbers',true))),'#',array('class'=>'infobox','title'=>$info),null,false));
        }

        $row[$key] = array($id,
     		array($status,array('align'=>'center')),
		$name,
		$surname,
		$email,
		$skype,
		$acl,
		$phone,		
		$edit,
		$delete);
	}
     
       echo $html->tableCells($row,array('class'=>'darker'));
       echo "</table>";


       echo "<table cellspacing = '0' class='none'>";
       echo $html->tableCells(array(
       $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
       $form->submit( __('Merge',true), array('name' =>'data[Submit]', 'class' => 'button'))),array('class'=>'none'),array('class'=>'none'));
       echo "</table>";
       echo $form->end();

     if($paginator->counter(array('format' => '%pages%'))>1){
           echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }

     echo $html->div('paginator', __("Entries per page ",true).$html->link('10','index/limit:10',null, null, false)." | ".$html->link('25','index/limit:25',null, null, false)." | ".$html->link('50','index/limit:50',null, null, false));

     }

?>
