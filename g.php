<?php

    function pathinfo_utf($path) {

        if (strpos($path, '/') !== false)
            $basename = end(explode('/', $path));
        elseif (strpos($path, '\\') !== false)
            $basename = end(explode('\\', $path));
        else
            return false;

        if (!$basename)
            return false;

        $dirname = substr($path, 0,
            strlen($path) - strlen($basename) - 1);

        if (strpos($basename, '.') !== false) {
            $extension = end(explode('.', $path));
            $filename = substr($basename, 0,
                strlen($basename) - strlen($extension) - 1);
        } else {
            $extension = '';
            $filename = $basename;
        }

        return array (
            'dirname' => $dirname,
            'basename' => $basename,
            'extension' => $extension,
            'filename' => $filename
        );
    }

include_once 'storageController.php';

    if(!isset($_GET['l'])){
        die("Error : empty link");
    }
    $file = getFile($_GET['l']);

    if ($file && file_exists($file) ) {


        header('Content-Description: File Transfer');
        header('Content-Type: application/octet-stream');
        header('Content-Disposition: attachment; filename='.pathinfo_utf($file)['basename']);
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