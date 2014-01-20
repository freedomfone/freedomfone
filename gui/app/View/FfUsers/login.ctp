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


     echo $this->Html->addCrumb(__('Authentication',true), 'ff_users');
     echo $this->Html->addCrumb(__('Login',true), '/ff_users/login');

     echo "<h1>".__("Login",true)."</h1>";
     echo $this->Session->flash('auth');




	$this->Auth->user();
      $options	  = array('label' => false);
      echo $this->Form->create('FfUser',array('type' => 'post','action'=> 'login'));
      echo "<table cellspacing=0 'class'='stand-alone'>";

      echo $this->Html->tableCells(array (
           array(__("Username",true),	        $this->Form->input('username',$options)),
           array(__("Password",true),	        $this->Form->input('password',$options)),
           array('',	$this->Form->end(__('Login',true)))),
           array('class'=>'stand-alone'),array('class'=>'stand-alone'));
     echo "</table>";

?>