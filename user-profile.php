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

    <div class="col-md-12 col-sm-12">
    <?php
    // print_r($_SESSION['user']);
    $query= "SELECT * FROM USER WHERE user_id=".$_SESSION['user']['user_id']." ";
    $result= mysqli_query($connection,$query);
    if ($result) {
      while ($user=mysqli_fetch_assoc($result)) {
    
  ?>
        
      <center>
        <img src="<?php echo $user['user_image']; ?>" width="180px" height="180px" class="rounded-circle" alt="user-profile">
        <div class="card-body mt-3">
    <h5 class="card-title"><?php echo $user['first_name']." ".$user['last_name']; ?></h5>
    <p>Status : Active <i class="fa fa-circle" style="color:green"></i></p>
  </div>
  <ul class="list-group list-group-flush">
    <li class="list-group-item">First Name: <?php echo $user['first_name'] ?></li>
    <li class="list-group-item">Last Name: <?php echo $user['last_name']; ?></li>
    <li class="list-group-item">User Id: <?php echo $user['user_id']; ?></li>
    <li class="list-group-item">Email: <?php echo $user['email']; ?></li>
    <li class="list-group-item">Password: <?php echo $user['password']; ?></li>
    <li class="list-group-item">Date Of Birth: <?php echo $user['date_of_birth'] ?></li>
    <li class="list-group-item">Address: <?php echo $user['address']; ?></li>
  </ul>
  <div class="card-body">
    <a href="edit-user.php?user_id=<?php echo $user['user_id'] ?>" class="card-link"><button class="actions btn btn-primary" title="Edit"  ><i class='fas fa-edit' ></i> Edit Profile</button></a>
  </div>
</div>
      </center>
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