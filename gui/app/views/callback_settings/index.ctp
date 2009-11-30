<?php
$callback_default  = Configure::read('CALLBACK_DEFAULT');

$user_limit = array('0' => __("No limit",true),'10'=>10,'25'=>25,'50'=>50,'100'=>100);
$time_limit = array('0' => __("No limit",true),'12'=>'12h','24'=>'24h','48'=>'2 days','72'=>'4 days','168'=> '1 week');
echo "<h1>".__("Callback settings",true)."</h1>";

        if($session->check('Message.flash')){
                  $session->flash();
		}  


echo $form->create('CallbackSetting', array('type' => 'post', 'action' => 'index','enctype' => 'multipart/form-data'));

echo "<table>";
/*echo $html->tableCells(array(
     array(__("SMS code",true),		$form->input('sms_code', array('type'=>'text','size' => '10','label'=>false))),
     array(array(__("Code for incoming SMS to generate a Callback",true),"colspan='2' class='formComment'"))));*/

echo $html->tableCells(array(
     array(__("Default response",true),		$form->input('response_type', array('options' => $callback_default['response_type'],'label' => false, 'selected' => $this->data['CallbackSetting']['response_type']))),
     array(array(__("Default callback response",true),"colspan='2' class='formComment'"))));

echo $html->tableCells(array(
     array(__("Max calls",true),		$form->input('limit_user', array('options' => $user_limit,'label'=>false, 'selected' => $this->data['CallbackSetting']['limit_user']))),
     array(array(__("Limit the number of calls per user per day.",true),"colspan='2' class='formComment'"))));

echo $html->tableCells(array(
     array(__("Period",true),		$form->input('limit_time', array('options' => $time_limit,'label'=>false, 'selected' => $this->data['CallbackSetting']['limit_time']))),
     array(array(__("Limit the number of calls per user per day.",true),"colspan='2' class='formComment'"))));

echo "</table>";

echo $form->end('Save'); 
?>
<p>Please note that the Callback service cannot be tested via the demo site.</p> 
