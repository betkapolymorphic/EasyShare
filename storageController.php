<?php

include_once 'db.php';
$returnObject = new stdClass();

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
function removeOldFiles(){
    $q = "SELECT iddata as id, storage FROM data where now()-create_date >= 1200 ";
    $toRemove = array();
    $result = mysql_query($q);
    while ($line = mysql_fetch_array($result, MYSQL_ASSOC)) {

        $s=$line['storage'];
        $s = substr($s,0,strrpos($s,DIRECTORY_SEPARATOR,-1));
        if(strlen($s)>0){
            echo $s."<br>";
            unlink($line['storage']);
            rmdir($s);
            array_push($toRemove,$line['id']);
            //  return;
        }


    }
    foreach ($toRemove as $id) {
        $q = "delete from data where iddata=$id";
        mysql_query($q);
    }

}
?>