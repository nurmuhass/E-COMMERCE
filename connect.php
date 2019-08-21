<?php
$conn_error = 'Could not connect.';

$mysql_host = 'localhost';
$mysql_user = 'nurmuhass';
$mysql_pass = 'Nur08102889269';

$mysql_connect = @mysqli_connect($mysql_host, $mysql_user, $mysql_pass);
$mysql_db = 'MTC';

if(!@mysqli_connect($mysql_host, $mysql_user, $mysql_pass) || !@mysqli_select_db($mysql_connect, $mysql_db))
{
	die($conn_error);
}

?>