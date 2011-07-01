<?php
/****************************************************************************
 * campaign.php         - Model for callback Campaigns
 * version 		- 2.5.1200
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

class Campaign extends AppModel{

      var $name = 'Campaign';

      var $hasMany = array('Callback' => array(
                        	       'order' => 'Callback.id ASC',
                        	       'dependent' => true)
				       ); 


      function __construct($id = false, $table = null, $ds = null) {
         parent::__construct($id, $table, $ds);

         $this->validate = array(
                'extension' => array(
                            'rule' => 'notEmpty',
                            'message'  => __('You must select a service.',true),
                            'required' => true,
                            ),
                'name' => array(
                            'rule' => 'notEmpty',
                            'message'  => __('Please state a name for the campaign.',true),
                            'required' => true,
                            ));

      }


      function getExtension($campaign){

      
                  $extensions = Configure::read('EXTENSIONS');
                  $type = $campaign['type'];
                  $instance_id = $campaign[$type.'_instance_id'];
                  if($type == 'selector') { 
                           $type = 'ivr';
                  }

                  if ($instance_id){ 
                          $extension = $extensions[$type].$instance_id;
                  } else { 
                          $extension = false;
                  }

                  return $extension;
      }
}
?>