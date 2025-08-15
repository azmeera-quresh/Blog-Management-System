<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>blog management system</title>

  
</head>
<body>
<?php 

require_once("header.php");
require_once("require/connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'admin/PHPMailer/src/PHPMailer.php';
require 'admin/PHPMailer/src/SMTP.php';
require 'admin/PHPMailer/src/Exception.php';

error_reporting(E_ALL & ~E_NOTICE);

?>

<div class="container mt-5 border border-1">
  <div class="row m-3 g-0">  

    <?php
    $post_id = $_REQUEST['post_id'];
    // echo $post_id;
    // echo $user_id;
    
    $query = "SELECT * FROM blog,post,user, category,`post_category` WHERE post.post_id = `post_category`.`post_id` AND blog.blog_id = post.`blog_id` AND category.category_id = `post_category`.`category_id`  AND user.`user_id`= blog.`user_id` AND post.post_id=".$_REQUEST['post_id'] ." " ;
    $result = mysqli_query($connection,$query);
    if ($result) 
    {
      while ($res = mysqli_fetch_assoc($result)) 
      { ?>
          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
              <div class="card shadow " >
                <img src="images/<?php echo $res['featured_image'] ?>" height=600px; class="card-img-top" alt="..."> 
                <div class="card-body m-3">
                  <h2 class="card-text mt-3" style="text-align: center;"><b><?php echo $res['post_title']  ?></b></h2>
                  <hr style="width:100%; height:4px; background-color: black" >
                  <p class="card-title text-primary float-start "><b> Blog Title: <?php echo $res['blog_title'] ?></b></p>
                  <p class="card-title text-primary float-end"><b>Author Name: <?php echo $res['first_name'] ?> </b></p>
                  <p class="card-title text-primary mb-3 " style="text-align: center;"><b>Category Name: <?php echo $res['category_title'] ?> </b></p>
                  <p class="card-text text-justify" style="text-align: justify;  word-wrap: break-word; line-height: 1.2em; overflow: hidden; "><?php echo $res['post_description']  ?></p>
                  </div>              
              </div>

                  <center>
                    <div class="container  border border-1 p-3 bg-dark">
                      <div class="row">
                  <div class="col-lg-4 col-md-4 col-sm-12 " ><a style="color: white; text-decoration: none ;" href=""  title="Like"><i class='fas fa-thumbs-up'></i> Like</a></div>
                  <div class="col-lg-4 col-md-4 col-sm-12"><a style="color: white; text-decoration: none ;" href="#comment_here"  title="comment"><i class='fas fa-comment'></i> Comment</a></div>
                  <div class="col-lg-4 col-md-4 col-sm-12"><a style="color: white; text-decoration: none ;" href="#"  title="share"><i class="fa fa-share"></i></i> Share</a></div></center>

                      </div>
                    </div>

                

      <?php
      }
    }
    // to show comment
    $query = "SELECT * FROM user_post_comment upc JOIN post p JOIN `user` u ON upc.`post_id`=p.`post_id` AND u.`user_id`=upc.`user_id` WHERE  is_comment_allowed = 'Allow' AND upc.is_active='Active' AND p.`post_id`=".$_REQUEST['post_id']." ";
    $result = mysqli_query($connection,$query);
    if ($result) {
       while ($res=mysqli_fetch_assoc($result)) {
        ?>
         <div class="container  border border-1 p-3 ">
<div class="card mb-3 shadow" >
    <div class="row g-0 ">
    <div class="col-md-4 ">
      <img src="<?php echo $res['user_image'] ?>" class="img-fluid rounded-start" alt="..." width="30%" height="30%">
    </div>
    <div class="col-md-8">
      <div class="card-body " >
        <h6 class="card-title text-primary"><?php echo $res['first_name']." ".$res['last_name'] ?></h6>
        <p class="card-text "><?php echo $res['comment'] ?></p>
        
      </div>
    </div>
  </div>
</div>
                    </div>
         <?php
       }
     } 
    ?>


  <div class="card-body shadow-lg mt-4">
    
  	 <tr><form method="POST">
              	<td><label class="form-label" id="comment_here"><b>Enter Comment:</b></label></td>
              	<td>
              		 <textarea id="comment"  name="comment" placeholder="Enter Comment Here" class="form-control mb-3 mt-3 " ></textarea>
              	</td>
              	<td>
      <input type="submit" name="submit" value="Add Comment" class="btn btn-primary">

                </td>

                
              </form></tr>
<?php 
 
?>
              <?php
  if ( isset( $_POST[ 'submit' ] ) ) 
      {
      $comment = $_POST[ 'comment' ];
      
      $user_id = "Null";
      $query ="SELECT user_id from `user_post_comment` WHERE user_id= ".$user_id."  ";
      $result =mysqli_query($connection,$query);

      if ($result) 
      {
        $user= mysqli_fetch_assoc($result);
        $user_id = $_SESSION['user']['user_id'];
      }
      $query = "INSERT INTO `user_post_comment` (`user_id`,`post_id`, `comment` ) VALUES (".$user_id.",'".$post_id."','".$comment."')";
            if ( mysqli_query( $connection, $query ) ) {
              echo "<center><div style='margin-top:10px; color: green;'><strong><h3 style='margin-top: 20px; margin-bottom: 10px;'> You Have Successfully Commented. Admin will Publish it soon.</h3></strong></div></center>";
      if($result)
      {

    $user_query = "SELECT * FROM USER u JOIN post p JOIN `user_post_comment` upc ON  upc.`user_id`=u.`user_id` AND upc.`post_id`=p.`post_id`";
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
$mail->setFrom($users['email']);



//Set an alternative reply-to address
//$mail->addReplyTo('hidayatrust1788@gmail.com', 'Hidaya Trust');
//Set who the message is to be sent to
$mail->addAddress($users['email']);

//Set the subject line
$mail->Subject = "Feedback Alert";
//Read an HTML message body
//$mail->isHTML();
$mail->msgHTML("Dear Admin! "." ".$users['first_name']." ".$users['last_name']." ".".<br>"."having Email :".$users['email']." "."has send comment on ".$users['post_title'].". Comment: [".$users['comment']."]. Kindly visit AmazeBlog for further details.  ");

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
      ?>
  <div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Sorry You Can Not Comment As You Are Not Registered. To Register <a href="registration_form.php" class="text-primary">Click Here</a></h3></strong></div>
      <?php
      }

  } 
    ?>

  </div>
             
</center></div>
  </div>
</div>


<?php 
require_once 'footer.php';
 ?>



<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>
</html>