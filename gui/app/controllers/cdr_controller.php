<?php
/****************************************************************************
 * cdr_controller.php	- Display, delete, export of CDR, System Overview page (Home) 
 * version 		- 3.0.1500
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

class CdrController extends AppController{

      var $name = 'Cdr';
      var $helpers = array('Csv','Javascript','Formatting','Text');
      var  $paginate = array('limit' => 50, 'page' => 1, 'order' => array( 'Cdr.epoch' => 'desc')); 


      function refresh($method = null){

         $this->loadModel('Message');
         $this->Message->refresh();
         $this->logRefresh('message',$method); 

         $this->Cdr->refresh();
         $this->logRefresh('cdr',$method); 
         $this->autoRender = false;
      }

      function general($action = null){

         $this->refreshAll();
         $this->set('title_for_layout', __('Reporting',true));

         if(isset($this->params['named']['limit'])) { 
	     $this->Session->write('cdr_limit',$this->params['named']['limit']);
         } elseif($this->Session->check('cdr_limit')) { 
	    $this->paginate['limit'] = $this->Session->read('cdr_limit');
         }	

         //User arrived from other page, reset session variables
         if(!strpos(getenv("HTTP_REFERER"),$_SERVER['REQUEST_URI'])){

            $this->Session->write('cdr_start', $this->Cdr->getEpoch('first')-900);
            $this->Session->write('cdr_end',time()+900);

         }

        $epoch = $this->Cdr->dateToEpoch($this->data['Cdr']);

        if ($epoch['start']) {$this->Session->write('cdr_start',$epoch['start']);}
        if ($epoch['end']) {$this->Session->write('cdr_end',$epoch['end']);}


        $app   = $this->data['Cdr']['application'];
        if ($app) {$this->Session->write('cdr_app',$app);}

        $title=false;

        if($app =='ivr'){ 
      	      $title   = $this->data['Cdr']['title_ivr'];
        } elseif ($app =='lam') {
	      $title   = $this->data['Cdr']['title_lam'];
        }

        $this->Cdr->unbindModel(array('belongsTo' => array('User')));
        $this->Cdr->unbindModel(array('hasMany' => array('MonitorIvr')));

        //Fetch All CDR
        if(!$title){

	  $count = $this->Cdr->find('count',array('conditions'=>array('epoch < '=> $this->Session->read('cdr_end'),'epoch > '=> $this->Session->read('cdr_start'),'application'=> $this->Session->read('cdr_app')),'order'=>array('Cdr.epoch desc'))); 
	  	      
	$this->set('count', $count);

	//Limit is set
	$limit = $this->Session->read('cdr_limit');
	if(!empty($limit)){
               $pageCount = $this->Session->read('cdr_limit');
        } else {
	   if ($count){ 
              $pageCount = $count;
           }  else { 
              $pageCount = 1;
           }
	}

       $this->paginate = array('conditions'=> array('epoch < '=> $this->Session->read('cdr_end'),'epoch > '=> $this->Session->read('cdr_start'),'application'=> $this->Session->read('cdr_app')),'order'=>array('Cdr.epoch desc'),'limit'=>$pageCount);
	$this->set('select_option','all');
        $cdrExport = $this->Cdr->find('all',array('conditions'=>array('epoch < '=>$this->Session->read('cdr_end'),'epoch > '=> $this->Session->read('cdr_start'),'application'=>$this->Session->read('cdr_app')),'order'=>array('Cdr.epoch desc')));

        } else {
        
         //Fetch CDR by Title
         $this->set('count', $this->Cdr->find('count',array('conditions'=>array('epoch < '=>$this->Session->read('cdr_end'),'epoch > '=> $this->Session->read('cdr_start'),'application'=>$this->Session->read('cdr_app'),'title'=>$title),'order'=>array('Cdr.epoch desc'))));

        $cdrExport = $this->Cdr->find('all',array('conditions'=>array('epoch < '=>$this->Session->read('cdr_end'),'epoch > '=> $this->Session->read('cdr_start'),'application'=>$this->Session->read('cdr_app'),'title'=>$title),'order'=>array('Cdr.epoch desc')));

        $foo = $this->Cdr->find('count',array('conditions'=>array('epoch < '=>$this->Session->read('cdr_end'),'epoch > '=> $this->Session->read('cdr_start'),'application'=>$this->Session->read('cdr_app'),'title'=>$title),'order'=>array('Cdr.epoch desc')));
         $this->paginate = array('conditions'=>array('epoch < '=> $this->Session->read('cdr_end'),'epoch > '=> $this->Session->read('cdr_start'),'application'=> $this->Session->read('cdr_app'),'title'=>$title),'order'=>array('Cdr.epoch desc'));

	 $this->set('select_option','selected');

        }

        $this->loadModel('IvrMenu');
	$ivr = array();
        $this->IvrMenu->unbindModel(array('hasMany' => array('Node')));                                                                                                                          
        $ivr_data = $this->IvrMenu->find('list');
        foreach($ivr_data as $key => $title){ $ivr[$title] = $title;}       

        $this->loadModel('LmMenu');
	$lam = array();
        $lam_data = $this->LmMenu->find('list');
        foreach($lam_data as $key => $title){ $lam[$title] = $title;}       

	$application = $this->data['Cdr']['application'];

        $data = $this->paginate('Cdr');
	$this->set('cdr',$data);  

        $this->set(compact('ivr','lam','cdr','count','application','select_option','app', 'cdrExport'));


	//Export data
        if(isset($this->params['form']['action'])) {	
	     if ($this->params['form']['action']==__('Export',true)){     
  	       Configure::write('debug', 0);
    	       $this->layout = null;
    	       $this->autoLayout = false;
    	       $this->render();   
	     }	   
         } 
            

      }


      function index(){

         $this->refreshAll();
         $this->set('title_for_layout', __('Call Data Records',true));
         $this->Session->write('Cdr.source', 'index');

          if(isset($this->params['named']['sort'])) { 
      		$this->Session->write('cdr_sort',array($this->params['named']['sort']=>$this->params['named']['direction']));
	  } elseif($this->Session->check('cdr_sort')) { 
  		$this->paginate['order'] = $this->Session->read('cdr_sort');
	  } 

          if(isset($this->params['named']['limit'])) { 
	       $this->Session->write('cdr_limit',$this->params['named']['limit']);
	  } elseif($this->Session->check('cdr_limit')) { 
	       $this->paginate['limit'] = $this->Session->read('cdr_limit');
	  }	

	  $this->Cdr->recursive = 0; 
   	  $data = $this->paginate('Cdr');
	  $this->set('cdr',$data);  

     }



    function del ($id){

    	     $call_id = $this->Cdr->getCallId($id);

    	     if($this->Cdr->delete($id))
	     {
	     $this->Session->setFlash('CDR with Call ID "'.$call_id.'" has been deleted.');
	     $this->log("Action: entry deleted; Call-ID: ".$call_id, "cdr"); 
	     }

             $this->redirect(array('action' => 'index'));


    }


    function process (){


    	    if(!empty($this->params['form']['cdr'])){
	   
	      $entries = $this->params['form']['cdr'];
    	      $action = $this->params['data']['Submit'];
 
              if ($action == __('Delete selected',true)){

   	        foreach ($entries as $key => $id){
    	     	    if ($id) {
		       $this->Cdr->id = $id;
		       $call_id = $this->Cdr->getCallId($id);
     	       	       if ($this->Cdr->delete($id)){
	     		      $this->log("Action: entry deleted; Call-ID: ".$call_id, "cdr"); 
		       }
		    }
	         } //foreach


	      } //action
	      
	     }
	  
		 $this->redirect(array('action' => 'index'));
    }


    function output (){


      if ($this->data['Cdr'] ){
      	 $start	  = $this->data['Cdr']['start_time'];
      	 $end 	  = $this->data['Cdr']['end_time'];
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

	 $param = array('conditions' => array('epoch >=' => $start_epoch, 'epoch <=' => $end_epoch));
    	 $this->set('data', $this->Cdr->find('all',$param)); 

       } else {

           //Export all entries
    	   $this->set('data', $this->Cdr->find('all')); 
	   $this->set('select_option','all');	   
        }


         $this->set(compact('select_option'));

  	     Configure::write('debug', 0);
    	     $this->layout = null;
    	     $this->autoLayout = false;
    	     $this->render();   
    }


      function export(){

        $start = $this->Cdr->getEpoch('first');  
        $end   = time()+900;
        $this->set(compact('start','end'));

    	$this->render();  

       }


      function statistics(){

        $this->refreshAll();
 
        $this->set('title_for_layout', __('Call Data Records',true)).": ".__('Overview',true);


        if($this->data){
		$epoch = $this->Cdr->dateToEpoch($this->data['Cdr']);
     		$param = array('conditions' => array('epoch >=' => $epoch['start'], 'epoch <=' => $epoch['end'],'application !=' => ''));

        } else {
     		$param = array('conditions' => array('application !=' => ''));
        }

       	$this->set('cdr', $this->Cdr->find('all',$param)); 
        $start = $this->Cdr->getEpoch('first');  
        $end   = time()+900;
        $this->set(compact('start','end'));
        $this->render();  

      }



    function delete(){


      if ($this->data['Cdr']){
      	 $start	  = $this->data['Cdr']['start_time'];
      	 $end 	  = $this->data['Cdr']['end_time'];
 

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

	 $param = array('Cdr.epoch >=' => $start_epoch, 'Cdr.epoch <=' => $end_epoch);
    	 $this->set('data', $this->Cdr->deleteAll($param)); 

	 $this->redirect(array('action' => 'index'));
	 }
	 else {
	 
		$this->render();
	 }           
  }


                                                                                                                                                                                                   

      function overview(){                                                                                                                                                                               

        $this->refreshAll();

        $this->set('title_for_layout', __('System Overview',true));

        $this->set('cdr',$this->Cdr->find('all'));

                //Fetch data from unassociated models                                                                                                                                                    
                $this->loadModel('IvrMenu');                                                                                                                                                             
                $this->IvrMenu->unbindModel(array('hasMany' => array('Node')));                                                                                                   
                $ivr = $this->IvrMenu->find('all');                                                                                                                                                      
                                                                                                                                                                                                         
                $this->loadModel('Message');                                                                                                                                                             
                $messages = $this->Message->find('all', array('order' => array('Message.created DESC')));  
                                                                                                                                                                                                         
                $this->loadModel('Bin');                                                                                                                                                                 
                $bin = $this->Bin->find('all');                                                                                                                                                          
                                                                                                                                                                                                         
                $this->loadModel('Poll');               
                $this->Poll->unbindModel(array('hasMany' => array('User')));                                
                $polls = $this->Poll->find('all');
                $this->set(compact('messages','bin','polls','ivr'));
                $this->render(); 

        }
}
?>
