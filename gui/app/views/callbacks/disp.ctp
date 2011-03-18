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

    if ($callbacks ){

        foreach($callbacks as $key => $callback){

              $row[] = array(
                       $callback['Callback']['batch_id'],
                       $callback['Callback']['user_id'],
                       array($callback['Callback']['status'], array('align' => 'center')),
                       array($callback['Callback']['type'], array('align' => 'center')),
                       array($callback['Callback']['extension'], array('align' => 'center')),
                       array($callback['Callback']['retries'], array('align' => 'center')),
                       );
              

        }

        echo "<table width='95%' cellspacing  = '0'>";
        echo $html->tableHeaders(array(
	 $paginator->sort(__("Batch ID",true), 'batch_id'),
 	 $paginator->sort(__("User",true), 'user_id'),
 	 $paginator->sort(__("Status",true), 'status'),
 	 $paginator->sort(__("Type",true), 'type'),
 	 $paginator->sort(__("Service ID",true), 'extension'),
 	 $paginator->sort(__("Attempts",true), 'retries')));

        echo $html->tableCells($row);
        echo "</table>";

     }
        
     echo $ajax->divEnd("service_div");

?>