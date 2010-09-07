<?php

if ($messages = $session->read('Message.multiFlash')) {
     foreach($messages as $k=>$v) $session->flash('multiFlash.'.$k);
          }

?>