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

$callback_default  = Configure::read('CALLBACK_DEFAULT');

     if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
        }


        if ($data){

           echo "<div id ='campaign'>";  
           foreach ($data as $key => $campaign){

                     $row[$key] = array(
                        $campaign['Campaign']['name'],
                        $formatting->appMatch($campaign['Campaign']['application']),
                        $campaign['Campaign']['service_name'],
                        $callback_default['campaign_status'][$campaign['Campaign']['status']],
                        $campaign['Campaign']['start_time'],
                        $campaign['Campaign']['end_time'],
                        $ajax->link($html->image("icons/delete.png"),'/campaigns/delete/'.$campaign['Campaign']['id'], array('update' => 'campaign'), null, 1),
                        );
           }




        echo "<table width='800px' class='collapsed' cellspacing=0>";
        echo $html->tableHeaders(array(
 	     $paginator->sort(__("Campaign",true), 'name'),
 	     $paginator->sort(__("Application",true), 'application'),
 	     $paginator->sort(__("Name",true), 'service_name'),
 	     $paginator->sort(__("Status",true), 'status'),
	     $paginator->sort(__("Start time",true), 'start_time'),
	     $paginator->sort(__("End time",true), 'end_time'),
             __('Delete',true)));


              echo $html->tableCells($row,array('class'=>'darker'));
              echo "</table>";
              echo "</div>";



         }
