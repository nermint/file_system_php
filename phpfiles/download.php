<?php

    $fname=trim($_GET['file_name']);
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($fname));
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($fname));
    readfile($fname);

?>