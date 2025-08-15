<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>blog management system</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php require_once("header.php"); 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'admin/PHPMailer/src/PHPMailer.php';
require 'admin/PHPMailer/src/SMTP.php';
require 'admin/PHPMailer/src/Exception.php';
?>

<div class="container mt-5 mb-5 border border-1  p-5">
  <h3 > PASSWORD RECOVERY</h3>
  <hr>
        <?php 
if (isset($_REQUEST['submit'])) {
  $query = "SELECT * FROM USER WHERE email = '".$_REQUEST['email']."'";
  $result= mysqli_query($connection,$query);
  if($result)
  {

$users= mysqli_fetch_assoc($result);

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
$mail->Subject = "Request for (Password Recover)";
//Read an HTML message body
//$mail->isHTML();
$mail->msgHTML("Dear"." ".$users['first_name']." ".$users['last_name'].".<br>"."Your account Email for login is:".$users['email']." "."and your forgotten Password is: "."Password: "." ".$users['password'].". ");

if (!$mail->send()) {
   echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   echo 'Message sent!';
}
?>
          <center><div style="color: green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Password Credentials Sent On (<?= $_REQUEST['email'] ?>) Successfully.</h3></strong></div></center>

    <?php
  }
  else
  {
    ?>
              <div style="color: green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Password Credentials not sent. Try Again Later.</h3></strong></div>

    <?php
  }
}
      ?>
  <div class="row m-3  g-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-5 col-xs-12 col-md-5 col-sm-12 p-3 " >
        <form action="" method="POST">
          <label for="staticEmail" class="col-sm-10 col-form-label" style="margin-top: 50px;">Enter Your Email To Recover Password:</label>
            <input type="text" name="email" class="form-control" id="staticEmail" placeholder="email@example.com">
          
        <div>
          <input type="submit" name="submit" value="Send"  class="btn btn-primary mt-3 mb-3">

          <a href="registration_form.php" style="text-decoration: none;" class="mt-5"><p onmousemove="this.style.color='red'" onmouseout="this.style.color='blue'">To Create New Account Click here</p></a>

        </div>
      </form>

    </div>

    <div class="col-lg-5">
      <img src="images/login.jpg" width="500" height="500" >
    </div>
    <div class="col-lg-1"></div>

  </div>
</div>

<?php 
require_once 'footer.php';
 ?>


<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>
</html>