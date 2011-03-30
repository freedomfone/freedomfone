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

   $options = array(1 => __('Start',true), 2 => __('Pause',true),3 => __('Abort',true));
   echo $form->create('Callback',array('type' => 'post','action'=> 'index'));

    if ($callbacks ){

        foreach($callbacks as $key => $callback){

              echo $form->input('Callback.'.$key.'.id',array('type'=>'hidden','value'=>$callback['Callback']['id']));
              echo $form->input('Callback.'.$key.'.batch_id',array('type'=>'hidden','value'=>$callback['Callback']['batch_id']));
              echo $form->input('Callback.'.$key.'.phone_number',array('type'=>'hidden','value'=>$callback['Callback']['phone_number']));

              $batch_link  = $html->link($callback['Callback']['name'], array('controller' => 'callbacks', 'action' => 'batch',$callback['Callback']['batch_id'] ), array('title' => 'Batch details', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 400}); return false;"),null,false,false);	
              $user_link  = $html->link($callback['User']['name'], array('controller' => 'users', 'action' => 'view',$callback['User']['id'] ), array('title' => 'User details', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 850}); return false;"),null,false,false);	


              switch ($callback['Callback']['batch_status']){

                     case 1:
                     $style = 'color: green '; 
                     break;

                     case 2:
                     $style = 'color: orange '; 
                     break;

                     case 3:
                     $style = 'color: red '; 
                     break;

                }


              $row[] = array(
                       $batch_link,
                       array(date('Y-m-d H:i A',$callback['Callback']['created']), array('align' => 'center')),
                       $user_link,
                       array($this->element ('dialer_status', array('status' => $callback['Callback']['status'],'mode' => 'text')), array('align' => 'center','style' => $style)),
                       array($callback['Callback']['type'], array('align' => 'center')),
                       array($callback['Callback']['extension'], array('align' => 'center')),
                       array($callback['Callback']['retries'], array('align' => 'center')),
                       $form->input('Callback.'.$key.'.batch_status',array('type'=>'select','options'=>$options,'label'=> false,'selected' => $callback['Callback']['batch_status']))
                       );
              

        }

        echo "<table width='95%' cellspacing  = '0'>";
        echo $html->tableHeaders(array(
	 __("Batch",true),
	 __("Created",true),
 	 __("User",true), 
 	 __("Status",true),
 	 __("Type",true),
 	 __("Service ID",true),
 	 __("Attempts",true),
 	 __("Set status",true)));

        echo $html->tableCells($row);
        echo "</table>";

     }
        
     echo $form->end(__("Save",true));
     echo $ajax->divEnd("service_div");

?>