<?php
/****************************************************************************
 * processes_controller.ctp	- Controller for processes. Manages start,stop,status of incoming and outgoing dispatcher.
 * version 			- 1.0.356
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

class ProcessesController extends AppController{

      var $name = 'Processes';
      var $helpers = array('Time','Html', 'Session','Form', 'Javascript');

      var $scaffold;


      function index(){
      	$this->pageTitle = 'System Health';

     	if(isset($this->params['form']['submit'])) {
		if ($this->params['form']['submit']==__('Refresh',true)){
	   	$this->requestAction('/processes/refresh');
     	   	   }
	}	   

//	$version[0]   = $this->Process->version(3);
	$version[0] = 'foo';
	$version[1]   = $this->Process->fsCommand("version");

	$this->set(compact('version'));
      	$this->set('data',$this->Process->findAllByType('run'));

      }


      function start($id){


		//Fetch record
		$this->data = $this->Process->read(null, $id);

		$type = $this->data['Process']['type'];

		//Pid based process
		if($type=='run'){

		//Process is not running
		if(!$this->Process->isRunning($this->data['Process']['pid'])){


			//Run start command
			$pid = $this->Process->start();
					
			//Save NEW pid, update status and timestamps
			$this->Process->id = $id;
			$this->data['Process']['pid']= $pid;
 			$this->data['Process']['start_time']= time();
			$this->data['Process']['last_seen']= time();
			$this->data['Process']['status']= 1;		
		        $this->data['Process']['interupt']= '';	
			$this->Process->save($this->data);
		      	$this->Session->setFlash($this->data['Process']['title']." ".__("started",true));
			}
			else {
		      	     $this->Session->setFlash($this->data['Process']['title']." ".__("is already running",true));
	 	
			}
		} 

	  $this->redirect(array('action' => 'index'));
	
      }

      function stop($id){

		//Fetch record
		$this->data = $this->Process->read(null, $id);

		$type = $this->data['Process']['type'];

		//Pid based process
		if($type=='run'){


			//Process is NOT running
			if(!$this->Process->isRunning($this->data['Process']['pid'])){
				$this->Session->setFlash($this->data['Process']['title']." ".__("is not running",true));

				} else {
		
			if(!$this->Process->stop()){
				$this->Session->setFlash(__("No pid found. Contact system admin.",true));
				}
				else {

				//Save new PID (0) and update status
		      		$this->data['Process']['pid']= 0;		
		      		$this->data['Process']['status']= 0;		
		      		$this->data['Process']['start_time']= 0;
		      		$this->data['Process']['last_seen']= time();	
		      		$this->data['Process']['interupt']= 'Manual';	
	      	      		$this->Process->save($this->data);
		      		$this->Session->setFlash($this->data['Process']['title']." ".__("stopped",true));
				}
		  
			} 
		} elseif ($type=='esl'){

		       if(!$this->Process->fsCommand()){
				$this->Session->setFlash($this->data['Process']['title']." ".__("was already stopped",true));
			} else {
			       $this->Process->fsCommand("fsctl shutdown");
		      		$this->data['Process']['status']= 0;		
		      		$this->data['Process']['start_time']= 0;
		      		$this->data['Process']['last_seen']= time();	
		      		$this->data['Process']['interupt']= 'Manual';	
	      	      		$this->Process->save($this->data);
			       $this->Session->setFlash($this->data['Process']['title']." ".__("stopped",true));
			}


		}
      	
	$this->redirect(array('action' => 'index'));
      }



      function refresh(){

      $this->autoRender = false;
 
      $this->Process->refresh();

      }


}



