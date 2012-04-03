<?php
/****************************************************************************
 * index.ctp	- List all Campaigns
 * version 	- 2.5.1300
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
echo $html->addCrumb(__('Campaign',true), '/campaigns');
$callback_default  = Configure::read('CALLBACK_DEFAULT');

echo $form->create('Campaign',array('type' => 'post','action'=> 'status'));
echo $html->div('frameRightTrans',$form->submit(__('Status',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

echo $form->create('Campaign',array('type' => 'post','action'=> 'add'));
echo $html->div('frameRightTrans',$form->submit(__('Create',true),  array('name' =>'submit', 'class' => 'button')));
echo $form->end();

     echo "<h1>".__("Campaigns",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }


     if($campaigns){


             foreach ($campaigns as $key => $campaign){

                     $row[$key] = array(
                        $campaign['Campaign']['name'],
                        $campaign['PhoneBook']['name'],
                        $formatting->appMatch($campaign['Campaign']['application']),
                        $campaign['Campaign']['service_name'],
                        $callback_default['campaign_status'][$campaign['Campaign']['status']],
                        $campaign['Campaign']['start_time'],
                        $campaign['Campaign']['end_time'],
                        array($html->link($html->image("icons/view.png", array("title" => __("Campaign status",true))), array('controller' => 'campaigns', 'action' => 'overview',$campaign['Campaign']['id'] ), array('title' => 'Campaign status', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 400}); return false;"),null,false,false),array('align' => 'center')),
                        array($ajax->link($html->image("icons/delete.png"),'/campaigns/delete/'.$campaign['Campaign']['id'], array('update' => 'campaign'), null, 1), array('align' => 'center')),
                        );


              }

           echo "<div id ='campaign'>";  
        echo "<table width='95%' class='collapsed' cellspacing=0>";
        echo $html->tableHeaders(array(
 	     $paginator->sort(__("Campaign",true), 'name'),
 	     $paginator->sort(__("Phone book",true), 'PhoneBook.name'),
 	     $paginator->sort(__("Application",true), 'application'),
 	     $paginator->sort(__("Name",true), 'service_name'),
 	     $paginator->sort(__("Status",true), 'status'),
	     $paginator->sort(__("Start time",true), 'start_time'),
	     $paginator->sort(__("End time",true), 'end_time'),
             __('Overview',true),
             __('Delete',true)));


              echo $html->tableCells($row,array('class'=>'darker'));
              echo "</table>";
              echo "</div>";

             } else {


               echo $html->div('feedback',__('There are no campaigns in the system.', true));

             }


?>

