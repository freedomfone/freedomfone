<?php
/****************************************************************************
 * mapping.php		- N/A
 * version 		- 3.0.1500
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


class Mapping extends AppModel{

      var $name = 'Mapping';

      var $belongsTo = array(
           'IvrMenu' => array(
            'className' => 'IvrMenu',
            'foreignKey' => 'ivr_menu_id',
            ),
           'LmMenu' => array(
            'className' => 'LmMenu',
            'foreignKey' => 'lm_menu_id',
            ),
           'Node' => array(
            'className' => 'Node',
            'foreignKey' => 'node_id',
            )
           );

      var $hasOne = array('Node');
}

?>
