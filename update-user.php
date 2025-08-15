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

// print_r($_REQUEST);

?>

<div class="container mt-5 border border-1">
  <div class="row m-3 g-0">  

    <div class="col-md-12 col-sm-12">
    <?php
    $query = "UPDATE user SET first_name = '".$_REQUEST['first_name']."', last_name = '".$_REQUEST['last_name']."', email = '".$_REQUEST['email']."', password ='".$_REQUEST['password']."', gender = '".$_REQUEST['gender']."', date_of_birth = '".$_REQUEST['date_of_birth']."', user_image = '".$_REQUEST['user_image']."', address = '".$_REQUEST['address']."' WHERE user_id = ".$_REQUEST['user_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div id="msg" style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Profile Updated Successfully <a style="color: green;" href="user-profile.php">Click Here To View Changes!</a></h3></strong></div> 

			<?php
			}
			else{
				?>
				<div id="msg" style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Profile Not Updated Try Again Later <a style="color: red;" href="user-profile.php">Click Here To View Changes!</a></h3></strong></div>
				<?php

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