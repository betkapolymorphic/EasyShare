<?php
/**
 * Created by PhpStorm.
 * User: Alexeev
 * Date: 20-Apr-15
 * Time: 02:04 PM
 */
    include_once 'db.php';
    function saveOnDb($file_location,$link){
        $file_location = str_replace(DIRECTORY_SEPARATOR,DIRECTORY_SEPARATOR.DIRECTORY_SEPARATOR,$file_location);
        $q = "insert into data VALUES (null,'$file_location',now(),'$link')";
        return mysql_query($q);
    }
    function getFile($link){
        $q = "select storage from data where link like '$link'";
        $result = mysql_query($q) or die('Запрос не удался: ' . mysql_error());
        if ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {
            return $line['storage'];
        }else{
            return null;
        }
    }
    function getOldFiles(){
        $q = "select storage from data where create_time";
    }


?>                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                             