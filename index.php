<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>blog management system</title>
  <style type="text/css">
     
  </style>
</head>
<body>
<?php 
require_once("header.php");
require_once("require/connection.php");
?>

<div class="container mt-5 border border-1">
  <div class="row m-3 g-0">  
    <?php
    $query = "SELECT * FROM blog b JOIN post p JOIN category c JOIN `post_category` pc ON p.post_id = pc.`post_id` AND b.blog_id = p.`blog_id` AND c.category_id = pc.`category_id` WHERE p.`post_id`=8" ;
    $result = mysqli_query($connection,$query);
    if ($result) 
    {
      while ($res = mysqli_fetch_assoc($result)) 
      { ?>    
        <div class="col-lg-4 col-md-4 col-sm-12 ">
     <div class="card mb-5 shadow-lg">
  <img src="images/<?php echo $res['blog_background_image'] ?>" class="card-img-top" alt="..." width="100px" height="350px" >
  <a href="blog.php?&blog_id=<?php echo $res['blog_id']?>"><button style="width: 100%;" class="btn btn-outline-primary" type="submit"><?php echo $res['blog_title'] ?></button></a>
  <div class="card-body">
    <h5 class="card-title"><?php echo $res['post_title'] ?></h5>
    <h6 class="card-title text-primary">Category: <?php echo $res['category_title'] ?></h6>
    <p class="card-text"><?php echo $res['post_summary']  ?></p>
    <p class="card-text"><small class="text-muted">Last updated at <?php echo $res['created_at'] ?></small></p>
  </div>
  </div>
    </div>

      <?php
      }
    } 
    ?>
        <?php
    $query = "SELECT * FROM blog b JOIN post p JOIN category c JOIN `post_category` pc ON p.post_id = pc.`post_id` AND b.blog_id = p.`blog_id` AND c.category_id = pc.`category_id` WHERE p.`post_id`=1" ;
    $result = mysqli_query($connection,$query);
    if ($result) 
    {
      while ($res = mysqli_fetch_assoc($result)) 
      { ?>    
        <div class="col-lg-4 col-md-4 col-sm-12 ">
     <div class="card mb-5 shadow-lg">
  <img src="images/<?php echo $res['blog_background_image'] ?>" class="card-img-top" alt="..." width="100px" height="350px" >
  <a href="blog.php?&blog_id=<?php echo $res['blog_id']?>"><button style="width: 100%;" class="btn btn-outline-primary" type="submit"><?php echo $res['blog_title'] ?></button></a>
  <div class="card-body">
    <h5 class="card-title"><?php echo $res['post_title'] ?></h5>
    <h6 class="card-title text-primary">Category: <?php echo $res['category_title'] ?></h6>
    <p class="card-text"><?php echo $res['post_summary']  ?></p>
    <p class="card-text"><small class="text-muted">Last updated at <?php echo $res['created_at'] ?></small></p>
  </div>
  </div>
    </div>

      <?php
      }
    } 
    ?>
    <?php
    $query = "SELECT * FROM blog b JOIN post p JOIN category c JOIN `post_category` pc ON p.post_id = pc.`post_id` AND b.blog_id = p.`blog_id` AND c.category_id = pc.`category_id` WHERE p.`post_id`=3" ;
    $result = mysqli_query($connection,$query);
    if ($result) 
    {
      while ($res = mysqli_fetch_assoc($result)) 
      { ?>    
        <div class="col-lg-4 col-md-4 col-sm-12 ">
     <div class="card mb-5 shadow-lg">
  <img src="images/<?php echo $res['blog_background_image'] ?>" class="card-img-top" alt="..." width="100px" height="350px" >
  <a href="blog.php?&blog_id=<?php echo $res['blog_id']?>"><button style="width: 100%;" class="btn btn-outline-primary" type="submit"><?php echo $res['blog_title'] ?></button></a>
  <div class="card-body">
    <h5 class="card-title"><?php echo $res['post_title'] ?></h5>
    <h6 class="card-title text-primary">Category: <?php echo $res['category_title'] ?></h6>
    <p class="card-text"><?php echo $res['post_summary']  ?></p>
    <p class="card-text"><small class="text-muted">Last updated at <?php echo $res['created_at'] ?></small></p>
  </div>
  </div>
    </div>

      <?php
      }
    } 
    ?>
  </div>
</div>

<!--     <div class="col-lg-4 col-md-4 col-sm-12 ">
        <div class="card mb-5 shadow-lg">
  <img src="images/automobile-1.jpg" class="card-img-top" alt="..." width="100px" height="380px">
    <button class="btn btn-outline-primary" type="submit">Auto Mobiles</button>

  <div class="card-body">
    <h5 class="card-title">Important Thing About Car</h5>
    <p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
  </div>
    </div>
    <div class="col-lg-4 col-md-4 col-sm-12 ">
        <div class="card mb-5 shadow-lg">
  <img src="images/technology-1.jpg" class="card-img-top" alt="..."  width="100px" height="130px">
    <button class="btn btn-outline-primary" type="submit">Technology</button>

  <div class="card-body">
    <h5 class="card-title">Technology Advancement</h5>
    <p class="card-text">This content is a little bit smaller</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
  <img src="images/sports-2.jpg" class="card-img-top" alt="..."  width="100px" height="130px">
    <button class="btn btn-outline-primary" type="submit">Sports</button>

  <div class="card-body">
    <h5 class="card-title">Girls In Sports</h5>
    <p class="card-text">This content is a little bit smaller</p>
    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
  </div>
  </div>
    </div>
  </div> -->

<div class="container mb-5 mt-5">
<div class="row ">
  <div class="col-lg-8 col-md-8 col-sm-12" >


<?php 
      if(isset($_REQUEST['submit'])){
  
  $query = "SELECT * FROM post JOIN USER JOIN blog ON blog.`user_id`= user.`user_id` AND blog.`blog_id`= post.`blog_id` WHERE post.`created_at` LIKE '%".$_REQUEST['search_post']."%' OR user.`first_name` LIKE '%".$_REQUEST['search_post']."%' OR post.`post_title` LIKE '%".$_REQUEST['search_post']."%' OR blog.`blog_title` LIKE '%".$_REQUEST['search_post']."%'";

$result = mysqli_query($connection,$query);

if ($result) { ?>
      <h6 ><span class="mt-5" style="background-color: black; color: white; padding: 10px">SEARCH RESULTS</span></h6>
    <hr style="width:100%; height:4px; background-color: black" >
    <?php
  while ($res=mysqli_fetch_assoc($result)) {
?>

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

<?php
  }     
}
else 
  { 
        ?> <div style="color: red">No Any Records Found</div><?php 
  }

}
else 
  { 
        ?> <?php 
  }
 ?>






    <br>
    <h6 ><span class="mt-5" style="background-color: black; color: white; padding: 10px">POPULAR POSTS</span></h6>
    <hr style="width:100%; height:4px; background-color: black" >
  
 <?php
    $query = "SELECT * FROM blog b JOIN post p JOIN category c JOIN `post_category` pc ON p.post_id = pc.`post_id` AND b.blog_id = p.`blog_id` AND c.category_id = pc.`category_id` WHERE p.`post_status`= 'Active' ORDER BY p.`post_id` ASC" ;
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
        <a href="display-post.php?&post_id=<?php echo $res['blog_id']?>" style="text-decoration:none;"><h6 class="card-title text-primary">Blog Title: <?php echo $res['blog_title'] ?></h6></a>
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
  

<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item disabled">
      <span class="page-link">Previous</span>
    </li>
    <li class="page-item active"><a class="page-link" href="#">1</a></li>
    <li class="page-item" aria-current="page">
      <span class="page-link">2</span>
    </li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#">Next</a>
    </li>
  </ul>
</nav>

  </div>

  <!-- right sidebar -->
  <div class="col-lg-4 col-md-4 col-sm-12" >

  <br>      
    <h6 ><span style="background-color: black; color: white; padding: 10px">SEARCH BAR</span></h6>
    <hr style="width:100%; height:4px; background-color: black" >
  
  <form class="d-flex">
  <input class="form-control me-2" id="search_post" name="search_post" type="search" placeholder="Search" aria-label="Search">
        <input type="submit" name="submit" class="btn btn-outline-light bg-primary" value="search">
        </form>


    <br><br><h6 ><span style="background-color: black; color: white; padding: 10px">RECENT POSTS</span></h6>
    <hr style="width:100%; height:4px; background-color: black" >
  <?php
    $query = "SELECT * FROM blog b JOIN post p JOIN category c JOIN `post_category` pc ON p.post_id = pc.`post_id` AND b.blog_id = p.`blog_id` AND c.category_id = pc.`category_id` WHERE p.`post_status`= 'Active' ORDER BY p.`post_id` DESC  LIMIT 5" ;
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
        <a href="display-post.php?&post_id=<?php echo $res['blog_id']?>" style="text-decoration:none;"><h6 class="card-title text-primary">Blog Title: <?php echo $res['blog_title'] ?></h6></a>
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


<br><h6 ><span style="background-color: black; color: white; padding: 10px">CATEGORIES</span></h6>
    <hr style="width:100%; height:4px; background-color: black" >

<div class="card mb-3 shadow" style="max-width: 520px; ">
  <div class="row g-0">
    <div class="col-md-8">
      <ul class='category'>
                <div class="card-body ">
    <?php 
            $query = "SELECT * FROM category WHERE category_status='Active'";
            $result= mysqli_query($connection,$query);
            if ($result) {
              while ($res=mysqli_fetch_assoc($result)) { ?>
                <li><a class="dropdown-item" href="category.php?category_id=<?php echo $res['category_id']?>"><p  class="card-title " onMouseOver="this.style.color='blue'" onMouseOut="this.style.color='#000'" ><b><?php echo $res['category_title'] ?></b></p>
      </a></li>

                <?php
               $_SESSION['category_title']= $res['category_title'];
              }
            }
            ?>
                </div>
    
  </ul>
    </div>
  </div>
</div>
<div id='category'>

</div>


<br><h6 ><span style="background-color: black; color: white; padding: 10px">POPULAR TAGS</span></h6>
    <hr style="width:100%; height:4px; background-color: black" >

       <button class="btn btn-outline-light bg-primary mb-3" type="submit">BIKE</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">BUILDING</button>
    <button class="btn btn-outline-light bg-primary mb-3" type="submit">CAMERA</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">CRAFT</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">FASHION</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">GEAR</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">GIRL</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">JUMPING</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">LAKE</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">LIFESTYLE</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">MASTER</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">MOCKUP</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">MOTIVATION</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">MOUNTAINS</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">MOVIE</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">NOTEBOOK</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">OFFICE</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">STORMTOOPER</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">SWIMMER</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">TROOPER</button>
       <button class="btn btn-outline-light bg-primary mb-3" type="submit">CAR</button>



</div>

</div>
</div>






</div>






<?php 
require_once 'footer.php';
 ?>



<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
</body>
</html>