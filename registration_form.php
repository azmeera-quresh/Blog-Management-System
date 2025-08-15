<?php 
require_once 'header.php';
require_once 'fpdf/fpdf.php';
 ?>
<script>
function validateForm() {
		var fname = document.forms[ "register" ][ "fname" ].value;
		var lname = document.forms[ "register" ][ "lname" ].value;		
		var x = document.forms[ "register" ][ "email" ].value;
		var atpos = x.indexOf( "@" );
		var dotpos = x.lastIndexOf( "." );
		var pass = document.forms[ "register" ][ "pass" ].value;
		var gender = document.forms[ "register" ][ "gender" ].value;
		var dob = document.forms[ "register" ][ "dob" ].value;
		var image = document.forms[ "register" ][ "image" ].value;
		var addrs = document.forms[ "register" ][ "addrs" ].value;
		if ( fname == null || fname == "" ) {
        	 document.getElementById("first_name_msg").innerHTML  = "First Name must be filled out";
			return false;
		}
		if ( lname == null || lname == "" ) {
        	 document.getElementById("last_name_msg").innerHTML  = "Last Name must be filled out";
			// alert( "Last Name must be filled out" );
			return false;
		}
		if ( atpos < 1 || dotpos < atpos + 2 || dotpos + 2 >= x.length ) {
        	 document.getElementById("email_msg").innerHTML  = "Not a valid e-mail address";
			// alert( "Not a valid e-mail address" );
			return false;
		}
		if ( pass == null || pass == "" ) {
        	 document.getElementById("password_msg").innerHTML  = "Password must be filled out";
			// alert( "Password must be filled out" );
			return false;
		}
		if ( gender == null || gender == "" ) {
        	 document.getElementById("gender_msg").innerHTML  = "Gender must be filled out";
			// alert( "Gender must be filled out" );
			return false;
		}
		
		if ( dob == null || dob == "" ) {
        	 document.getElementById("dob_msg").innerHTML  = "Date of birth must be filled out";
			// alert( "Date of birth must be filled out" );
			return false;
		}
		if ( image == null || image == "" ) {
        	 document.getElementById("image_msg").innerHTML  = "Image must be uploaded";
			// alert( "image must be uploaded" );
			return false;
		}
		if ( addrs == null || addrs == "" ) {
        	 document.getElementById("address_msg").innerHTML  = "Address must be filled out";
			// alert( "Address must be filled out" );
			return false;
		}
	}
</script>

<div class="container" style="max-width: 1200px;">
	<div class="row">
		<?PHP
		include( "require/connection.php" );

		if ( isset( $_POST[ 'submit' ] ) ) {
			$fname = $_POST[ 'fname' ];
			$lname = $_POST[ 'lname' ];
			$email = $_POST[ 'email' ];
			$pass = $_POST[ 'pass' ];
			$gender = $_POST[ 'gender' ];
			$dob = $_POST[ 'dob' ];
			$image = $_FILES[ 'image' ];
			$addrs = $_POST[ 'addrs' ];

			//print_r($_FILES[ 'image' ]);
			$dir = "images/profile_images";
    /*if (!is_dir($dir)) 
    {
    	echo "Directory Created";
    	mkdir($dir);
    }
    else
    {
    	echo "error here";
    }*/
 $tmp_name = $dir."/".$image['name'];
 //echo $tmp_name;
 if (move_uploaded_file($tmp_name,$dir."/".$image['name'])) 
    {
    	//echo "Uploaded...!";
    }
    else
    {
    	//echo "Not Uploaded...!";
    }

			$query = "INSERT INTO `user` (`first_name`, `last_name`, `email`, `password`, `gender`, `date_of_birth`, `user_image`, `address`) VALUES ('$fname','$lname','$email','$pass','$gender','$dob','$tmp_name','$addrs')";
			if ( mysqli_query( $connection, $query ) ) {


		
		

	/*$pdf = new fpdf();

          $query = "SELECT * FROM user WHERE email='".$email."' ";
		$result = mysqli_query($connection,$query);
		if ($result->num_rows) {
           $a = 1;
           $pdf->addpage();
           $pdf->setfillcolor(240, 242, 160);
           $pdf->setfont("Arial","B",16);

           $pdf->cell(190,14,"PROFILE CREDENTIALS",1,1,"C",true);
           $pdf->ln(5);
              while($index = mysqli_fetch_assoc($result)) {

			    $pdf->image($index['user_image'],50,40,100,80);
				$pdf->setfont("Arial","B",16);
                $pdf->cell(10,7,$index['first_name'],'',0);
				$pdf->setfont("Arial","B",16);
				$pdf->cell(190,7,$index['last_name'],'',1);
				$pdf->setfont("Arial","B",16);
                $pdf->cell(10,7,$index['email'],'',0);
				$pdf->setfont("Arial","B",16);
				$pdf->cell(190,7,$index['password'],'',1);
				$pdf->setfont("Arial","B",16);
                $pdf->cell(10,7,$index['gender'],'',0);
				$pdf->setfont("Arial","B",16);
				$pdf->cell(190,7,$index['date_of_birth'],'',1);
				$pdf->setfont("Arial","B",16);
				$pdf->cell(190,7,$index['address'],'',0);

               
               
			}

               		



			}

			


      $pdf->output();

*/



				echo "<center>
			<div style='margin-top:10px; color: green;'><strong><h3 style='margin-top: 20px; margin-bottom: 10px;'> Registration Sucessfully Completed. Now You Can Login With Your Email & Password</h3></strong></div></center>";
			} else {
				//error message if SQL query fails
				echo "<br><Strong>Registration Faliure. Try Again</strong><br> Error Details: " . $query . "<br>" . mysqli_error( $connection);
			}

			

			
		}

		?>

	</div>
	<div class="row">
		<div class="col-md-12">
			<form name="register" action="" method="POST" enctype="multipart/form-data" onsubmit="return validateForm()">
				<fieldset>
					<legend>
						<h3 style="padding-top: 25px;"> REGISTER HERE </h3>
					<hr style="width:100%; height:4px; background-color: black" >

					</legend>
					<div class="control-group form-group">
						<div class="controls">
							<label>First Name: <span style="color: #ff0000;">*</span></label>
							<input type="text" class="form-control" name="fname"  id="fname" maxlength="30">
							<p class="help-block"><span style="color: red;" id="first_name_msg"></span></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Last Name: <span style="color: #ff0000;">*</span></label>
							<input type="text" class="form-control" name="lname" id="lname" maxlength="30">
							<p class="help-block"><span style="color: red;" id="last_name_msg"></span></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Email Id: <span style="color: #ff0000;">*</span></label>
							<input type="text" class="form-control" name="email" id="email" maxlength="50">
							<p class="help-block"><span style="color: red;" id="email_msg"></span></p>
						</div>
					</div>


					<div class="control-group form-group">
						<div class="controls">
							<label>Password: <span style="color: #ff0000;">*</span></label>
							<input type="password" class="form-control" name="pass" id="pass" maxlength="30"> 
							<p class="help-block"><span style="color: red;" id="password_msg"></span></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Gender: <span style="color: #ff0000;">*</span></label>
							<p>
								<label>
					<input type="radio" name="gender" value="Male" id="Gender_0" checked>
					Male</label>
							

								<label>
					<input type="radio" name="gender" value="Female" id="Gender_1">
					Female</label>
							
								<br>
							</p>
							<p class="help-block"><span style="color: red;" id="gender_msg"></span></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Date of Birth: <span style="color: #ff0000;">*</span></label>
							<input type="Date" class="form-control" name="dob" id="dob">
							<p class="help-block"><span style="color: red;" id="dob_msg"></span></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Image <span style="color: #ff0000;">*</span></label>
							<input type="file" class="form-control" name="image" id="image" accept="image/*">
							<p class="help-block"><span style="color: red;" id="image_msg"></span></p>
						</div>
					</div>

					<div class="control-group form-group">
						<div class="controls">
							<label>Address: <span style="color: #ff0000;">*</span></label>
							<textarea class="form-control" name="addrs" id="addrs"></textarea>
							<p class="help-block"><span style="color: red;" id="address_msg"></span></p>
						</div>
					</div>



					

					<button type="submit" name="submit" class="btn btn-primary">Register</button>
					<button type="reset" name="reset" class="btn btn-danger">Clear</button>


				</fieldset>
			</form>
		</div>
	</div>
</div>
<?php require_once 'footer.php'; ?>