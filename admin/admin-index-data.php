<?php require_once '../require/connection.php'; ?>
<div class="container">
      <div class="row">
<h3  class="p-1 ">HELLO ADMIN!</h3>
	<hr style="width:100%; height:4px; background-color: black" >

  	<div class="col-md-3 col-lg-3 col-sm-12">
  		<div class="card text-white bg-primary mb-3" style="max-width: 18rem;">
<div class="card-body">
    <?php
    $query= "SELECT * FROM blog";
    $result = mysqli_query($connection,$query);
    if ($result->num_rows) {
       $blog= $result->num_rows ;
    ?>
    <p class="card-text"><span><i class="fas fa-blog" style='font-size:50px'></i></span><span class="pull-right" style="font-size: 60px"><?php echo $blog;  ?></span></p>
    <h5 class="card-title">Blogs</h5>
    <?php } ?>
  </div>
  <div class="card-header bg-light text-primary"><a href="blogs/blog-ajax.php">View</a><span class="pull-right"><a href="blogs/blog-ajax.php"><i class='fas fa-arrow-circle-right'></i></a></span></div>
</div>
<div class="card text-white bg-secondary mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <?php
    $query= "SELECT * FROM category";
    $result = mysqli_query($connection,$query);
    if ($result->num_rows) {
       $category= $result->num_rows ;
    ?>
    <p class="card-text"><span><i class="fas fa-blog" style='font-size:50px'></i></span><span class="pull-right" style="font-size: 60px"><?php echo $category;  ?></span></p>
    <h5 class="card-title">Category</h5>
    <?php } ?>
  </div>
  <div class="card-header bg-light text-primary"><a href="categories/category-ajax.php">View</a><span class="pull-right"><a href="categories/category-ajax.php"><i class='fas fa-arrow-circle-right'></i></a></span></div>
</div>
</div>
	
<div class="col-md-3 col-lg-3 col-sm-12">
<div class="card text-white bg-success mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <?php
    $query= "SELECT * FROM post";
    $result = mysqli_query($connection,$query);
    if ($result->num_rows) {
       $post= $result->num_rows ;
    ?>
    <p class="card-text"><span><i class="fas fa-blog" style='font-size:50px'></i></span><span class="pull-right" style="font-size: 60px"><?php echo $post;  ?></span></p>
    <h5 class="card-title">Posts</h5>
    <?php } ?>
  </div>
  <div class="card-header bg-light text-primary"><a href="posts/post-ajax.php">View</a><span class="pull-right"><a href="posts/post-ajax.php"><i class='fas fa-arrow-circle-right'></i></a></span></div>
</div>
<div class="card text-white bg-danger mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <?php
    $query= "SELECT * FROM user";
    $result = mysqli_query($connection,$query);
    if ($result->num_rows) {
       $user= $result->num_rows ;
    ?>
    <p class="card-text"><span><i class="fas fa-blog" style='font-size:50px'></i></span><span class="pull-right" style="font-size: 60px"><?php echo $user;  ?></span></p>
    <h5 class="card-title">Users</h5>
    <?php } ?>
  </div>
  <div class="card-header bg-light text-primary"><a href="users/user-ajax.php">View</a><span class="pull-right"><a href="users/user-ajax.php"><i class='fas fa-arrow-circle-right'></i></a></span></div>
</div>
</div>

  	<div class="col-md-3 col-lg-3 col-sm-12">
<div class="card text-dark bg-warning mb-3" style="max-width: 18rem;">
<div class="card-body">
    <?php
    $query= "SELECT * FROM user_post_comment";
    $result = mysqli_query($connection,$query);
    if ($result->num_rows) {
       $comment= $result->num_rows ;
    ?>
    <p class="card-text"><span><i class="fas fa-blog" style='font-size:50px'></i></span><span class="pull-right" style="font-size: 60px"><?php echo $comment;  ?></span></p>
    <h5 class="card-title">Comments</h5>
    <?php } ?>
  </div>
  <div class="card-header bg-light text-primary"><a href="comments/comment-ajax.php">View</a><span class="pull-right"><a href="comments/comment-ajax.php"><i class='fas fa-arrow-circle-right'></i></a></span></div>
</div>
<div class="card text-dark bg-info mb-3" style="max-width: 18rem;">
<div class="card-body">
    <?php
    $query= "SELECT * FROM setting";
    $result = mysqli_query($connection,$query);
    if ($result->num_rows) {
       $setting= $result->num_rows ;
    ?>
    <p class="card-text"><span><i class="fas fa-blog" style='font-size:50px'></i></span><span class="pull-right" style="font-size: 60px"><?php echo $setting;  ?></span></p>
    <h5 class="card-title">Settings</h5>
    <?php } ?>
  </div>
  <div class="card-header bg-light text-primary"><a href="settings/setting-ajax.php">View</a><span class="pull-right"><a href="settings/setting-ajax.php"><i class='fas fa-arrow-circle-right'></i></a></span></div>
</div>
</div>

  	<div class="col-md-3 col-lg-3 col-sm-12">
<div class="card text-dark mb-3" style="max-width: 18rem; background-color: pink">
  <div class="card-body">
    <?php
    $query= "SELECT * FROM user_feedback";
    $result = mysqli_query($connection,$query);
    if ($result->num_rows) {
       $feedback= $result->num_rows ;
    ?>
    <p class="card-text"><span><i class="fas fa-blog" style='font-size:50px'></i></span><span class="pull-right" style="font-size: 60px"><?php echo $feedback;  ?></span></p>
    <h5 class="card-title">Feedbacks</h5>
    <?php } ?>
  </div>
  <div class="card-header bg-light text-primary"><a href="feedbacks/feedback-ajax.php">View</a><span class="pull-right"><a href="feedbacks/feedback-ajax.php"><i class='fas fa-arrow-circle-right'></i></a></span></div>
</div>
<div class="card text-white bg-dark mb-3" style="max-width: 18rem;">
  <div class="card-body">
    <?php
    $query= "SELECT * FROM blog";
    $result = mysqli_query($connection,$query);
    if ($result->num_rows) {
       $blog= $result->num_rows ;
    ?>
    <p class="card-text"><span><i class="fas fa-blog" style='font-size:50px'></i></span><span class="pull-right" style="font-size: 60px"><?php echo $blog;  ?></span></p>
    <h5 class="card-title">Blogs</h5>
    <?php } ?>
  </div>
  <div class="card-header bg-light text-primary"><a href="blogs/blog-ajax.php">View</a><span class="pull-right"><a href="blogs/blog-ajax.php"><i class='fas fa-arrow-circle-right'></i></a></span></div>
</div>
</div>

</div>
  </div>