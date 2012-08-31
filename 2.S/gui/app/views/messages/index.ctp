<?php
/****************************************************************************
 * index.ctp	- List all Leave-a-message messages
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

      echo $javascript->includeScript('toggle');

      echo $html->addCrumb(__('Message Centre',true), '');
      echo $html->addCrumb(__('Inboxes',true), '/messages');

      echo "<h1>".__('Audio Messages',true)."</h1>";
      echo $html->div('feedback', __('Please select one or more criteria below.',true));
      $rates = array(1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5);
      $limits = array(10 => 10, 25 => 25, 50 => 50);
      $order = array('Category.id' => __('Category',true),'Message.rate' => __('Rate',true), 'Message.instance_id' => __('Service',true),'Message.length' => __('Length',true), 'Message.created' => __('Time',true),'Message.new' => __('New message',true));
      $dir = array('ASC' => __('Ascending', true), 'DESC' => __('Descending',true));

      $instances = array_unique($instances);

      foreach ($instances as $key => $instance){

       $services[$instance] = '2'.$instance;

       //Addition by Tich: adding option for "All" and sorting that All is first option	
       $services[99] = 'All';
       ksort($services);
       //End of addition by Tich

      }

      $session->flash();
      echo $form->create("Message");

      $input1 = $form->input('tag', array('id' => 'ServiceType1','type' => 'select', 'options' => $tags, 'label' => false, 'empty' => '-- '.__("Tag",true).' --'));
      $input2 = $form->input('category', array('id' => 'ServiceType2','type' => 'select', 'options' => $categories, 'label' => false, 'empty' => '-- '.__("Category",true).' --'));
      $input3 = $form->input('rate', array('id' => 'ServiceType3','type' => 'select', 'options' => $rates, 'label' => false, 'empty' => '-- '.__("Rate",true).' --'));
      //Addition by Tich: making "All" default selection
      $input4 = $form->input('service', array('id' => 'ServiceType4','type' => 'select', 'options' => $services, 'label' => false, 'default' => '99'));
      //End of addition by Tich

      $input5 = $form->input('order', array('id' => 'ServiceType5','type' => 'select', 'options' => $order, 'label' => false, 'empty' => '-- '.__("Order by",true).' --'));
      $input6 = $form->input('dir', array('id' => 'ServiceType6','type' => 'select', 'options' => $dir, 'label' => false, 'empty' => '-- '.__("Sorting direction",true).' --'));
      $input7 = $form->input('limit', array('id' => 'ServiceType7','type' => 'select', 'options' => $limits, 'label' => false, 'empty' => '-- '.__("Entries per page",true).' --'));

      $row1[] = array(array($html->div('table_sub_header',__('Selection criteria',true)), array('colspan'=> 4)));
      $row1[] = array($input1,$input2,$input3,$input4);

      echo "<table cellspacing=0 class='none'>";
      echo $html->tableCells($row1, array('class' => 'none'), array('class' => 'none'));
      echo "</table>";


      $row2[] = array(array($html->div('table_sub_header',__('Order and direction',true)), array('colspan'=> 3)));
      $row2[] = array($input5,$input6,$input7);

      echo "<table cellspacing=0 class='none'>";
      echo $html->tableCells($row2, array('class' => 'none'), array('class' => 'none'));
      echo "</table>";
      /*Addition by Tich: Changing position of service_div so that the default landing page can be overwriiten by the      ajax call */
      echo $ajax->div("service_div");
      //End of Addition by Tich

      $opt = array("update" => "service_div", "url" => "disp", "frequency" => "0.2");
      echo $ajax->observeForm("MessageIndexForm", $opt);
      echo $form->end();

      //Addition by Tich: comment out service_div below so that ajax call does not result in displaying 2 inbox tables

      /*echo "<div id= 'service_div' style=''></div>"; */


      // Additions by Tich: Table to display all messages on the inbox landing page


      echo $form->create('Message',array('type' => 'post','action'=> 'index'));
      echo $html->div('frameRightAlone', $form->submit(__('Refresh',true),  array('name' =>'disp', 'class' => 'button')));
      echo $form->end();
      echo $this->Access->showCheckbox($authGroup, 'document.Message','frameRightTrans');
      $ext = Configure::read('EXTENSIONS');

      if ($messages){


      echo $html->div("",$paginator->counter(array('format' => __("Message:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% "))); 
      echo $form->create('Message',array('type' => 'post','action'=> 'process','name'  => 'Message'));
      echo $form->hidden('source',array('value'=>'index'));


      echo $html->div('empty',false);
      echo "<table width='95%' cellspacing  = '0'>";
      echo $html->tableHeaders(array(
	'',
	__("New",true),
 	__("Service",true),
 	__("Title",true),
 	__("Caller",true),
 	__("Rate",true),
 	__("Category",true),
 	__("Date",true),
 	__("Length",true),
        __("Actions",true),
	__("Listen",true)));

 
      foreach ($messages as $key => $message){

        $status='';
	$id = "<input name='message[$key]['Message']' type='checkbox' value='".$message['Message']['id']."' id='check' class='check'>";

	if($message['Message']['new']){ $status = $html->image("icons/star.png",array("title" => __("New",true)));}
        $service      = $message['Message']['instance_id'];
        $title      = $message['Message']['title'];
        $title_div  = $html->div('',$text->truncate($title,20,array('ending' => '...','exact' => true,'html' => false)),array('title' => $title),false);
	$sender     = $this->Access->showBlock($authGroup, $message['Message']['sender']);
	$rate       = $this->element('message_status',array('rate'=>$message['Message']['rate']));
	$category   = $message['Category']['name'];
	$created    = date('y/m/d H:i',$message['Message']['created']);
	$length     = $formatting->epochToWords($message['Message']['length']);

        $edit       = $this->Html->image("icons/edit.png", array("alt" => __("Edit",true), "title" => __("Edit",true), "url" => array("controller" => "messages", "action" => "edit", $message['Message']['id'])));
        $download   = $this->Html->image("icons/music.png", array("alt" => __("Download",true), "title" => __("Download",true), "url" => array("controller" => "messages", "action" => "download", $message['Message']['id'])));
	$listen     = $this->element('player',array('url'=>$message['Message']['url'],'file'=>$message['Message']['file'],'title'=>$title,'id'=>$message['Message']['id']));

        $row[$key] = array($id,
     		array($status,array('align'=>'center')),
                array($ext['lam'].$service,array('align'=>'center')),
		array($title_div, array('width' => '110px')),
                $sender,
		array($rate,array('align'=>'center')),
		array($category,array('align'=>'center')),
		$created,		
		array($length,array('align'=>'center')),
		array($edit.' '.$this->Access->showBlock($authGroup, $download ) ,array('align'=>'center')),
		array($listen,array('align'=>'center')));
		

	} 


     echo $html->tableCells($row);
     echo "</table>";

     if($authGroup == 1) {
                   echo "<table cellspacing = 0 class = 'none'>";
                   echo $html->tableCells(array(__('Perform action on selected',true).': ',
                   $form->submit(__('Delete',true),  array('name' =>'data[Submit]', 'class' => 'button')),
                   $form->submit( __('Move to Archive',true), array('name' =>'data[Submit]', 'class' => 'button'))),array('class' => 'none'),array('class' => 'none'));
                   echo "</table>";
     }


     if($paginator->counter(array('format' => '%pages%'))>1){
           echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));


        $prev = $ajax->link('«'.__('Previous',true),"/messages/disp/2", array('update' => 'service_div'), null, 1); 

        $next = $ajax->link(__('Next',true).'»','/messages/disp/2', array('update' => 'service_div'), null, 1); 

        echo  $html->div('paginator', $prev.$next);

    }


     } else {

     echo $html->div('feedback', __('No records found.',true));

     }

     echo $ajax->divEnd('service_div');
//End of addition by Tich 
?>
