<?php 
/****************************************************************************
 * callback.ctp	- Describes the callback functionality
 * version 	- 1.0.356
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

$this->pageTitle = __('Functionality : Callback',true);           
echo $this->element('menu_next',array('back_text'=>__('Voice menus',true),'back_link'=>'/functionality/ivr','div'=>'frameRight'));
echo "<h1>".__('Functionality: Callback',true)."</h1>";

echo __("<p>The Callback service offers callers a means to access audio content from Freedom Fone at a low cost, or at no cost at all. As the name suggests, the Callback service establishes outgoing phone calls from Freedom Fone to a caller, with the Freedom Fone deployer carrying the cost of the call. </p>",true);
echo __("<p>To request a Callback from Freedom Fone, the caller can either</p><ul><li>send an SMS to a designated number with the text “callback”, or</li><li>tickle a designated number (ring once and hang up)</li></ul>",true);

echo __("<p>The cost to the caller will either be the cost for an SMS, or nothing (if you hang up after the first ring).</p>",true);

echo "<h3>".__("Administration settings",true)."</h3>";

echo __("<p>The administrator can choose which content to connect with the Callback service. The options for Freedom Fone v.1 are </p><ul><li>Leave-a-message menu OR</li><li>Default Voice Menu</li></ul>",true);


echo __("<p>To limit the risk of abuse of the Callback service, the administrator can limit the maximum number of Callbacks for a unique GSM number for a certain period of time.</p><ul><li>Max Calls: 10, 25, 50, 100, no limit</li><li>Period : 12h, 24h, 2d, 4d, 1 week</li></ul>",true);

echo __("<p>The administration parameters can be found under Settings.</p>",true);

?>

