<?php

class ProcessesController extends AppController{

      var $name = 'Processes';
      var $helpers = array('Time','Html', 'Session','Form', 'Javascript');

      var $scaffold;


      function index(){
      	$this->pageTitle = 'System Health';

     	if(isset($this->params['form']['start'])) {

	    	//Fetch id
		$id = $this->params['form']['start'];

		//Fetch record
		$this->data = $this->Process->read(null, $id);

		//Run start command
		$this->Process->start();
		sleep(3); //to allow pid to be written to file

		//Fetch pid
		$pid = $this->Process->getPid();
		
		
		//Save pid and status
		$this->Process->id = $id;
		$this->data['Process']['pid']= $pid;		
		$this->data['Process']['status']= 1;		
		$this->Process->save($this->data);


	}

     	elseif(isset($this->params['form']['stop']) && $id) {

	    	//Fetch id pid
		$id = $this->params['form']['stop'];
		$pid = $this->Process->getPid(PID_URI.'dispatcher_in.pid');


	}

     	elseif(isset($this->params['form']['submit'])) {
		if ($this->params['form']['submit']==__('Refresh',true)){
	   	$this->requestAction('/process/refresh');
     	   	   }
	}	   



      	$this->set('data',$this->Process->find('all',array('order'=>'Process.id ASC')));

      }


}
