<?php
/****************************************************************************
 * system.php	- Model for Freedom Fone front page overview
 * version 	- 1.0.359
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


class System extends AppModel{

      var $name = 'System';
      var $useTable = false;

      function get_data(){

//      $data =  $this->System->query("select * from messages");

        $data ="foo";
      return $data;


      }

}

?>
