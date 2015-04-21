<?php
error_reporting(E_ERROR | E_PARSE);
$hostname = "localhost";
$username = "root";
$password = "";
$dbName = "easy_share";
mysql_connect($hostname,$username,$password) OR DIE("Не могу создать соединение ");
mysql_select_db($dbName) or die(mysql_error());
mysql_set_charset('utf8');

$server_link = "http://ec2-54-200-174-156.us-west-2.compute.amazonaws.com";



?>