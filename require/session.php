<?php 

session_start();

print_r($_SESSION['user']);
if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 1)
{
	header("location:admin/index.php"); 
}
else if(isset($_SESSION['user']['role']) && $_SESSION['user']['role'] == 2)
{
	header("location:index.php");
}


?>