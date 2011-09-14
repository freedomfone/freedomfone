<?php
/****************************************************************************
 * index.ctp	- List monitoring data for Voice Menus
 * version 	- 2.0.1160
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

echo $html->addCrumb(__('System data',true), '');
echo $html->addCrumb(__('Monitoring',true), '/monitor_ivr');



$session->flash();
echo $javascript->includeScript('toggle');


$msg_delete = 'return confirmSubmit("'.__("Are you sure that you want to delete the selected entries?",true).'")';

echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'index'));
echo $html->div('frameRightAlone',$form->submit(__('Refresh',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'output'));
echo $html->div('frameRightAlone',$form->submit(__('Export all',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'export'));
echo $html->div('frameRightAlone',$form->submit(__('Export',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'delete'));
echo $html->div('frameRightAlone',$form->submit(__('Delete',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();



echo "<h1>".__('Monitoring of Voice Menus',true)."</h1>";


     if ($data){

     echo $html->div("",$paginator->counter(array('format' => __("Entries:",true)." %start% ".__("-",true)." %end% ".__("of",true)." %count% ")));
     echo $form->create('MonitorIvr',array('type' => 'post','action'=> 'process','name'  => 'MonitorIvr'));
     
     ?>
     <input class="button" type="button" name="CheckAll" value="<?php echo __("Check All",true);?>" onClick="checkAll(document.MonitorIvr)">
     <input class="button" type="button" name="UnCheckAll" value="<? echo __("Uncheck All",true);?>" onClick="uncheckAll(document.MonitorIvr)">
     <?
     echo $form->submit(__('Delete selected',true),  array('name' =>'data[Submit]', 'class' => 'button','onClick'=>$msg_delete));

     echo "<table width='95%' cellspacing=0>";
     echo $html->tableHeaders(array(
	'',
 	$paginator->sort(__("Date (YMD)",true), 'epoch'),
 	$paginator->sort(__("Time",true), 'epoch'),
 	$paginator->sort(__("Call ID",true), 'call_id'),
 	$paginator->sort(__("Caller ID",true), 'caller_number'),
 	$paginator->sort(__("From",true), 'ivr_code'),
 	$paginator->sort(__("Pressed",true), 'digit'),
 	$paginator->sort(__("To",true), 'service'),
 	$paginator->sort(__("Title",true), 'title'),

 	$paginator->sort(__("Type",true), 'type'),
	''));

	$call_id_old=false;
	$class='lighter';

      foreach ($data as $key => $entry){


	$id = "<input name='monitor_ivr[$key][MonitorIvr]' type='checkbox' value='".$entry['MonitorIvr']['id']."' id='check' class='check'>";
	$date  	     = date('Y-m-d',$entry['MonitorIvr']['epoch']);
	$time  	     = date('H:i:s',$entry['MonitorIvr']['epoch']);
	$ivr_code    = $text->truncate($entry['MonitorIvr']['ivr_code'],20,'...',true,false);
	$call_id     = $text->truncate($entry['MonitorIvr']['call_id'],8,false,true,false);
	$digit       = $entry['MonitorIvr']['digit'];
	
	$caller_number  = $entry['MonitorIvr']['caller_number'];


	$type_tmp = $entry['MonitorIvr']['type'];
        $title = false;
	$service = false;

        if($type_tmp =='CS_ROUTING'){ 
                 $type   = __("start",true);
         
        } elseif ($type_tmp =='CS_DESTROY'){ 
                $type=__("end",true);

        } elseif ($type_tmp == 'tag'){

                 $type=__("tag",true);
                 $service = $this->element('services',array('service' => $entry['MonitorIvr']['service']));
                 $title  = $text->truncate($entry[$entry['MonitorIvr']['service']]['title'],13,'...',true,false);

        }




	if (!$caller_number = $entry['MonitorIvr']['caller_number']) {  $caller_number='';}
	$delete   = $html->link($html->image("icons/delete.png", array("title" => __("Delete",true))),"/monitor_ivr/del/{$entry['MonitorIvr']['id']}",null, __("Are you sure you want to delete this entry?",true),false);

		//change class
		if($call_id_old != $call_id){ 
				if($class=='darker'){ $class='lighter';}
				else { $class='darker';}
		$call_id_old=$call_id;
		}

     $row = array($id,
		$date,
		$time,
		$call_id,
		$caller_number,
		$ivr_code,
		array($digit,array('align'=>'center')),
                $service,
		$title,
		array($type,array('align'=>'center')),
		array($delete,array('align'=>'center'))
		);

		
 	echo $html->tableCells($row,array('class'=>$class),null,null,null);
	
	}


     echo "</table>";
     echo $form->end();

     if($paginator->counter(array('format' => '%pages%'))>1){
           echo $html->div('paginator', $paginator->prev('«'.__('Previous',true), array( 'class' => 'PrevPg'), null, array('class' => 'PrevPg DisabledPgLk')).' '.$paginator->numbers().' '.$paginator->next(__('Next',true).'»',array('class' => 'NextPg'), null, array('class' => 'NextPg DisabledPgLk')));
     }


     echo $html->div('paginator', __("Entries per page ",true).$html->link('25','index/limit:25',null, null, false)." | ".$html->link('50','index/limit:50',null, null, false)." | ".$html->link('100','index/limit:100',null, null, false));


     }  else {

     echo $html->div('feedback', __('No records found.',true));

     }

?>