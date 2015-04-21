<?php

    include_once "storageController.php";
    include_once 'GoogleUrlApi.php';
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
                $returnObject->code = 1;
                $returnObject->text="can't create folder";
                die(json_encode($returnObject));
            }
            move_uploaded_file($tempFile,$targetFile); //6



            $returnObject->code = 0;
            $returnObject->text="$server_link/g.php?l=".$sub_rand_directory;

          /*  $key = 'AIzaSyBEqCEu9KUw0Wy0Vo6qDH-dfPHOwXNBghw';
            $googer = new GoogleURLAPI($key);
            $returnObject->text=$googer->expand($returnObject->text);
*/

        }else{
            $returnObject->code = 2;
            $returnObject->text="can't save in db";

        }


    }else{
        $returnObject->code = 3;
        $returnObject->text="you send empty";

    }
    die(json_encode($returnObject));
?>