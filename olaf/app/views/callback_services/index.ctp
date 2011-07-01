<?php
/****************************************************************************
 * index.ctp	- list all Cllback Services
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
echo $html->addCrumb('Callback Service', '/callback_services');


     echo "<h1>".__("Callback Services",true)."</h1>";

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }

        echo $form->create('CallbackService',array('type' => 'post','action'=> 'add'));
        echo $html->div('frameRightAlone',$form->submit(__('Create new',true),  array('name' =>'submit', 'class' => 'button')));
        echo $form->end();

        echo $form->create('CallbackService',array('type' => 'post','action'=> 'status'));
        echo $html->div('frameRightAlone',$form->submit(__('Call status',true),  array('name' =>'submit', 'class' => 'button')));
        echo $form->end();

        if ($services){

        echo $form->create('CallbackService',array('type' => 'post','action'=> 'index', 'enctype' => 'multipart/form-data'));
           foreach ($services as $key => $entry){

                   $delete = $ajax->link($html->image("icons/delete.png"),'/callback_services/delete/'.$entry['CallbackService']['id'], array('update' => 'callback_services'), null, 1);
	           $edit   = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/callback_services/edit/{$entry['CallbackService']['id']}",null, null, false);
                   $tickle = $form->radio('tickle',array($entry['CallbackService']['id'] => ''),array('legend' => false, 'default' => $entry['CallbackService']['tickle']));
                   $row[$key] = array(
                                $tickle,
                                $entry['CallbackService']['code'],
                                $formatting->appMatch($entry['CallbackService']['application']),                                
                                $entry['CallbackService']['service_name'],
                                array($entry['CallbackService']['max_calls_total'], array('align' => 'center')),
                                array($entry['CallbackService']['calls_total'], array('align' => 'center')),
                                $entry['CallbackService']['start_time'],
                                $entry['CallbackService']['end_time'],
		                array($edit.' '.$delete,array('align'=>'center'))
                                );

           }


           echo "<div id ='callback_services'>";  
            echo "<table width='90%' cellspacing =0>";

            echo $html->tableHeaders(array(
                             __('Tickle',true),
                  	     $paginator->sort(__("SMS Code",true), 'code'),
                  	     $paginator->sort(__("Application",true), 'application'),
                  	     $paginator->sort(__("Name",true), 'service_name'),
                      	     $paginator->sort(__("Max calls total",true), 'max_calls_total'),
                      	     $paginator->sort(__("Calls placed",true), 'calls_total'),
                      	     $paginator->sort(__("Start time",true), 'start_time'),
                      	     $paginator->sort(__("End time",true), 'end_time'),
                             __('Actions',true),
                             ));

            echo $html->tableCells($row);
            echo "</table>";
            echo "</div>";
      echo $form->end(__('Save',true));


         }
