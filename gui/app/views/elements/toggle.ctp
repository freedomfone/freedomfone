<?php
echo $ajax->div('toggle'); 
echo $form->input($field,array('type'=>'checkbox','checked'=>$checked,'label'=>false));
echo $ajax->divEnd('toggle');

?>