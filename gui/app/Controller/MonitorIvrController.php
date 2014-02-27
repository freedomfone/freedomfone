<?php
/****************************************************************************
 * monitor_ivr_controller.ctp	- Display,delete,export monitoring data.
 * version 			- 3.0.1500
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

class MonitorIvrController extends AppController{

      var $name = 'MonitorIvr';

      var $helpers = array('Csv','Js','Text');


        var  $paginate = array('limit' => 50, 'page' => 1, 'order' => array('MonitorIvr.epoch' => 'desc'),'group' => array('MonitorIvr.call_id','MonitorIvr.type'));



      function index(){

             $this->set('title_for_layout', __('Monitor Voice Menus',true));
    	     $this->MonitorIvr->unbindModel(array('belongsTo' => array('Cdr')));
	     $this->MonitorIvr->recursive = 0; 
   	     $data = $this->paginate('MonitorIvr');
	     $this->set('data',$data);  

	}


    function del ($id){

   	     $call_id = $this->MonitorIvr->getCallId($id);

    	     if($this->MonitorIvr->delete($id))
	     {
	     $this->Session->setFlash('Entry  with Call ID "'.$call_id.'" has been deleted.');
	     $this->log("[INFO] ENTRY DELETED, Call-ID: ".$call_id, "monitor_ivr"); 
	     }

             $this->redirect(array('action' => 'index'));


    }

      function refresh(){

      $this->autoRender = false;
      $this->MonitorIvr->Cdr->refresh();

      }

    function process (){


    	    if(!empty($this->request->data['monitor_ivr'])){
	   
	      $entries = $this->request->data['monitor_ivr'];
    	      $action = $this->request->data['Submit'];

    	      foreach ($entries as $key => $entry){
	      	    $id = $entry['MonitorIvr'];
    	     	    if ($id) {
		       $this->MonitorIvr->id = $id;
		       if ($action == __('Delete selected',true)){

    	     	       	   $call_id = $this->MonitorIvr->getCallId($id);
     	       	  	   if ($this->MonitorIvr->delete($id)){
	                      $this->log("[INFO] ENTRY DELETED, Call-ID: ".$call_id, "monitor_ivr"); 

			    }
			}
		    }
	      }
	     }
	  $this->redirect(array('action' => 'index'));

    }

      function export(){

       $this->set('title_for_layout', __('Export monitoring data',true));

        $start = $this->MonitorIvr->Cdr->getEpoch('first');  
        $end   = time()+900;
        $this->set(compact('start','end'));

    	$this->render();  
  
     }

    function output(){

      if ( array_key_exists('MonitorIvr', $this->request->data)){
      	 $start	  = $this->request->data['MonitorIvr']['start_time'];
      	 $end 	  = $this->request->data['MonitorIvr']['end_time'];
 
	 $this->set('select_option','selected');	   

	$hour_start = $start['hour'];
	$hour_end   = $end['hour'];

	if($start['meridian']=='pm' && $start['hour']!=12){ 
	   	$hour_start=$hour_start+12;
		} 
 	elseif($start['meridian']=='am' && $start['hour']==12){ 
	   	$hour_start='00';
	}

	if($end['meridian']=='pm' && $end['hour']!=12){ 
	   	$hour_end=$hour_end+12;
		} 
 	elseif($end['meridian']=='am' && $end['hour']==12){ 
	   	$hour_end='00';
	}

	 $start = $start['year'].'-'.$start['month'].'-'.$start['day'].' '.$hour_start.':'.$start['min'].':00';
     	 $end   = $end['year'].'-'.$end['month'].'-'.$end['day'].' '.$hour_end.':'.$end['min'].':00';


      	 $start_epoch = strtotime($start);
      	 $end_epoch = strtotime($end);

	 $param = array('conditions' => array('MonitorIvr.epoch >=' => $start_epoch, 'MonitorIvr.epoch <=' => $end_epoch));
    	 $this->set('data', $this->MonitorIvr->find('all',$param)); 

	 } else {

    	   $this->set('data', $this->MonitorIvr->find('all'));
	   $this->set('select_option','all');	    
	 }

        $this->set(compact('select_option'));

  	     Configure::write('debug', 0);
    	     $this->layout = null;
    	     $this->autoLayout = false;
    	     $this->render();    
    }


    function delete(){

     $this->set('title_for_layout', __('Delete monitoring data',true));

      if ($this->request->data){
      	 $start	  = $this->request->data['MonitorIvr']['start_time'];
      	 $end 	  = $this->request->data['MonitorIvr']['end_time'];
 

	$hour_start = $start['hour'];
	$hour_end   = $end['hour'];

	if($start['meridian']=='pm' && $start['hour']!=12){ 
	   	$hour_start=$hour_start+12;
		} 
 	elseif($start['meridian']=='am' && $start['hour']==12){ 
	   	$hour_start='00';
	}

	if($end['meridian']=='pm' && $end['hour']!=12){ 
	   	$hour_end=$hour_end+12;
		} 
 	elseif($end['meridian']=='am' && $end['hour']==12){ 
	   	$hour_end='00';
	}

	 $start = $start['year'].'-'.$start['month'].'-'.$start['day'].' '.$hour_start.':'.$start['min'].':00';
     	 $end   = $end['year'].'-'.$end['month'].'-'.$end['day'].' '.$hour_end.':'.$end['min'].':00';


      	 $start_epoch = strtotime($start);
      	 $end_epoch = strtotime($end);

	 $param = array('MonitorIvr.epoch >=' => $start_epoch, 'MonitorIvr.epoch <=' => $end_epoch);
    	 $this->set('data', $this->MonitorIvr->deleteAll($param)); 
         $this->log("[INFO] ENTRIES DELETED, Start: ".date('c',$start_epoch).", End: ".date('c',$end_epoch), "monitor_ivr"); 

	 $this->redirect(array('action' => 'index'));
	 }
	 else {
	 
                $start = $this->MonitorIvr->Cdr->getEpoch('first');  
                $end   = time()+900;
                $this->set(compact('start','end'));

		$this->render();
	 } 

             
    }



}
?>
