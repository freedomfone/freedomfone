<?php
/****************************************************************************
 * votes_controller.php		- Does nothing.
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

class VotesController extends AppController{

      var $name = 'Votes';

      var $helpers = array('Time','Html', 'Session','Form','Ajax','Flash');
      var $components = array('RequestHandler');

    function add(){

    Configure::write('debug', 0);

       if(!empty($this->data)){

             if($this->data['Vote']['chtext']){

                $this->Vote->create();
                if ($this->Vote->save($this->data)){
                
                   $view = 'add_success';

                } else {

                   $view = 'add_failure';

                }
             } else {

                   $view = 'add_failure';


             }

                $votes = $this->Vote->find('all', array('conditions' => array('poll_id' => $this->data['Vote']['poll_id']), 'recursive' => -1));
                $poll_id = $this->data['Vote']['poll_id'];
                $this->set(compact('votes','poll_id'));
                $this->render($view,'ajax');
           }
    }

    function delete($id, $poll_id){

    Configure::write('debug', 0);

       if($id && $poll_id){
                
                if ($this->Vote->del($id)){
               
                   $votes = $this->Vote->find('all', array('conditions' => array('poll_id' => $poll_id), 'recursive' => -1));
                   $poll = $poll_id;          
                   $this->set(compact('votes','poll'));
                   $this->render('add_success','ajax');
                } else {
                  $this->render('add_failure','ajax');
                }
       } else {


       }
    }


}
?>
