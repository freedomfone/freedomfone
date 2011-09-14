<?php
/****************************************************************************
 * status.ctp	- View current callback job status
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
echo $html->addCrumb(__('Callback',true), '/callbacks');
echo $html->addCrumb(__('Status',true), '/callbacks/status');
$ivr_settings = Configure::read('IVR_SETTINGS');
$callback_default  = Configure::read('CALLBACK_DEFAULT');

     echo "<h1>".__("Callback Status",true)."</h1>";





?>

