<head>
        <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>blog management</title>
   <script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="admincss.css">
</head>
<body>

<?php 
session_start();
require_once 'admin-sidebar.php';
require_once("admin-header.php");
?>

<div class="container-fluid">
<div class="row">
<div class="col-md-2 g-0">
	<?php //require_once 'admin-sidebar.php'; ?>
</div>
  <div class="col-md-10 mt-5 "> 
  	
  			<?php  require_once 'admin-index-data.php'; ?>

</div>

 
 <?php 
require_once 'admin-footer.php';
 ?>
 </div>
</div>


</body>
