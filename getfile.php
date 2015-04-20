<?php
    include_once 'storage_controller.php';

    if(!isset($_GET['link'])){
        die("Error : empty link");
    }
    $file = getFile($_GET['link']);

    if ($file && file_exists($file) ) {


        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.basename($file));
        header('Content-Transfer-Encoding: binary');
        header('Expires: 0');
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Pragma: public');
        header('Content-Length: ' . filesize($file));

        ob_clean();
        flush();
        readfile($file);
        exit;

    }else{
        die("Your link incorect or file was deleted");
    }


?>