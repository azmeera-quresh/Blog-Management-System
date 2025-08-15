<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>HIST - HIDAYA</title>
	<link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css">
</head>
<body>
<?php require_once("header.php") ?>



<div class="container mt-5 mb-5 border border-1  p-5">
  <h3 >LOGIN HERE</h3>
  <hr>
  <div class="row m-3  g-0">
    <div class="col-lg-1"></div>
    <div class="col-lg-5 col-xs-12 col-md-5 col-sm-12 p-3 " >
        <form action="login-process.php" method="POST">
          <label for="staticEmail" class="col-sm-2 col-form-label" style="margin-top: 50px;">Email:</label>
            <input type="text" name="email" class="form-control" id="staticEmail" placeholder="email@example.com">
          <label for="inputPassword" class="col-sm-2 col-form-label">Password:</label>
            <input type="password" name="password" class="form-control" id="inputPassword" style="margin-bottom: 20px;" placeholder="********">
        <div class="float-start">
          <input type="submit" name="login" value="Login" class="btn btn-primary">
        </div>
      </form>
          <div class="float-left">
          <a href="registration_form.php"><input type="submit" name="register" value="Register" class="btn btn-warning" ></a></div>
          <br><br><a href="forgot-password.php">Forgotten Password?</a>
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