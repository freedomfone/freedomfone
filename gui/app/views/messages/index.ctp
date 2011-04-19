<?php
/****************************************************************************
 * index.ctp	- List all Leave-a-message messages
 * version 	- 2.0.1160
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

      echo $html->addCrumb('Message Centre', '');
      echo $html->addCrumb('Inboxes', '/messages');
      echo "<h1>".__('Audio Messages',true)."</h1>";
      echo $html->div('feedback', __('Please select one or more criteria below.',true));
      $rates = array(0,1,2,3,4,5);
      $order = array('Category.id' => __('Category',true),'Message.rate' => __('Rate',true), 'Message.instance_id' => __('Service',true),'Message.length' => __('Length',true), 'Message.created' => __('Time',true),'Message.new' => __('New message',true));
      $dir = array('ASC' => __('Ascending', true), 'DESC' => __('Descending',true));

      $instances = array_unique($instances);

      foreach ($instances as $key => $instance){

       $services[$instance] = '2'.$instance;

      }

      $session->flash();
      echo $form->create("Message");



      $input1 = $form->input('tag', array('id' => 'ServiceType1','type' => 'select', 'options' => $tags, 'label' => false, 'empty' => '-- '.__("Select tag",true).' --'));
      $input2 = $form->input('category', array('id' => 'ServiceType2','type' => 'select', 'options' => $categories, 'label' => false, 'empty' => '-- '.__("Select category",true).' --'));
      $input3 = $form->input('rate', array('id' => 'ServiceType3','type' => 'select', 'options' => $rates, 'label' => false, 'empty' => '-- '.__("Select rate",true).' --'));
      $input4 = $form->input('service', array('id' => 'ServiceType4','type' => 'select', 'options' => $services, 'label' => false, 'empty' => '-- '.__("Select service",true).' --'));

      $input5 = $form->input('order', array('id' => 'ServiceType5','type' => 'select', 'options' => $order, 'label' => false, 'empty' => '-- '.__("Select order",true).' --'));
      $input6 = $form->input('dir', array('id' => 'ServiceType6','type' => 'select', 'options' => $dir, 'label' => false, 'empty' => '-- '.__("Select direction",true).' --'));


      echo "<table cellspacing=0 class='none'>";
      echo $html->tableCells(array(array($input1,$input2),array($input3,$input4),array($input5,$input6)), array('class' => 'none'), array('class' => 'none'));
      echo "</table>";


      $opt = array("update" => "service_div", "url" => "disp", "frequency" => "0.2");
      echo $ajax->observeForm("MessageAddForm", $opt);
      echo $form->end();

      echo "<div id= 'service_div' style=''></div>";

?>