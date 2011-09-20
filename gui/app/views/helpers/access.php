<?php
/****************************************************************************
 * access.php	- Helper for hiding/displaying buttons/icons based on Authentication group
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
 *  PHPRO.ORG http://www.phpro.org/
 *
 * Modified by:
 *   Louise Berthilson <louise@it46.se>
 *    
 *
 *
 ***************************************************************************/

 class AccessHelper extends AppHelper {

     var $helpers = array('Html','Form');

     
    function showBlock($authGroup, $msg, $alt = false){


             if($authGroup == 1){
                return $msg;
             } elseif($alt){

                return $alt; 

             } else {
                return false;
             }

    }


    function showButton($authGroup, $form, $action, $div, $text, $name, $class){
    
             if($authGroup == 1){
              echo $this->Form->create($form, array('type' => 'post','action'=> $action));
              echo $this->Html->div($div,$this->Form->submit($text,  array('name' =>$name, 'class' =>  $class)));
              echo $this->Form->end();
             }

   }

   function showCheckbox($authGroup, $name){

   if($authGroup == 1){

   ?>
   <input type="button" class='button' name="CheckAll" value="<? echo __('Check All',true);?>" onClick="checkAll(<? echo $name; ?>)">
   <input type="button" class='button' name="UnCheckAll" value="<? echo __('Uncheck All',true);?>" onClick="uncheckAll(<? echo $name; ?>)">
   <?
   }

        }

}

?>