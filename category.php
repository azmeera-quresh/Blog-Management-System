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

?>
<div class="container mt-5 border border-1">
  <div class="row m-3 g-0"> 
  <div class="col-lg-12 col-md-12 col-sm-12 ">

            <h3 style="padding-top: 25px;"> CATEGORY  </h3>
    <hr class="mb-4" style="width:100%; height:4px; background-color: black" >
  
 <?php
    $query = " SELECT * FROM blog b JOIN post p JOIN category c JOIN `post_category` pc ON p.post_id = pc.`post_id` AND b.blog_id = p.`blog_id` AND c.category_id = pc.`category_id` WHERE p.`post_status`= 'Active' AND c.`category_id`=".$_REQUEST['category_id']." ORDER BY p.`post_id` ASC";
    $result = mysqli_query($connection,$query);
    if ($result) 
    {
      while ($res = mysqli_fetch_assoc($result)) 
      { ?>
          <div class="card mb-3 shadow" >
    <div class="row g-0 ">
    <div class="col-md-4 ">
      <img src="images/<?php echo $res['featured_image'] ?>" class="img-fluid rounded-start" alt="..." width="100%" height="100%">
    </div>
    <div class="col-md-8">
      <div class="card-body " >
        <a href="display-post.php?&post_id=<?php echo $res['post_id']?>" style="text-decoration:none;"><h5 class="card-title text-dark"><?php echo $res['post_title'] ?></h5></a>
        <a href="display-post.php?&post_id=<?php echo $res['blog_id']?>" style="text-decoration:none;"><h6 class="card-title text-primary ">Category Title: <?php echo $res['category_title'] ?></h6></a>
        <p class="card-text "><?php echo $res['post_summary'] ?></p>
        <p class="card-text"><small class="text-muted">Last updated at: <?php echo $res['created_at'] ?></small></p>
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
</div>  

<?php 
require_once 'footer.php';
 ?>



<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>
</html>