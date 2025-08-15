<!DOCTYPE html>
<html>
<head>
	<title>blog management system - about us</title>
</head>
<body>

<?php 
require_once("header.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'admin/PHPMailer/src/PHPMailer.php';
require 'admin/PHPMailer/src/SMTP.php';
require 'admin/PHPMailer/src/Exception.php';
?>

<script>
function validate_form()
{
	var user_name = document.forms[ "feedback_form" ][ "user_name" ].value;
	var email = document.forms[ "feedback_form" ][ "email" ].value;
	var atpos = x.indexOf( "@" );
	var dotpos = x.lastIndexOf( "." );	
	var feedback = document.forms[ "feedback_form" ][ "feedback" ].value;	
	if ( user_name == null || user_name == "" ) {
			alert( "User Name must be filled out" );
			return false;
		}
	if ( atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length ) {
			alert( "Not a valid e-mail address" );
			return false;
		}
	if ( feedback == null || feedback == "" ) {
			alert( "Feedback field must be filled out" );
			return false;
		}
}
  </script>

<div class="container" style="max-width: 1200px;">
	<div class="row">
		<?PHP
		include( "require/connection.php" );

		if ( isset( $_POST[ 'submit' ] ) ) {
			$user_name = $_POST[ 'user_name' ];
			$email = $_POST[ 'email' ];
			$feedback = $_POST[ 'feedback' ];
			
			$user_id = "Null";
			$query ="SELECT user_id from user where email= '".$email."'";
			$result =mysqli_query($connection,$query);
			if ($result->num_rows > 0) {
				$user= mysqli_fetch_assoc($result);
				$user_id = $user['user_id']; 
			}
$query = "INSERT INTO `user_feedback` (`user_id`,`user_name`, `user_email`, `feedback` ) VALUES (".$user_id.",'".$user_name."','".$email."','".$feedback."')";
			if ( mysqli_query( $connection, $query ) ) {
				echo "<center><div style='margin-top:10px; color: green;'><strong><h3 style='margin-top: 20px; margin-bottom: 10px;'> Your Feedback has Sucessfully Submitted. Admin will response you soon.</h3></strong></div></center>";
				  if($result)
  {

    $user_query = "SELECT * FROM user_feedback WHERE user_name = '".$user_name."'";
$user_result = mysqli_query($connection, $user_query);

$users= mysqli_fetch_assoc($user_result);

				  	// print_r($users);
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
$mail->setFrom($users['user_email']);



//Set an alternative reply-to address
//$mail->addReplyTo('hidayatrust1788@gmail.com', 'Hidaya Trust');
//Set who the message is to be sent to
$mail->addAddress($users['user_email']);

//Set the subject line
$mail->Subject = "Feedback Alert";
//Read an HTML message body
//$mail->isHTML();
$mail->msgHTML("Dear Admin! "." ".$users['user_name']." ".".<br>"."having Email :".$users['user_email']." "."has send feedback on portal. Feedback: [".$users['feedback']."]. Kindly visit AmazeBlog for further details.  ");

if (!$mail->send()) {
   echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   echo 'Message sent!';
}

?>
         
    <?php
  }
  

		} else {
				//error message if SQL query fails
				echo "<br><Strong>Feedback Faliure. Try Again</strong><br> Error Details: " . $query . "<br>" . mysqli_error( $connection);
			}

	}	
		?>
		

	</div>
</div>
<div class="container mt-5 mb-5" id="contact_us">

	<h2  class="p-1 ">CONTACT US</h2>
	<hr style="width:100%; height:4px; background-color: black" >
	
	<div class="row">
		<div class="col-lg-2"></div>
		<div class="col-lg-4 mt-5">
			<img src="images/reg.jpg" width="400px" height="400px">
		</div>
		<div class="col-lg-4 mt-5">
			<form  name="feedback_form" action="" method="POST"  onsubmit="return validate_form()">
			<div class="mb-3">
				 <label for="exampleFormControlInput1" class=" form-label">User Name</label>
			  <input type="text" name="user_name" class="form-control" id="exampleFormControlInput1" placeholder="name">
			</div>
			<div class="mb-3">
			  <label for="exampleFormControlInput1" class="form-label">Email address</label>
			  <input type="email" name="email" class="form-control" id="exampleFormControlInput1" placeholder="name@example.com">
			</div>
			<div class="mb-3">
			  <label for="exampleFormControlTextarea1" class="form-label">Feedback</label>
			  <textarea name="feedback" class="form-control" id="exampleFormControlTextarea1" placeholder="Your Feedback here." rows="3"></textarea>
			</div>
		<div>
			<input type="submit" name="submit" value="Submit" class="btn btn-primary">
          <input type="reset" name="reset" value="Clear" class="btn btn-danger" >
		</div>
	</form>
		</div>
		<div class="col-lg-2"></div>
	</div>
</div>


<?php 
require_once 'footer.php';
 ?>
</body>
</html>