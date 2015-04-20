<?php

include_once "storageController.php";

    function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    $ds          = DIRECTORY_SEPARATOR;
    $storeFolder = 'storage';
    $sub_rand_directory = generateRandomString();
    if (!empty($_FILES)) {
        $targetPath  = dirname( __FILE__ ) . $ds. $storeFolder . $ds.$sub_rand_directory.$ds;

        $tempFile = $_FILES['file']['tmp_name'];



        $targetFile =  $targetPath. $_FILES['file']['name'];  //5

        if(saveOnDb($targetFile,$sub_rand_directory)){
            if(!@mkdir($targetPath, 0777,true)){
                die("can't create folder");
            }
            move_uploaded_file($tempFile,$targetFile); //6
            echo "http://color.com/getfile.php?link=".$sub_rand_directory;
        }else{
            echo "can't save in db";
        }


    }else{
        echo  "empty";
    }
?>