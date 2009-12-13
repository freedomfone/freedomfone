<?php

    if(isset($_POST['cdr'])) {

    $cdr = simplexml_load_string($_POST['cdr']);

    // do your validation code here

    // This is just an example, you would probably want to store this in a database instead

    $fh = fopen("/tmp/cdr.xml".uniqid(), 'wb');

    fwrite($fh,"Channel created at " . $cdr->callflow->times->created_time . "\n");
    fwrite($fh, $_POST['cdr'] . "\n\nprint_r\n\n");
    fwrite($fh,print_r($cdr,true)."\n\n");
    fclose($fh);

    }
?>
