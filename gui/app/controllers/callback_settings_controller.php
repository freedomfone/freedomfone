<?php

class CallbackSettingsController extends AppController{

	var $name = 'CallbackSettings';
	var $helpers = array('Flash','Session');      



	function index(){

		 $iid=IID;

		if (empty($this->data)) {
		       $this->data = $this->CallbackSetting->find('first', array('conditions' => array('instance_id' => $iid)));
		}

		if (!empty($this->data)) {

		   $this->data['CallbackSetting']['instance_id'] = $iid;
		   $this->CallbackSetting->save($this->data);
		}
	}

}
?>
