<?php

$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "easy_share";
mysql_connect($hostname,$username,$password) OR DIE("Не могу создать соединение ");
mysql_select_db($dbName) or die(mysql_error());
mysql_set_charset('utf8');




?>