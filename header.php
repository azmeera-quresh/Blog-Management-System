<?php session_start(); 


?>
<!DOCTYPE html>
<html>
<head>
  <title>header</title>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">

</head>
<body>
<?php require_once 'require/connection.php';  ?>
<nav class="navbar navbar-expand-sm navbar navbar-dark bg-dark " style="height: 50px">
  <div class="container-fluid p-3">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse p-3" id="navbarText">
      <?php
      if (isset($_SESSION['user']['user_id']))
      { ?>
      

      <?php
      

      if (isset($_SESSION['user']['user_id']))
      { ?>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-10">
              <a href="user-profile.php" style="text-decoration: none;" class="text-light active " aria-current="page"><img src="<?php echo $_SESSION['user']['user_image']; ?>" width="30px" height="30px" class="rounded-circle" >&nbsp; <b><?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?></b> &nbsp; <i class="fa fa-circle" style="color:green"></i></a>
            </div>
            <div class="col-md-2">
              <a href="about-us.php" style="text-decoration: none;" class="text-secondary float-start"><b>ABOUT US</b></a>
              <a href="contact-us.php" style="text-decoration: none;" class="text-secondary float-end"><b>CONTACT US</b></a>
            </div>

          </div>
        </div>
        
      <?php
      }
    }
      else
      {
        ?>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-10">
              <a href="#" class="active text-light" style="text-decoration: none;">Advertise</a>
            </div>
            <div class="col-md-2">
              <a href="about-us.php" style="text-decoration: none;" class="text-light float-start">About Us</a>
              <a href="contact-us.php" style="text-decoration: none;" class="text-light float-end">Contact Us</a>
            </div>

          </div>
        </div>
        
 
      <?php
      }
    
      ?>
     

    </div>
  </div>
</nav>



<nav class="navbar navbar-expand-lg navbar navbar-dark " style="background-color: #0080ff;">
  <div class="container-fluid p-4">
    <a class="navbar-brand" href="index.php" style="font-size: 40px">AmaZeBlog</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarScroll" aria-controls="navbarScroll" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarScroll">
      <ul class="navbar-nav me-auto my-2 my-lg-0 navbar-nav-scroll" style="--bs-scroll-height: 100px;">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">HOME</a>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            TOP POSTS
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                      
              <?php 
               $query="SELECT * from post where post_status='Active'";
               $result = mysqli_query($connection,$query);
                if($result)
                {
                  while ($res = mysqli_fetch_assoc($result)) 
                  {
                    ?>
                      <li><a class="dropdown-item" href="display-post.php?&post_id=<?php echo $res['post_id']?>"><?php echo $res['post_title'] ?></a></li>
                    <?php
                  }

                }

              ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
           TOP BLOGS
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
                        
              <?php 
               $query="SELECT * from blog where blog_status='Active'";
               $result = mysqli_query($connection,$query);
                if($result)
                {
                  while ($res = mysqli_fetch_assoc($result)) 
                  {
                    ?>
                      <li><a class="dropdown-item" href="blog.php?&blog_id=<?php echo $res['blog_id']?>"><?php echo $res['blog_title'] ?></a></li>
                    <?php
                  }

                }

              ?>
          </ul>
        </li>
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" id="navbarScrollingDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            TOP CATEGORIES
          </a>
          <ul class="dropdown-menu" aria-labelledby="navbarScrollingDropdown">
            <?php 
            $query = "SELECT * FROM category WHERE category_status='Active'";
            $result= mysqli_query($connection,$query);
            if ($result) {
              while ($res=mysqli_fetch_assoc($result)) { ?>
                <li><a class="dropdown-item" href="category.php?category_id=<?php echo $res['category_id']?>"><?php echo $res['category_title'] ?></a></li>
                <?php
              }
            }
            ?>
            
          </ul>
        </li>
  
      </ul>

<?php if (isset($_SESSION['user']['user_id'])) {
  ?>
    <span class="navbar-text">

        <a href="logout.php" style="text-decoration:none;">
        <button class="btn btn-outline-light bg-primary" type="submit" name="logout">Logout</button>
        </a>
   <?php
}
else
{
  ?>
<span class="navbar-text">
  
        <a href="login.php" style="text-decoration:none;">
        <input class="btn btn-outline-light bg-primary" type="submit" name="login" value="Login">
        </a>
        
         |

        <a href="registration_form.php" style="text-decoration:none;"> 
        <button class="btn btn-outline-light bg-primary" type="submit" >Register</button>
        </a>

      </span>
<?php
}
?>


    </div>
  </div>
</nav>

<nav class="navbar navbar-expand-sm navbar navbar-dark bg-dark " style="height: 30px">
  <div class="container-fluid p-3">
    <a class="navbar-brand" href="#"></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarText" aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse p-3" id="navbarText">
      <?php
      if (isset($_SESSION['user']['user_id']))
      { ?>
      

      <?php
      

      if (isset($_SESSION['user']['user_id']))
      { ?>
        
        <span class="navbar-text" ><i class="fa fa-bullhorn"></i> &nbsp;
      You Are Logined As <b><?php echo $_SESSION['user']['first_name']." ".$_SESSION['user']['last_name']; ?></b>...! 
      </span> 
      <?php
      }
    }
      else
      {
        ?>
        
        <span class="navbar-text" ><i class="fa fa-bullhorn"></i> &nbsp;
      Kindly Register Your Account First...! </i></b>
      </span> 
      <?php
      }
    
      ?>
     
        
    </div>
  </div>
</nav>



<script type="text/javascript" src="bootstrap/js/bootstrap.bundle.min.js"></script>

</body>
</html>