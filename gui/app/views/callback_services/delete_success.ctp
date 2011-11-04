<?php
/****************************************************************************
 * delete_success.ctp	- list all Callback Services
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

        if ($data){

           echo "<div id ='callback_services'>";  
           foreach ($data as $key => $entry){

                   $delete = $ajax->link($html->image("icons/delete.png"),'/callback_services/delete/'.$entry['CallbackService']['id'], array('update' => 'callback_services'), null, 1);
	           $edit   = $html->link($html->image("icons/edit.png", array("title" => __("Edit",true))),"/callback_services/edit/{$entry['CallbackService']['id']}",null, null, false);

                   $row[$key] = array(
                                $entry['CallbackService']['code'],
                                $formatting->appMatch($entry['CallbackService']['application']),
                                $entry['CallbackService']['service_name'],
                                $entry['CallbackService']['max_calls_total'],
                                $entry['CallbackService']['calls_total'],
                                $entry['CallbackService']['start_time'],
                                $entry['CallbackService']['end_time'],
		                array($edit.' '.$delete,array('align'=>'center'))
                                );

           }

            echo "<table width='90%' cellspacing =0>";
            echo $html->tableHeaders(array(__("SMS Code",true),__("Application",true),__("Name",true),__("Max calls total",true),__("Calls placed",true),__("Start time",true),__("End time",true),__("Actions",true)));
            echo $html->tableCells($row);
            echo "</table>";
            echo "</div>";

         }
