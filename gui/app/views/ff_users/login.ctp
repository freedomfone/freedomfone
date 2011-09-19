<?php
/****************************************************************************
 * login.ctp	- Freedom Fone login page
 * version 	- 3.0.1500
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

echo $html->addCrumb(__('Authentication',true), 'ff_users');
echo $html->addCrumb(__('Login',true), 'ff_users/login');

/*
echo $this->Session->flash('auth');
echo $this->Form->create('FfUser', array('action' => 'login'));
echo $this->Form->inputs(array('legend' => __('Login', true),'username','password'));
echo $this->Form->end('Login');
*/


echo $this->Session->flash('auth');

echo "<h2>Login</h2>";


echo $this->Form->create('FfUser', array('url' => array('controller' => 'ff_users', 'action' =>'login')));
echo $this->Form->input('FfUser.username');
echo $this->Form->input('FfUser.password');
//echo $this->Form->input('FfUser.pwd');
echo $this->Form->end('Login');

?>
