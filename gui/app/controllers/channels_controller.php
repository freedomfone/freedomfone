<?php
/****************************************************************************
 * channels_controller.ctp	- Controller for GSMopen channels.
 * version 			- 1.0.364
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

class ChannelsController extends AppController{

      var $name = 'Channels';
    

      function index(){

      	$this->Channel->fsCommand("gsmopen_dump list");
      	$this->pageTitle = __('System Health :: GSM channels',true);
	$this->requestAction('/channels/refresh');
       	$this->set('data',$this->Channel->findAll());

      }




      function refresh($method = null){

           date_default_timezone_set(Configure::read('Config.timezone'));
      	   $this->Session->write('Channel.refresh', time());
           $this->autoRender = false;
      	   $this->logRefresh('channels',$method); 
       	   $this->Channel->refresh();

      }


}



