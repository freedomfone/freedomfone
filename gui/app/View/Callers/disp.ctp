<?php
      
      echo $form->create('Caller',array('type' => 'post','action'=> 'process','name'  => 'Caller'));

      foreach ($callers as $key => $caller){

      $status='';
	$id = "<input name='caller[$key]['Caller']' type='checkbox' value='".$caller['Caller']['id']."' id='check' class='check'>";

	if($caller['Caller']['new']){
		$status = $html->image("icons/star.png",array("title" => __("New",true)));
	}

	$name     = $caller['Caller']['name'];
	$surname     = $caller['Caller']['surname'];
	$email     = $text->autoLinkEmails($caller['Caller']['email']);
	$skype     = $caller['Caller']['skype'];
	$acl       = $caller['Acl']['name'];

        $phone = false;
        $phone_numbers = false;

        if($phone_numbers  = sizeof($caller['PhoneNumber'])){
                $phone     = $caller['PhoneNumber'][0]['number'];
                               
        } 


        $popup = false;
	$edit     = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/callers/edit/{$caller['Caller']['id']}",null, null, false);

	$delete   = $this->Html->image("icons/delete.png", array("alt" => __("Delete",true), "title" => __("Delete",true), "url" => array("controller" => "callers", "action" => "delete", $caller['Caller']['id'])));
	//$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/callers/delete/{$caller['Caller']['id']}",null, __("Are you sure you want to delete this caller?",true),false);
        if ($phone_numbers > 1) { 
        $info = __('Phone numbers',true).'|';

             foreach($caller['PhoneNumber'] as  $number){
 
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


?>