<?php
/****************************************************************************
 * add.ctp	- Add node (aka Content for Voice Menus and Selectors)
 * version 	- 2.0.1175
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


echo $html->addCrumb('IVR Centre', '');
echo $html->addCrumb('Content', '/nodes');
echo $html->addCrumb('Upload', '/nodes/add');


$session->flash();
echo "<h1>".__("Upload Content",true)."</h1>";

   	  if ($messages = $session->read('Message.multiFlash')) {
                foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
         }


echo $form->create('Node', array('type' => 'post', 'action' => 'add','enctype' => 'multipart/form-data') );




     $row[] = array(__("Title",true),	$form->input('title',array('label'=>false,'size' =>'50')));
     $row[] = array(__("Audio file",true), $form->input('file',array('label'=>false,'type'=>'file')));
     $row[] = array(array(__("Valid formats: wav and mp3",true),"colspan='2' class='formComment'"));

     echo "<table cellspacing = 0 class='stand-alone'>";
     echo $html->tableCells($row, array('class'=>'stand-alone'),array('class'=>'stand-alone'));
     echo "</table>";

     echo $form->end(__('Save',true));



?>

