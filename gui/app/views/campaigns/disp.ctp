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
   echo "<div id='campaign_div' class='campaign_did'></div>";                                           
   echo "<div id='user_div' class='user_did'></div>";                                           

   $options = array(1 => __('Start',true), 2 => __('Pause',true),3 => __('Abort',true));
   echo $form->create('Campaign',array('type' => 'post','action'=> 'index'));

    if ($campaigns){
    $j=0;
        foreach($campaigns as $key => $campaign){


            foreach ($campaign['Callback'] as $i => $callback){

              echo $form->input('Callback.'.$j.'.id',array('type'=>'hidden','value'=>$callback['id']));
              echo $form->input('Callback.'.$j.'.campaign_id',array('type'=>'hidden','value'=>$campaign['Campaign']['id']));
              echo $form->input('Callback.'.$j.'.phone_number',array('type'=>'hidden','value'=>$callback['phone_number']));
              echo $form->input('Callback.'.$j.'.dialer_id',array('type'=>'hidden','value'=>$campaign['Campaign']['dialer_id']));

              $campaign_link  = $html->link($campaign['Campaign']['name'], array('controller' => 'campaigns', 'action' => 'view', $campaign['Campaign']['id'] ), array('title' => 'Campaign details', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 400}); return false;"),null,false,false);	
              $user_link  = $html->link(__('User details',true), array('controller' => 'users', 'action' => 'view',$callback['user_id'] ), array('title' => 'User details', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 850}); return false;"),null,false,false);	


              switch ($campaign['Campaign']['status']){

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
                       $campaign_link,
                       array(date('Y-m-d H:i A',$campaign['Campaign']['created']), array('align' => 'center')),
                       $user_link,
                       array($this->element ('dialer_status', array('status' => $campaign['Campaign']['status'],'mode' => 'text')), array('align' => 'center','style' => $style)),
                       array($callback['type'], array('align' => 'center')),
                       array($campaign['Campaign']['extension'], array('align' => 'center')),
                       array($callback['retries'], array('align' => 'center')),
                       $form->input('Callback.'.$j.'.status',array('type'=>'select','options'=>$options,'label'=> false,'selected' => $callback['status']))
                       );
                       $j++;

            }              

        }

        echo "<table width='95%' cellspacing  = '0'>";
        echo $html->tableHeaders(array(
	 __("Campaign",true),
	 __("Created",true),
 	 __("User",true), 
 	 __("Campaign status",true),
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