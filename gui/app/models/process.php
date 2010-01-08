<?php
/****************************************************************************
 * process.php		- Model for Freedom Fone main processes. Manages stop,start and monitoring of incoming and outgoing dispatcher
 * version 		- 1.0.353
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

App::import('Core', 'HttpSocket');  

class Process extends AppModel{


      var $name = 'Process';


      function getPid(){

	$HttpSocket = new HttpSocket();  
    	return $HttpSocket->request(array('uri' => PID_URI.$this->data['Process']['name'].'.pid'));

      }


      function refresh(){

      	       $this->set('data',$this->find('all',array('order'=>'Process.id ASC')));

      	       foreach ($this->data['Process']['data'] as $key =>  $process){

	       	       $id    = $process['Process']['id'];
	       	       $pid    = $process['Process']['pid'];
	       	       $status = $process['Process']['status'];
	       	       $name = $process['Process']['name'];

	       	       //Process is running but status = OFF
	       	       if($this->isRunning($pid) && !$status){
			 $this->data['Process']['data'][$key]['Process']['status'] = '1';
			 $this->save($this->data);
    			 $this->log('UNEXPECTED INTERUPT; Type: '.$name.'; Msg: Process running but status = OFF', 'process');

		       } elseif (!$this->isRunning($pid) && $status) {
		       //Process is NOT running but status = ON
	
				 $entry['id'] = $id;
				 $entry['status'] = '0';
				 $entry['pid'] = '0';
				 $entry['last_seen'] = time();
				 $entry['interupt'] = 'unexpected crash';
				 $this->save($entry);
    		      		 $this->log('UNEXPECTED INTERUPT; Type: '.$name.'; Msg: Process NOT running but status = ON', 'process');
		       }

      	       }



      }


      function start(){
 
      	       $cmd = $this->data['Process']['start_cmd'];
	       $op = array();
	       exec($cmd,$op);
               $pid = (int)$op[0]; 
	       return $pid;
	//	 exec($cmd);
	//	 return true;
      }


      function stop(){

      	       $pid = $this->data['Process']['pid'];

      	       if($pid){
			//exec('kill -9 '.$pid);
			$cmd='kill -- -'.$pid;
			exec($cmd);
    			return true;
	      	} else {
		       return false;		   
      		
	      	}

      }





      function isRunning($pid){

	if ($pid){

	   $ps    = array();
      	   exec("ps -p ".$pid." -o pid",$ps);

	   if(count($ps)<2){
		return false;
	   } else {
	     return true;
	   }
	}
	else {
	     return false;
	}

      }

      function fsCommand($cmd=null){

      	       $settings  = Configure::read('FREESWITCH');
       	       $sock = new ESLconnection($settings['host'], $settings['port'], $settings['pass']);

	       //Connection established
	       if($sock->connected()){

	       $event = $sock->api($cmd);
	       $body = $event->getBody();

		$sock->disconnect();
		return $body;	
	       }
	       else {
	       return false;
	       }

      }
}
?>
