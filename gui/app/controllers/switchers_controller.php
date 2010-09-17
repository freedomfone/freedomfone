<?php
/****************************************************************************
 * switchers_controller.php	- Controller for language switchers. 
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

App::import("Vendor", "ivr_xml", false, null, 'ivr_xml.php'); 
App::import("Xml");

class SwitchersController extends AppController{

	var $name = 'Switchers';
	var $helpers = array('Ajax','Javascript');      
        var $components = array('RequestHandler');



   function test(){

    $types = array('lam','ivr');
    $this->set(compact('types'));

  }


function ajax_get_user_pages() {

         // init

         debug($this->params);
         $type = $this->params['form']['type'];
         $this->layout = null;

         if($type=='lam'){

                $entries=array('lam1','lam2','lam3');

                } else

                $entries= array('ivr1','ivr2','ivr3');

         $this->set(compact('entries'));
}



   function update_select() {

     if(!empty($this->data[‘Category’][‘id’])) {

           $cat_id = (int)$this->data[‘Category’][‘id’];
           $options = $this->Article->generateList(array(‘category_id’=>$cat_id));
           $this->set(‘options’,$options);
     }

}



   function index(){

      	$this->pageTitle = 'Switchers';           
	$this->set('switchers', $this->paginate());

	}


        function add(){

      	$this->pageTitle = 'Language switcher : Add';           

            if (empty($this->data)){

	       $lam = $this->Switcher->query('select * from lm_menus');
	       $ivr = $this->Switcher->query('select * from ivr_menus');
               $this->set(compact('lam','ivr'));
	       $this->render();
            } else {

            //Save data

/*
	$this->data['SwitcherFile']['file_instruction'] = $this->data['Switcher']['file_instruction'];
	$this->data['SwitcherFile']['file_invalid'] = $this->data['Switcher']['file_invalid']; 

	$this->unset(data['Switcher']['file_instruction']);
	$this->unset(data['Switcher']['file_invalid']);*/

	$this->Switcher->save($this->data);

        $this->redirect(array('action' => '/'));   
         }
}


/*   function add(){

      	$this->pageTitle = 'Language switcher : Add';           

        $ivr_settings = Configure::read('IVR_SETTINGS');
        $ivr_default  = Configure::read('IVR_DEFAULT');

      
	//List all nodes
	$nodes = $this->IvrMenu->Node->find('list');
        $this->set(compact('nodes'));


      //Render empty form
      if (empty($this->data)){

	//Render view
	$this->render();
      }


      //Form data exists. Validate and save form data
      else{

        //set instance_id
	$this->data['IvrMenu']['instance_id']=$iid;


	$this->data['IvrMenuFile']['file_long'] = $this->data['IvrMenu']['file_long'];
	$this->data['IvrMenuFile']['file_short'] = $this->data['IvrMenu']['file_short'];
	$this->data['IvrMenuFile']['file_exit'] = $this->data['IvrMenu']['file_exit'];
	$this->data['IvrMenuFile']['file_invalid'] = $this->data['IvrMenu']['file_invalid']; 

	$this->data['IvrMenu']['file_long']= false;
	$this->data['IvrMenu']['file_short']= false;
	$this->data['IvrMenu']['file_exit']= false;
	$this->data['IvrMenu']['file_invalid']= false;


	if ($this->IvrMenu->save($this->data['IvrMenu'] )){

	   //Retrieve id of saved poll
	   $id = $this->IvrMenu->getLastInsertId();

		foreach($this->data['IvrMenuFile'] as $key => $file){

			if ($file['size']){
				$file['fileName']=$id."_".$key;
				$fileData[] = $file;
			} elseif ($file['error']==1 && !$file['size']) {
			       $this->_flash(__('Failure (filesize)',true).' : '.$file['name'], 'error');							
			   }			  		   
		   }

                 if(isset($fileData)){

	          //Upload one or more wav files
		  $fileOK = $this->uploadFiles($ivr_settings['path'].IID."/".$ivr_settings['dir_menu'], $fileData ,false,'audio',true,true);


                        //If file upload is ok		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

                                           $filename = $this->getFilename($fileOK['files'][$key]);
					   $name= $fileData[$key]['name'];
                                           $part = strstr($filename,'_');
   			                   $field=substr($part,1,strlen($part));
                                           $this->IvrMenu->saveField($field,$name);
		   			   $this->log("INFO; Action: Switcher edit; Type: new audio file : ".$url, "ivr");
					   $this->_flash(__('Success',true).' : '.$fileOK['original'][$key], 'success');							
				   }
					
				}

			if(array_key_exists('errors', $fileOK)) {

				   foreach ($fileOK['errors'] as $key => $error ){
				   	   $this->log("Msg: UPLOAD  ERROR, Error: ".$error, 'leave_message');	
					   $this->_flash($error, 'error');

				    }
			}

                 }

		 $this->IvrMenu->setParent($id);

	        //Recreate ivr.xml
		$this->IvrMenu->writeIVR();
	 	$this->redirect(array('action' => 'index'));


         }

	 } 

  
   }*/


/*
 *
 * @param int $id
 *
 * Updates database entry, and uploads new files.
 *
 */


   function edit($id = null){

      	$this->pageTitle = 'Language switcher : Edit';           

            $settings = Configure::read('SWITCHER_SETTINGS');


   	    //Invalid id
	  if (!$id && empty($this->data)){

	     $this->_flash(__('Invalid option', true),'warning'); 
  	     $this->log("WARNING; Action: Edit; Type: Incorrect id (".$id.")", "switcher");	
	     $this->redirect(array('action'=>'index')); 
	  }


	  //No submitted form data. Fetch data from db and display
    	  elseif(empty($this->data['Switcher'])){

		//Set id
		$this->Switcher->id = $id;

		//Fetch list of all nodes
	       $lam = $this->Switcher->query('select * from lm_menus');
	       $ivr = $this->Switcher->query('select * from ivr_menus');
               $this->set(compact('lam','ivr'));

	
		//Fetch single record, and render view
		$this->data = $this->Switcher->findById($id);
		$this->render();


          }


	  //Save submitted data.
	  else {


		   foreach($this->data['SwitcherFile'] as $key => $file){
			if ($file['size']){
				$file['fileName']=$id."_".$key;
				$fileData[] = $file;
			}  elseif ($file['error']==1 && !$file['size']) {
			        $this->log("ERROR; Action: Upload file; Type: filesize (".$file['size'].")", "switcher");								
                                $this->_flash(__('The following file could not be uploaded due to file size restrictions',true).': '.$file['name'],'error');			
		        }		  
		   }
		 
                    //If file(s) exists -> upload 
                    if(isset($fileData)){
                        
                         $fileOK = $this->uploadFiles($settings['path'].$settings['dir_menu'], $fileData ,false,'audio',true,true);

                        //If file upload OK -> save to database		      
                        if(array_key_exists('urls', $fileOK)) {

                                foreach ($fileOK['urls'] as $key => $url ){

					   $this->_flash(__('Success',true).' : '.$fileOK['original'][$key], 'success');							
					   $this->log("INFO; Action: Edit switcher; Type: ".$url, "switcher");
				   }
					
			}

                        //If errors exists -> flash
			if(array_key_exists('errors',$fileOK)){

				foreach ($fileOK['errors'] as $key => $error){
					$this->_flash(__('Success',true).' : '.$error, 'error');				
					$this->log("ERROR; Action: Upload file; Type: ".$error, "switcher");								
				}
			}

                     }


	$file_instruction = $this->data['SwitcherFile']['file_instruction']; 
	$file_invalid     = $this->data['SwitcherFile']['file_invalid']; 

        //unset($this->data['Switcher']['file_instruction']); 
        //unset($this->data['Switcher']['file_invalid']);


        $this->data['Switcher']['file_instruction'] = $file_instruction['name'];
        $this->data['Switcher']['file_invalid'] = $file_invalid['name'];


        $model = $this->data['Switcher']['type'];
        $this->data['Switcher']['id_1']= $this->data['Services'][$model][1];
        $this->data['Switcher']['id_2']= $this->data['Services'][$model][2];
        $this->data['Switcher']['id_3']= $this->data['Services'][$model][3];


        $this->Switcher->save($this->data['Switcher']);



         //Save text based form data

	 //$this->IvrMenu->customizeSave($this->data);

	 //Update IVR xml file
	 //$this->IvrMenu->writeIVR();

	 //Redirect to index

	 $this->redirect(array('action' => 'index'));


	 } 

   }



/*    function delete ($id){


	     
             //Check if IVR is parent
    	     $isParent = $this->IvrMenu->isParent($id);

	     
	   //Delete IVR

    	     	if($this->IvrMenu->delete($id,true)){
		   $this->log("INFO; Action: Switcher delete; Type: ".$id.", "ivr");
		   $this->Session->setFlash(__('The voice menu has been deleted.',true),'default',array('class'=>'message_success'));
		 }

		 //If IVR was parent
		 if($isParent && !$this->IvrMenu->lastIVR()){

			//Get id of new parent (first in the list)       	   
			$this->IvrMenu->id = $this->IvrMenu->nextEntry();
		
			//Set new parent
	     		$this->IvrMenu->setNewParent();
		}	

	  

	  	$this->redirect(array('action' => '/index'));
      }*/



}

?>