<?php 

	session_start();
	include( "require/connection.php" );

	if(isset($_POST['login']))
	{

		extract($_POST);
		$login_query = "Select * From user where email = ? and password=?";
		$login_stmt = mysqli_prepare($connection,$login_query);
		mysqli_stmt_bind_param($login_stmt,"ss",$email,$password);
		mysqli_stmt_execute($login_stmt);

		mysqli_stmt_bind_result($login_stmt,$user_id,  $role_id,$first_name,$last_name,$email  ,$password,$gender,$date_of_birth,$user_image,$address,$is_approved,$is_active,$created_at,$updated_at);
		mysqli_stmt_store_result($login_stmt);

		if(mysqli_stmt_num_rows($login_stmt) > 0)
		{
			mysqli_stmt_fetch($login_stmt);
			$data = [
				"user_id"   => $user_id,
				"first_name" =>$first_name,
				"last_name" =>$last_name,
				"role_id"		=> $role_id,
				"email"		=> $email,
				"password"		=> $password,
				"gender"		=> $gender,
				"date_of_birth"	=> $date_of_birth,
				"user_image"	=> $user_image,
				"address"	=> $address,
				"is_approved"	=> $is_approved,
				"is_active"	=> $is_active,
			];

			$_SESSION['user'] = $data;

			if($role_id == 1)
			{
				header("location:admin/index.php");
			}
			else if($role_id == 2 AND $is_approved = "approved")
			{
				header("location:index.php");
			}
			/*else if($role == 3)
			{
				header("location:author/index.php");
			}*/
			

		}
		else 
		{
			header("location:login.php?msg=Login Failed!...&class=red");
		}
		

	}


?>