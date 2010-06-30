<?php 
/****************************************************************************
 * system_data.ctp	- Describes the System Data functionality
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

$this->pageTitle = __('Functionality',true)." : ".__('System Data',true);           


echo $this->element('menu_next',array('back_text'=>__('Dashboard',true),'back_link'=>'/functionality/dashboard','fwd_text'=>__('Settings',true),'fwd_link'=>'/functionality/settings','div'=>'frameRight'));


echo "<h1>".__('Functionality',true)." : ".__('System data',true)."</h1>";
echo __("<p>Under System Data, you can find useful data regarding the usage of the system’s services.",true);

echo "<h3>".__("Call Data Records (CDR)",true)."</h3>";
echo __("<p>Call data records (CDR) of all incoming calls and SMS (from Leave-a-message, Voice Menus and Ppolls) are displayed with the following parameters: unique call id, start time, end time, caller number, application. CDR can be exported to a CSV file. The administrator can choose to export All entries, or a range of entries using a start and end time.",true);


echo "<h3>".__("Statistics",true)."</h3>";
echo __("<p>Statistics of incoming calls and SMS to the various services are displayed.",true);


echo "<h3>".__("Reporting",true)."</h3>";
echo __("<p>Reporting of Leave-a-message and Voice Menu usage based on Call Data Records (CDR). The result of the CDR reporting, is displayed on screen and can be exported to CSV.",true);

?>

