<?php
/****************************************************************************
 * processes_controller.ctp	- Controller for processes. Manages start,stop,status of incoming and outgoing dispatcher.
 * version 			- 3.0.1700
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
      var $helpers = array('Time','Html', 'Session','Form', 'Js','Text','Flash');
      var $components = array('Simplepie');

      var $scaffold;


      function index(){

        $this->set('title_for_layout', __('Health',true));

	$this->requestAction('/processes/refresh');

	$version[0]   = $this->Process->version(3);
	$version[1]   = $this->Process->fsCommand("version");
	$uptime       = $this->Process->fsCommand("status");

        $epoch        = $this->Process->getEpoch("dispatcher_in");
	$uptime       = $this->Process->uptime($uptime);
	$this->set(compact('version','uptime','epoch'));
      	$this->set('data',$this->Process->findAllByType('run'));

      }


      function system(){

      //FIXME
      /*
      	       if($rss = Configure::read('RSS.path')){
                    $max   = Configure::read('RSS.max');
	            $items = $this->Simplepie->feed($rss,$max);
	       } else {
	       	    $items = false;
	       }
*/


        $this->set('title_for_layout', __('About',true));

 	$version[0]   = $this->Process->version(3);
	$version[1]   = $this->Process->fsCommand("version");
        $svn = $this->Process->getSVN();

	$settings = $this->Process->query("select * from settings");
	$this->set(compact('version','items','settings','svn'));
	$this->render();

      }


      function start($id){


		//Fetch record
		$this->request->data = $this->Process->read(null, $id);

		$type = $this->request->data['Process']['type'];

		//Pid based process
		if($type=='run'){

		$pid = $this->Process->getPid($this->request->data['Process']['name']);

		//Process is not running

		   if(!$this->Process->isRunning($pid)){


			//Run start command
			$pid = $this->Process->start();

			//Save NEW pid, update status and timestamps
			$this->Process->id = $id;
			$this->request->data['Process']['pid']= $pid;
 			$this->request->data['Process']['start_time']= time();
			$this->request->data['Process']['last_seen']= time();
			$this->request->data['Process']['status']= 1;		
		        $this->request->data['Process']['interupt']= '';	
			$this->Process->save($this->request->data);
		      	$this->Session->setFlash($this->request->data['Process']['title']." ".__("started",true),'success');
                        $this->log("[INFO] DISPATCHER STARTED", "health"); 

		   } else {

                        $this->log("[WARNING] FAILED ATTEMPT TO START DISPATCHER, DISPATCHER IS ALREADY RUNNING", "health"); 
		   	$this->Session->setFlash($this->request->data['Process']['title']." ".__("is already running",true),'success');
		   }
	 	 } 

	  $this->redirect(array('action' => 'index'));
	
      }

      function stop($id){

		//Fetch record
		$this->request->data = $this->Process->read(null, $id);

		$type = $this->request->data['Process']['type'];

		//Pid based process
		if($type=='run'){


			$pid = $this->Process->getPid($this->request->data['Process']['name']);

			//Process is NOT running
			if(!$this->Process->isRunning($pid)){

                                $this->log("[WARNING] FAILED ATTEMPT TO STOP DISPATCHER, DISPATCHER IS NOT RUNNING", "health"); 
				$this->Session->setFlash($this->request->data['Process']['title']." ".__("is not running",true),'success');

				} else {
		
			if(!$this->Process->stop()){
				$this->Session->setFlash(__("No pid found. Contact system admin.",true),'warning');
				}
				else {

				//Save new PID (0) and update status
		      		$this->request->data['Process']['pid']= 0;		
		      		$this->request->data['Process']['status']= 0;		
		      		$this->request->data['Process']['start_time']= 0;
		      		$this->request->data['Process']['last_seen']= time();	
		      		$this->request->data['Process']['interupt']= __('Manual',true);	
	      	      		$this->Process->save($this->request->data);
		      		$this->Session->setFlash($this->request->data['Process']['title']." ".__("stopped",true),'success');
                                $this->log("[INFO] DISPATCHER STOPPED", "health"); 
				}
		  
			} 
		} elseif ($type=='esl'){

		       if(!$this->Process->fsCommand()){
				$this->Session->setFlash($this->request->data['Process']['title']." ".__("was already stopped",true),'success');
			} else {
			       $this->Process->fsCommand("fsctl shutdown");
		      		$this->request->data['Process']['status']= 0;		
		      		$this->request->data['Process']['start_time']= 0;
		      		$this->request->data['Process']['last_seen']= time();	
		      		$this->request->data['Process']['interupt']= _('Manual',true);	
	      	      		$this->Process->save($this->request->data);
			       $this->Session->setFlash($this->request->data['Process']['title']." ".__("stopped",true),'success');
                               $this->log("[INFO] DISPATCHER STOPPED", "health"); 
			}


		}
      	
	$this->redirect(array('action' => 'index'));
      }



      function refresh($method = null){

               $this->Session->write('Process.refresh', time());
               $this->autoRender = false;
               $this->logRefresh('processes',$method); 
               $this->Process->refresh();

      }


}



