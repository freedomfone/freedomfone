<?php
/****************************************************************************
 * office_route_controller.ctp	- Controller for OfficeRoute channels.
 * version 			- 1.0.364
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

class OfficeRouteController extends AppController{

      var $name = 'OfficeRoute';
    

      function refresh($method = null){

      $this->autoRender = false;
      $this->logRefresh('office_route',$method); 

      $data = $this->OfficeRoute->refresh();

         foreach ($data as $key => $channel){

                 $this->OfficeRoute->set('id',$channel['id']);
                 $this->OfficeRoute->save($channel);

         }

      }

}



?>