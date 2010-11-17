<?php
/****************************************************************************
 * systems_controller.php	- Displays overview of system
 * version 		 	- 1.0.368
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

class SystemsController extends AppController{



        var $name = 'Systems';
	var $uses = array();
	var $helpers = array("Html","Form","Javascript","Ajax");


	function index() {

                //Fetch data from unassociated models
                $this->loadModel('IvrMenu');
                $this->IvrMenu->unbindModel(array('hasMany' => array('Node')));   
                $ivr = $this->IvrMenu->find('all');

                $this->loadModel('Message');
                $messages = $this->Message->find('all');

                $this->loadModel('Bin');
                $bin = $this->Bin->find('all');

                $this->loadModel('Poll');
                $this->Poll->unbindModel(array('hasMany' => array('Vote')));   
                $polls = $this->Poll->find('all');

                $this->set(compact('messages','bin','polls','ivr'));


	}


}
?>
