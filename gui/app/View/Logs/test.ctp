<h3>Search Reservations</h3>
<?php
echo $this->Html->css('screen');
// we need some javascripts for this
echo $this->Html->script('jquery');
// create the form
echo $this->Form->create(false, array('type' => 'get', 'default' => false));
echo $this->Form->input('query', array('type' => 'text','id' => 'query', 'name' => 'query', 'label' => false))?>
<div id="loading" style="display: none; ">
<?php
echo $this->Html->image('ajax_clock.gif');
?>
</div>

	

<?php

$event['Event']['id'] =1;


$this->Js->get('#query')->event('keyup', $this->Js->request( 
array('controller' => 'sales','action' => 'searchReservations', $event['Event']['id']), 
array( 
'update' => '#view', 
'async' => true,
'dataExpression' => true, 
'method' => 'post', 
'data' => $this->Js->serializeForm(array('isForm' => false, 'inline' => true))) 
));
?>