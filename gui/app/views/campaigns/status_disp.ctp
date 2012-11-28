<?php
/****************************************************************************
 * status_disp.ctp	- Display Callback jobs by status
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

   $options1 = array(1 => __('Start',true), 3 => __('Abort',true));
   $options2 = array(2 => __('Pause',true),3 => __('Abort',true));

   echo $form->create('Campaign',array('type' => 'post','action'=> 'status'));

    if ($campaigns){

        foreach($campaigns as $key => $campaign){

              echo $form->input('Callback.'.$key.'.id',array('type'=>'hidden','value'=>$campaign['Callback']['id']));
              echo $form->input('Callback.'.$key.'.campaign_id',array('type'=>'hidden','value'=>$campaign['Campaign']['id']));
              echo $form->input('Callback.'.$key.'.phone_number',array('type'=>'hidden','value'=>$campaign['Callback']['phone_number']));
              echo $form->input('Callback.'.$key.'.nf_phone_book_id',array('type'=>'hidden','value'=>$campaign['Campaign']['nf_phone_book_id']));
              echo $form->input('Callback.'.$key.'.nf_campaign_id',array('type'=>'hidden','value'=>$campaign['Campaign']['nf_campaign_id']));


              $campaign_link  = $html->link($campaign['Campaign']['name'], array('controller' => 'campaigns', 'action' => 'view', $campaign['Campaign']['id'] ), array('title' => 'Campaign details', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 400}); return false;"),null,false,false);	
              $user_link  = $html->link($campaign['User']['name'].' '.$campaign['User']['surname'], array('controller' => 'users', 'action' => 'view',$campaign['Callback']['user_id'] ), array('title' => 'User details', 'onclick' => "Modalbox.show(this.href, {title: this.title, width: 850}); return false;"),null,false,false);	


              switch ($campaign['Campaign']['status']){

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
	
	     $status = $campaign['Callback']['status'];
	     if( $status == 2){
	        $change_status = $form->input('Callback.'.$key.'.status',array('type'=>'select','options'=>$options1,'label'=> false,'empty' => '-- '.__("Change status",true).' --'));
	     } elseif ($status == 1 || $status == 6 ){
	        $change_status = $form->input('Callback.'.$key.'.status',array('type'=>'select','options'=>$options2,'label'=> false,'empty' => '-- '.__("Change status",true).' --'));
	     } else {

	        $change_status = false;
	     }

              $row[] = array(
                       $icon.'&nbsp;&nbsp;'.$campaign_link,
                       array(date('Y-m-d H:i A',$campaign['Campaign']['created']), array('align' => 'center')),
                       $user_link,
                       array($campaign['Campaign']['extension'], array('align' => 'center')),
                       array($campaign['Callback']['retries'], array('align' => 'center')),
                       array($this->element ('dialer_status', array('status' => $campaign['Callback']['status'],'mode' => 'text')), array('align' => 'center')),
                       $change_status
                       );



        }


        echo "<table width='95%' cellspacing  = '0'>";
        echo $html->tableHeaders(array(
	__("Campaign",true),
	 __("Created",true),
 	 __("User",true), 
 	 __("Service ID",true),
 	 __("Attempts",true),
 	 __("Call status",true),
 	 __("Actions",true)));

        echo $html->tableCells($row);
        echo "</table>";
        echo $form->end(__("Save",true));

     }
        

     echo $ajax->divEnd("service_div");

?>