<?php
/****************************************************************************
 * disp.ctp	- Display Callback jobs by status (Callback service)
 * version 	- 2.5.1350
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
   echo "<div id='callback_service_div'></div>";                                           
   echo "<div id='user_div' class='user_did'></div>";                                           

   $options = array(1 => __('Start',true), 2 => __('Pause',true),3 => __('Abort',true));
   echo $form->create('CallbackService',array('type' => 'post','action'=> 'status'));

    if ($callback_services){

        foreach($callback_services as $key => $callback_service){

              echo $form->input('Callback.'.$key.'.id',array('type'=>'hidden','value'=>$callback_service['Callback']['id']));
              echo $form->input('Callback.'.$key.'.campaign_id',array('type'=>'hidden','value'=> $callback_service['CallbackService']['id']));
              echo $form->input('Callback.'.$key.'.phone_number',array('type'=>'hidden','value'=>$callback_service['Callback']['phone_number']));
              echo $form->input('Callback.'.$key.'.nf_phone_book_id',array('type'=>'hidden','value'=>$callback_service['CallbackService']['nf_phone_book_id']));
              echo $form->input('Callback.'.$key.'.nf_campaign_id',array('type'=>'hidden','value'=>$callback_service['CallbackService']['nf_campaign_id']));


              $callback_service_link  = $html->link($callback_service['CallbackService']['code'], array('controller' => 'callback_services', 'action' => 'view', $callback_service['CallbackService']['id'] ), array('title' => 'Callback service details', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 400}); return false;"),null,false,false);	
              $user_link  = $html->link($callback_service['User']['name'].' '.$callback_service['User']['surname'], array('controller' => 'users', 'action' => 'view',$callback_service['Callback']['user_id'] ), array('title' => 'User details', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 850}); return false;"),null,false,false);	



              switch ($callback_service['CallbackService']['status']){

                     case 1:
                     //Campaign: started
                     $icon =  $html->image('icons/on.png',array('title' => 'Running')); 
                     break;

                     case 2:
                     //Campaign: paused
                     $icon =  $html->image('icons/clock.png',array('title' => 'Paused')); 
                     break;

                     case 3:
                     //Campaign: aborted
                     $icon =  $html->image('icons/stop.png',array('title' => 'Aborted'));
                     break;

                }

              $row[] = array(
                       $callback_service_link,
                       $icon,
                       array(date('Y-m-d H:i A',$callback_service['CallbackService']['created']), array('align' => 'center')),
                       $user_link,
                       array($this->element ('dialer_status', array('status' => $callback_service['Callback']['status'],'mode' => 'text')), array('align' => 'center')),
                       array($callback_service['Callback']['type'], array('align' => 'center')),
                       array($callback_service['CallbackService']['extension'], array('align' => 'center')),
                       array($callback_service['Callback']['retries'], array('align' => 'center')),
                       $form->input('Callback.'.$key.'.state',array('type'=>'select','options'=>$options,'label'=> false,'selected' => $callback_service['Callback']['state']))
                       );



        }


        echo "<table width='95%' cellspacing  = '0'>";
        echo $html->tableHeaders(array(
	__("Callback service",true),
        false,
	 __("Created",true),
 	 __("User",true), 
 	 __("Call status",true),
 	 __("Type",true),
 	 __("Service ID",true),
 	 __("Attempts",true),
 	 __("Callback status",true)));

        echo $html->tableCells($row);
        echo "</table>";
        echo $form->end(__("Save",true));

     }
        

     echo $ajax->divEnd("service_div");

?>