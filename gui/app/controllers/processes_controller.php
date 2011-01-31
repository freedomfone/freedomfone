<?php
/****************************************************************************
 * processes_controller.ctp	- Controller for processes. Manages start,stop,status of incoming and outgoing dispatcher.
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

class ProcessesController extends AppController{

      var $name = 'Processes';
      var $helpers = array('Time','Html', 'Session','Form', 'Javascript','Text','Flash');
      var $components = array('Simplepie');

      var $scaffold;


      function index(){

      	$this->pageTitle = __('Health',true);

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

      	       if($rss = Configure::read('RSS.path')){

                    $max   = Configure::read('RSS.max');
	            $items = $this->Simplepie->feed($rss,$max);
	       } else {
	       	    $items = false;
	       }


      	$this->pageTitle = __('About',true);

 	$version[0]   = $this->Process->version(3);
	$version[1]   = $this->Process->fsCommand("version");
        $svn = $this->Process->getSVN();

	$settings = $this->Process->query("select * from settings");
	$this->set(compact('version','items','settings','svn'));
	$this->render();

      }


      function start($id){


		//Fetch record
		$this->data = $this->Process->read(null, $id);

		$type = $this->data['Process']['type'];

		//Pid based process
		if($type=='run'){

		$pid = $this->Process->getPid($this->data['Process']['name']);

		//Process is not running
//		if(!$this->Process->isRunning($this->data['Process']['pid'])){

		   if(!$this->Process->isRunning($pid)){


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
		      	$this->_flash($this->data['Process']['title']." ".__("started",true),'success');
		   } else {
		   	$this->_flash($this->data['Process']['title']." ".__("is already running",true),'success');
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


			$pid = $this->Process->getPid($this->data['Process']['name']);

			//Process is NOT running
			if(!$this->Process->isRunning($pid)){

				$this->_flash($this->data['Process']['title']." ".__("is not running",true),'success');

				} else {
		
			if(!$this->Process->stop()){
				$this->_flash(__("No pid found. Contact system admin.",true),'warning');
				}
				else {

				//Save new PID (0) and update status
		      		$this->data['Process']['pid']= 0;		
		      		$this->data['Process']['status']= 0;		
		      		$this->data['Process']['start_time']= 0;
		      		$this->data['Process']['last_seen']= time();	
		      		$this->data['Process']['interupt']= __('Manual',true);	
	      	      		$this->Process->save($this->data);
		      		$this->_flash($this->data['Process']['title']." ".__("stopped",true),'success');
				}
		  
			} 
		} elseif ($type=='esl'){

		       if(!$this->Process->fsCommand()){
				$this->_flash($this->data['Process']['title']." ".__("was already stopped",true),'success');
			} else {
			       $this->Process->fsCommand("fsctl shutdown");
		      		$this->data['Process']['status']= 0;		
		      		$this->data['Process']['start_time']= 0;
		      		$this->data['Process']['last_seen']= time();	
		      		$this->data['Process']['interupt']= _('Manual',true);	
	      	      		$this->Process->save($this->data);
			       $this->_flash($this->data['Process']['title']." ".__("stopped",true),'success');
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



