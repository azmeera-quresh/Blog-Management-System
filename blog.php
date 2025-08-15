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

$blog_id = $_REQUEST['blog_id'];
    // echo $blog_id;
    // echo $user_id;

$query= " SELECT * FROM blog WHERE blog_id=".$_REQUEST['blog_id'] ." ";
 $result = mysqli_query($connection,$query);
    if ($result) 
    {
      while ($res = mysqli_fetch_assoc($result)) 
      {
        $post_per_page= $res['post_per_page'];
        ?>
        <div class="container-fluid">
          <div class="row g-0 ">
            <img src="images/<?php echo $res['blog_background_image'] ?>" height=600px; class="card-img-top" alt="...">   
          </div>
        </div>
        <div class="container mt-5 border border-1">
              <div class="row m-3 g-0">
                <div class="col-md-12 col-sm-12 col-lg-12">
                  <div class="float-start"><h2 class="card-text mt-3 mb-3 " ><b><?php echo $res['blog_title']  ?></b></h2></div>
                  <div class="float-end"> <form method="POST"> 
                    <input type="submit" name="submit" value="Follow" class="btn btn-primary ">
                  </form></div>
                  
                  <hr style="width:100%; height:4px; background-color: black" >
                </div>
              </div>
            </div>
        <?php
      }
    }

              
  if ( isset( $_POST[ 'submit' ] ) ) 
      {
      
      $user_id = "Null";
      $query ="SELECT * FROM `user_blog_following` WHERE follower_id= ".$user_id."  ";
      $result =mysqli_query($connection,$query);

      if ($result) 
      {
        $user= mysqli_fetch_assoc($result);
        $user_id = $_SESSION['user']['user_id'];
        $status = "Followed";
      }
      $query = "INSERT INTO `user_blog_following` (`follower_id`,`blog_following_id`, `status` ) VALUES (".$user_id.",".$blog_id.",'".$status."')";
            if ( mysqli_query( $connection, $query ) ) {

              echo "<center><div style='margin-top:10px; color: green;'><strong><h3 style='margin-top: 20px; margin-bottom: 10px;'> You Have Successfully Followed. You Will Be Notified When Admin Will Add New Post in Blog.</h3></strong></div></center>";

    } else {
        //error message if SQL query fails*/
      ?>
  <center><div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Sorry You Can Not Folow As You Are Not Registered. To Register <a href="registration_form.php" class="text-primary">Click Here</a></h3></strong></div></center>
      <?php
      }
         
    
  }
  



 
  

?>
<div class="container mt-5 border border-1">
  <div class="row m-3 g-0">  

    <?php
    
    
    $query = "SELECT * FROM blog,post,user, category,`post_category` WHERE post.post_id = `post_category`.`post_id` AND blog.blog_id = post.`blog_id` AND category.category_id = `post_category`.`category_id`  AND user.`user_id`= blog.`user_id` AND blog.blog_id=".$_REQUEST['blog_id'] ." ";
    $result = mysqli_query($connection,$query);
    if ($result) 
    {
      while ($res = mysqli_fetch_assoc($result)) 
      { ?>
          <div class="col-md-12 col-lg-12 col-sm-12 col-xs-12 ">
              <div class="card mb-3 shadow" >
    <div class="row g-0 ">
    <div class="col-md-4 ">
      <img src="images/<?php echo $res['featured_image'] ?>" class="img-fluid rounded-start" alt="..." width="100%" height="100%">

    </div>
    <div class="col-md-8">
      <div class="card-body " >
        <a href="display-post.php?&post_id=<?php echo $res['post_id']?>" style="text-decoration:none;"><h5 class="card-title text-dark"><?php echo $res['post_title'] ?></h5></a>
        <a href="display-post.php?&post_id=<?php echo $res['blog_id']?>" style="text-decoration:none;"><h6 class="card-title text-primary">Blog Title: <?php echo $res['blog_title'] ?></h6></a>
        <p class="card-text "><?php echo $res['post_summary'] ?></p>
        <p class="card-text"><small class="text-muted">Last updated at: <?php echo $res['created_at'] ?></small></p>
      </div>
    </div>
  </div>
</div>
</div>
<?php 
      }
    }
    ?>
</div>
</div>




<?php 
require_once 'footer.php';
 ?>



<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>
</html>