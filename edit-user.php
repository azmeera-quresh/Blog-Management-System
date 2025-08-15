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
    $query= "SELECT * FROM USER WHERE user_id=".$_REQUEST['user_id']." ";
    $result= mysqli_query($connection,$query);
    if ($result) {
      while ($user=mysqli_fetch_assoc($result)) {
    
  ?>
        
      <center>
      <table cellpadding="10">
					<tr >
					<h3 style="padding-top: 25px;"> EDIT PROFILE </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr>
					<tr>
						<td><b>First Name: </b></td>
						<td><input type="text" id="first_name" name="first_name" value="<?= $user['first_name']?>"></td>
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
						<td><input type="text" name="password" value="<?= $user['password']?>"></td>
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
    <a href="update-user.php?user_id=<?php echo $user['user_id'] ?>&first_name=<?php echo $user['first_name'] ?>&last_name=<?php echo $user['last_name'] ?>&email=<?php echo $user['email'] ?>&password=<?php echo $user['password'] ?>&date_of_birth=<?php echo $user['date_of_birth'] ?>&user_image=<?php echo $user['user_image'] ?>&gender=<?php echo $user['gender'] ?>&address=<?php echo $user['address'] ?>" class="card-link"><button class="actions btn btn-primary" title="Edit"  ><i class='fas fa-edit' ></i> Edit Profile</button></a>
							<a href="user-profile.php"><button  onclick="cancel()" class="btn btn-danger">Cancel</button></a>
						</td>
					</tr>
				</table>
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