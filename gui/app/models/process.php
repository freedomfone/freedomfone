<?php
/****************************************************************************
 * process.php		- Model for Freedom Fone main processes. Manages stop,start and monitoring of incoming and outgoing dispatcher
 * version 		- 1.0.364
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


/*
 * Fetch new data from spooler
 *  
 * 
 *
 */

      function refresh(){

      	       $this->set('data',$this->findAllByType('run'));
	       
      	       foreach ($this->data['Process']['data'] as $key =>  $process){

	       	       $id    = $process['Process']['id'];
		       $pid = $this->getPid($process['Process']['name']);
		   
	       	       $status = $process['Process']['status'];
	       	       $name = $process['Process']['name'];

	       	       //Process is running but status = OFF
	       	       if($this->isRunning($pid) && !$status){
	
			 $this->data['Process']['data'][$key]['Process']['status'] = '1';
			 //$this->data['Process']['data'][$key]['Process']['pid'] = $pid;
			
			$update = $this->data['Process']['data'][$key];
	
			$this->save($update);
    			 $this->log('UNEXPECTED INTERUPT; Type: '.$name.'; Msg: Process running but status = OFF', 'process');

		       } elseif (!$this->isRunning($pid) && $status) {
		       //Process is NOT running but status = ON
	
				 $entry['id'] = $id;
				 $entry['status'] = '0';
				 //$entry['pid'] = '0';
				 $entry['last_seen'] = time();
				 $entry['interupt'] = 'unexpected crash';
				 $this->save($entry);
    		      		 $this->log('UNEXPECTED INTERUPT; Type: '.$name.'; Msg: Process NOT running but status = ON', 'process');
		       }

      	       }



      }


/*
 * Read pid from file
 *  
 * @return int $pid
 *
 */

 function getPid($name){

        $HttpSocket = new HttpSocket(); 
        return $HttpSocket->request(array('uri' => PID_URI.$name.'.pid'));
		  
	}


/*
 * Start current process
 *  
 * @return int $pid
 *
 */
   function start(){
 
      	       $start = $this->data['Process']['start_cmd'];
	       $script = $this->data['Process']['script'];
	       $cmd=$script.' '.BASE_DIR.$start;

	       $op = array();
	       exec($cmd,$op);
               $pid = (int)$op[0]; 
	       return $pid;

      }


/*
 * Stop current process
 *  
 * @return boolean
 *
 */
    function stop(){

	       $pid = $this->getPid($this->data['Process']['name']);
	
      	       if($pid){
			exec('kill -9 '.$pid);
    			return true;
	      	} else {
		       return false;		   
      		
	      	}

      }

/*
 * Get script version (dispatcher_in)
 *  
 * @param int $id
 *
 * @return string $version
 *
 */
     function version($id){
 
	       $this->data = $this->read(null,$id);
      	       $start = $this->data['Process']['start_cmd'];
	       $script = $this->data['Process']['script'];
	       $cmd=$script.' '.BASE_DIR.$start;
	       
	       $op = array();
	       exec($cmd,$op);
               $version = $op[0];
	       return $version;

      }

/*
 * Check if process is running
 *  
 * @param int $pid
 *
 * @return bool
 *
 */
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

/*
 * Send comamnd to FreeSWITCH
 *  
 * @param string $cmd
 *
 * @return boolean
 *
 */

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

      function uptime($string){

      	   if($string){
      
		$raw=explode(',',$string);

      		$line0	=explode(' ',$raw[0]);
		$line1	=explode(' ',$raw[1]);
		$line2	=explode(' ',$raw[2]);
      		$line3	=explode(' ',$raw[3]);
      		$line4	=explode(' ',$raw[4]);
      		$years    = $line0[1];
      		$days	= $line1[1];
      		$hours	= $line2[1];
      		$minutes	= $line3[1];
      		$seconds	= $line4[1];
      		$diff = $hours*3600+ $minutes*60+ $seconds + $days*86400 + $years*86400*365;
      		return time()-$diff;
		} else {
	return false;
		}
      }
}
?>
