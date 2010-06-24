<?php 
/****************************************************************************
 * dashboard.ctp	- Describes the Dashboard functionality
 * version 		- 1.0.425
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

$this->pageTitle = __('Functionality',true)." : ".__('Dashboard',true);           


echo $this->element('menu_next',array('back_text'=>__('Voice Menus',true),'back_link'=>'/functionality/ivr','fwd_text'=>__('System Data',true),'fwd_link'=>'/functionality/system_data','div'=>'frameRight'));


echo "<h1>".__('Functionality',true)." : ".__('Dashboard',true)."</h1>";
echo __("<p>The Dashboard gathers useful information about the system’s software and hardware and offers the opportunity to start and stop major components.",true);

echo "<h3>".__("System Health",true)."</h3>";
echo __("<p>The System Health page displays the current status of the telephony application – FreeSWITCH - and the incoming and outgoing dispatchers handling the calls and SMSs. The dispatchers can be stopped and started by the administrator.",true);


echo "<h3>".__("Software",true)."</h3>";
echo __("<p>Software versions of database, web server, FreeSWITCH and dispatcher are displayed. The versions are dynamically updated when software updates take place.",true);


echo "<h3>".__("GSM channels",true)."</h3>";
echo __("<p>A list of connected GSM gateways are displayed with relevant information.",true);


?>