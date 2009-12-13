<?php

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



      	$this->set('data',$this->Process->find('all',array('order'=>'Process.id ASC')));

      }


      function start($id){


		//Fetch record
		$this->data = $this->Process->read(null, $id);

		//Process is not running
		if(!$this->Process->isRunning($this->data['Process']['pid'])){


			//Run start command
			$this->Process->start();
			sleep(3); //to allow pid to be written to file

			//Fetch NEW pid
			$pid = $this->Process->getPid();
				
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


	  $this->redirect(array('action' => 'index'));
	
      }

      function stop($id){

		//Fetch record
		$this->data = $this->Process->read(null, $id);

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
      	
	$this->redirect(array('action' => 'index'));
      }

      function refresh(){

      $this->autoRender = false;
 
      $this->Process->refresh();

      }


      function test(){

      $this->autoRender = false;
 
      $this->Process->fsCommand("status");
      

      }

}


////////////


