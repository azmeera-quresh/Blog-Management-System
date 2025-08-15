<?php 
session_start();
// print_r($_REQUEST);
	require_once("../../require/connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';


	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "add_user"){
		// echo "working";
		$query = "INSERT INTO user (first_name, last_name, email, password, gender, date_of_birth ,user_image, address) VALUES ('".$_REQUEST['first_name']."','".$_REQUEST['last_name']."','".$_REQUEST['email']."','".$_REQUEST['password']."','".$_REQUEST['gender']."','".$_REQUEST['dob']."','".$_REQUEST['tmp_name']."','".$_REQUEST['address']."')";

		$result = mysqli_query($connection,$query);
		if($result){
			$user_id = mysqli_insert_id($connection);
			?>
			<div style="color: green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User (<?= $user_id ?>) Inserted Successfully</h3></strong></div>

			<?php
		}
		else{
			?>
			<div style="color: red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>">User Not Inserted Try Again Later</h3></strong></div>
			<?php
		}
			
		
		
	}
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_users"){

		if(isset($_REQUEST['search_input'])){
			$query = "SELECT * FROM user WHERE first_name LIKE '%".$_REQUEST['search_input']."%' OR email LIKE '%".$_REQUEST['search_input']."%' OR last_name LIKE '%".$_REQUEST['search_input']."%'";
		}
		else{
			$query = "SELECT * FROM user ORDER BY user_id DESC";
		}
		$users = mysqli_query($connection,$query);
		if($users->num_rows){
			$_SESSION['user']=$users->num_rows;

			?>
			<br>
			<table>
				<tr>
					<td><h3>Search: &nbsp </h3></td>
					<td><input type="text" placeholder="Search Here" id="search_user" class="p-1"></td>
					<td><button onclick="search_user()" class="btn btn-success " >Search</button></td>
				</tr>
			</table>
			<br>
			<table  border="1" cellpadding="12" cellspacing="2" width="30%" >
				<tr style="background-color: #0080ff; color: white;"  >
					<td><b>#</b></td>
					<td><b>User_image</b></td>
					<td><b>First_name</b></td>
					<td><b>Last_name</b></td>
					<td><b>Email</b></td>
					<td><b>Password</b></td>
					<td><b>Gender</b></td>
					<td><b>Date_of_birth</b></td>
					<td><b>Address</b></td>
					<td><b>Is_active</b></td>
					<td><b>Is_approved</b></td>
					<td><b>Actions</b></td>
				</tr>
				<?php 
				$i = 1;
				// print_r($user['user_image']);
				while($user = mysqli_fetch_array($users)){
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><img src="../../<?= $user['user_image'] ?>" width="50px" height="50px" ></td>
						<td><?= $user['first_name'] ?></td>
						<td><?= $user['last_name'] ?></td>
						<td><?= $user['email'] ?></td>
						<td><?= $user['password'] ?></td>
						<td><?= $user['gender'] ?></td>
						<td><?= $user['date_of_birth'] ?></td>
						<td><?= $user['address'] ?></td>
						<td><?= $user['is_active'] ?>
							<button class="actions btn btn-success"  onclick="active(<?php echo $user['user_id']?>)" title="Active" id = "active" ><i class='fas fa-eye'></i></i></button>
							<button class="actions btn btn-danger"  onclick="inactive(<?php echo $user['user_id']?>)" title="Inactive" ><i class='fas fa-eye-slash'></i></button>
						</td>
						<td><?= $user['is_approved'] ?>
							<button class="actions btn btn-success"  onclick="approve(<?php echo $user['user_id']?>)" title="Approve"  ><i class='fas fa-plus-circle'></i></i></button>
							<button class="actions btn btn-danger"  onclick="reject(<?php echo $user['user_id']?>)" title="Reject" ><i class='fas fa-minus-circle'></i></button>
						</td>
						<td>

							<button class="actions btn btn-success"  onclick="edit_user(<?= $user['user_id']?>)" title="Edit"  ><i class='fas fa-edit' ></i></button>
							<button class="actions btn btn-danger"  onclick="delete_user(<?php echo $user['user_id']?>)" title="Delete" ><i class="fa fa-trash-o"></i></button>
						</td>
					</tr>
					<?php
					$i++;
				} //end of while

				 ?>
			</table>
			<?php
		}// end of inner IF
		else{
			?>
			<div style="color: red">No Any Records Found</div>			
			<?php
		}
	}// end of elseif
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "delete_user"){
		$query = "DELETE FROM user WHERE user_id = ".$_REQUEST['user_id'];
		$result = mysqli_query($connection,$query);

		if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Deleted Successfully</h3></strong></div>
			<?php
		}
		else{
			?>
			<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Not Deleted Try Again Later</h3></strong></div>
			<?php
		}
	}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_user"){
			// echo "Edit"; die;
			$query = "SELECT * FROM user WHERE user_id =".$_REQUEST['user_id']."";
			// echo $query; 
			$result = mysqli_query($connection,$query);

			$user = mysqli_fetch_assoc($result);

			?>
			<div class="container mt-2 border border-1">
				<div class="row">
					<div class="col-md-12">
						

			<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> EDIT USER </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr>
					<tr>
						<td><b>First Name: </b></td>
						<td><input type="text" id="first_name" value="<?= $user['first_name']?>"></td>
					</tr>
					<tr>
						<td><b>Last Name: </b></td>
						<td><input type="text" id="last_name" value="<?= $user['last_name']?>"></td>
					</tr>
					<tr>
						<td><b>Email: </b></td>
						<td><input type="text" id="email" value="<?= $user['email']?>"></td>
					</tr>
					<tr>
						<td><b>password: </b></td>
						<td><input type="text" id="password" value="<?= $user['password']?>"></td>
					</tr>
					<tr>
						<td><b>Gender: </b></td>
						<td><select id="gender"><option value="Male">Male</option>
							<option value="Female">Female</option></select></td>
					</tr>
					<tr>
						<td><b>Date of birth: </b></td>
						<td><input type="text" id="date_of_birth" value="<?= $user['date_of_birth']?>"></td>
					</tr>
					<tr>
						<td><b>User Image: </b></td>
						<td><input type="file" id="user_image" value="<?= $user['user_image']?>"></td>
					</tr>
					<tr>
						<td><b>Address: </b></td>
						<td><input type="text" id="address" value="<?= $user['address']?>"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button onclick="update_user(<?php echo $_REQUEST['user_id'] ?>)" class="btn btn-success">Update User</button>
							<button  onclick="cancel()" class="btn btn-danger">Cancel</button>
						</td>
					</tr>
				</table>
				</div>
				</div>
			</div>
			<?php




		}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "update_user"){
			// echo "Update";

			$query = "UPDATE user SET first_name = '".$_REQUEST['first_name']."', last_name = '".$_REQUEST['last_name']."', email = '".$_REQUEST['email']."', password ='".$_REQUEST['password']."', gender = '".$_REQUEST['gender']."', date_of_birth = '".$_REQUEST['date_of_birth']."', user_image = '".$_REQUEST['user_image']."', address = '".$_REQUEST['address']."' WHERE user_id = ".$_REQUEST['user_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "active"){
			// echo "Update";
			

			$query = "UPDATE user SET is_active = '".$_REQUEST['is_active']."' WHERE user_id = ".$_REQUEST['user_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "inactive"){
			// echo "Update";
			

			$query = "UPDATE user SET is_active = '".$_REQUEST['is_active']."' WHERE user_id = ".$_REQUEST['user_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "approve"){
			// echo "Update";
			$user_query = "SELECT * FROM user WHERE user_id='".$_REQUEST['user_id']."'";
$user_result = mysqli_query($connection, $user_query);

$users= mysqli_fetch_assoc($user_result);

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "dummy723example@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "dummy@723";
//Set who the message is to be sent from
// $mail->setFrom('phpbasic2k22@gmail.com', 'Php Basic');
$mail->setFrom($users['email']);



//Set an alternative reply-to address
//$mail->addReplyTo('hidayatrust1788@gmail.com', 'Hidaya Trust');
//Set who the message is to be sent to
$mail->addAddress($users['email']);

//Set the subject line
$mail->Subject = "Request for (Account registeration)";
//Read an HTML message body
//$mail->isHTML();
$mail->msgHTML("Dear"." ".$users['first_name']." ".$users['last_name'].".<br>"."Your account registeration request is Approved.<br> Here is your Email:".$users['email']." "."and "."Password: "." ".$users['password']);

if (!$mail->send()) {
   echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   echo 'Message sent!';
}

			$query = "UPDATE user SET is_approved = '".$_REQUEST['is_approved']."' WHERE user_id = ".$_REQUEST['user_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "reject"){
			// echo "Update";
			$user_query = "SELECT * FROM user WHERE user_id='".$_REQUEST['user_id']."'";
$user_result = mysqli_query($connection, $user_query);

$users= mysqli_fetch_assoc($user_result);

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "dummy723example@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "dummy@723";
//Set who the message is to be sent from
// $mail->setFrom('phpbasic2k22@gmail.com', 'Php Basic');
$mail->setFrom($users['email']);



//Set an alternative reply-to address
//$mail->addReplyTo('hidayatrust1788@gmail.com', 'Hidaya Trust');
//Set who the message is to be sent to
$mail->addAddress($users['email']);

//Set the subject line
$mail->Subject = "Request for (Account registeration)";
//Read an HTML message body
//$mail->isHTML();
$mail->msgHTML("Dear"." ".$users['first_name']." ".$users['last_name'].".<br>"."Your account registeration request is Rejected due to some reason.<br> You can not login.");

if (!$mail->send()) {
   echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   echo 'Message sent!';
}

			$query = "UPDATE user SET is_approved = '".$_REQUEST['is_approved']."' WHERE user_id = ".$_REQUEST['user_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>User ID: (<?= $_REQUEST['user_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "get_form"){
			?>	<div class="container mt-5 border border-1">
				<div class="row">
		<div class="col-md-12 ">
			<form name="register" action="" method="POST" enctype="multipart/form-data" style="width: 80%; height: 80%;">
				<fieldset>
					
					<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> ADD USER </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr>
					<tr>
						<td><b>First Name: </b></td>
						<td><input type="text" class="form-control" id="fname" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>Last Name: </b></td>
						<td><input type="text" class="form-control" id="lname" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>Email: </b></td>
						<td><input type="text" class="form-control" id="email" maxlength="50"></td>
					</tr>
					<tr>
						<td><b>password: </b></td>
						<td><input type="password" class="form-control" id="pass" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>Gender: </b></td>
						<td>
							<select id="gender">
								<option value="male">Male</option>
								<option value="female" >Female</option>
							</select>
						</td>
					</tr>
					<tr>
						<td><b>Date of birth: </b></td>
						<td><input type="Date" class="form-control"  id="dob"></td>
					</tr>
					<tr>
						<td><b>User Image: </b></td>
						<td><input type="file" class="form-control"  id="image" accept="image/*"></td>
					</tr>
					<tr>
						<td><b>Address: </b></td>
						<td><textarea class="form-control"  id="addrs"></textarea></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button onclick="add_user()" class="btn btn-success">Add User</button>
							<button  onclick="cancel()" class="btn btn-danger">Cancel</button>
						</td>
					</tr>
				</table>
			</fieldset>
			</form>
		</div>
	</div>
</div>
			<?php
		}

		
	?>
