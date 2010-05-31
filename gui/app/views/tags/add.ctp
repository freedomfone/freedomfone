/****************************************************************************
 * add.ctp	- Create new tag (used in Leave-a-message)
 * version 	- 1.0.362
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

echo "<h1>".__("Add Tag",true)."</h1>";

$session->flash();

$options	  = array('label' => false);


echo $form->create('Tag',array('type' => 'post','action'=> 'add'));
echo "<table>";

echo $html->tableCells(array (
     array(__("Tag",true),           $form->input('name',$options)),
     array(__("Description",true),   $form->input('longname',$options)),
     array('',			     $form->end(__('Save',true)))
     ));
echo "</table>";

?>