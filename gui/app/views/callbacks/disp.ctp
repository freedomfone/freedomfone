<?php
/****************************************************************************
 * disp.ctp	- Display Callback jobs by status
 * version 	- 2.5.1200
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




   echo $ajax->div("service_div");
   echo "<div id='batch_div' class='batch_did'></div>";                                           
   echo "<div id='user_div' class='user_did'></div>";                                           


    if ($callbacks ){

        foreach($callbacks as $key => $callback){

              $batch_link = $ajax->link($callback['Callback']['batch_id'],'/callbacks/batch/'.$callback['Callback']['batch_id'].'/', array('update' => 'batch_div'), null, 1);
              $user_link  = $ajax->link($callback['User']['name'].' '.$callback['User']['surname'],'/callbacks/user/'.$callback['Callback']['user_id'].'/', array('update' => 'user_div'), null, 1);


              $row[] = array(
                       $batch_link,
                       array(date('Y-m-d H:i A',$callback['Callback']['created']), array('align' => 'center')),
                       $user_link,
                       array($callback['Callback']['status'], array('align' => 'center')),
                       array($callback['Callback']['type'], array('align' => 'center')),
                       array($callback['Callback']['extension'], array('align' => 'center')),
                       array($callback['Callback']['retries'], array('align' => 'center')),
                       );
              

        }

        echo "<table width='95%' cellspacing  = '0'>";
        echo $html->tableHeaders(array(
	 __("Batch ID",true),
	 __("Created",true),
 	 __("User",true), 
 	 __("Status",true),
 	 __("Type",true),
 	 __("Service ID",true),
 	 __("Attempts",true)));

        echo $html->tableCells($row);
        echo "</table>";

     }
        
     echo $ajax->divEnd("service_div");

?>