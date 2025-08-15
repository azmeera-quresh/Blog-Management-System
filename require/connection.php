<?php

	mysqli_report(MYSQLI_REPORT_OFF);

$server = "localhost";
$user = "root";
$password = "";
$db_name = "17619_azmeera_qureshi";
$connection = mysqli_connect( $server, $user, $password, $db_name ); 
if (mysqli_connect_error())
	{ echo "Database Connection Failed! Error:".mysqli_connect_error()."error number : ".mysqli_connect_errno();}
//else
	//echo "Connection Successful";
?>