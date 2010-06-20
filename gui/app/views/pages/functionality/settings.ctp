<?php 
/****************************************************************************
 * settings.ctp		- Describes the Settings functionality
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

$this->pageTitle = __('Functionality',true)." : ".__('Settings',true);           
echo $this->element('menu_next',array('back_text'=>__('System Data',true),'back_link'=>'/functionality/system_data','div'=>'frameRight'));

echo "<h1>".__('Functionality',true)." : ".__('Settings',true)."</h1>";
echo __("<p>Set system wide settings.",true);

echo "<h3>".__("Language",true)."</h3>";
echo __("<p>Set language of GUI. Available languages are English, Spanish and Swahili.</p>",true);


echo "<h3>".__("Timezone",true)."</h3>";
echo __("<p>Set timezone of system.</p>",true);




?>

