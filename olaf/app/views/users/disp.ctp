<?php

      echo $ajax->div("service_div");

      
      echo $form->create('User',array('type' => 'post','action'=> 'process','name'  => 'User'));

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

  
     echo "<table width='100%'>";
    echo $html->tableHeaders(array(
	'',
	$paginator->sort(__("New",true), 'new'),
 	$paginator->sort(__("Name",true), 'name'),
 	$paginator->sort(__("Surname",true), 'surname'),
 	$paginator->sort(__("Email",true), 'email'),
	$paginator->sort(__("Skype",true), 'skype'),
 	$paginator->sort(__("Acl",true), 'Acl.name'),
 	$paginator->sort(__("Phone",true), 'phone'),
	__("Edit",true),
	__("Delete",true)));

     echo $html->tableCells($row);
     echo "</table>";
  

    echo "<table>";
     echo $html->tableCells(array(
     $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
     $form->submit( __('Merge',true), array('name' =>'data[Submit]', 'class' => 'button')), 
     $paginator->numbers()));
     echo "</table>";
     echo $form->end();


     echo $ajax->divEnd("service_div");

?>