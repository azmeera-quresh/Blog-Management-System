<?php 
session_start();
// print_r($_REQUEST);
	require_once("../../require/connection.php");
	date_default_timezone_set("Asia/karachi");
	$update_time = date("Y-m-d h:m:s", time());

	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "add_blog"){
		echo "working";

		$query = "INSERT INTO blog (user_id, blog_title, post_per_page, blog_background_image, blog_status) VALUES ('".$_REQUEST['user_id']."','".$_REQUEST['blog_title']."','".$_REQUEST['post_per_page']."','".$_REQUEST['blog_background_image']."','".$_REQUEST['blog_status']."')";

		
		$result = mysqli_query($connection,$query);
		if($result){
			$blog_id = mysqli_insert_id($connection);
			?>
			<div style="color: green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>blog (<?= $blog_id ?>) Inserted Successfully</h3></strong></div>

			<?php
		}
		else{
			?>
			<div style="color: red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>">blog Not Inserted Try Again Later</h3></strong></div>
			<?php
		}
	}
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_blogs"){

		if(isset($_REQUEST['search_input'])){
			$query = "SELECT * FROM blog WHERE blog_title LIKE '%".$_REQUEST['search_input']."%' OR blog_status LIKE '%".$_REQUEST['search_input']."%' OR blog_id LIKE '%".$_REQUEST['search_input']."%'";
		}
		else{
			$query = "SELECT * FROM blog ORDER BY blog_id DESC";
		}
		$blogs = mysqli_query($connection,$query);
		if($blogs->num_rows){
			$_SESSION['blog']=$blogs->num_rows;
			?>
			<br>
			<table>
				<tr>
					<td><h3>Search: &nbsp </h3></td>
					<td><input type="text" placeholder="Search Here" id="search_blog" class="p-1"></td>
					<td><button onclick="search_blog()" class="btn btn-success " >Search</button></td>
				</tr>
			</table>
			<br>
			                  

			<table  border="1" cellpadding="12" cellspacing="2" width="30%" >
				<tr style="background-color: #0080ff; color: white;"  >
					<td><b>#</b></td>
					<td><b>blog_background_image</b></td>
					<td><b>user_id</b></td>
					<td><b>blog_title</b></td>
					<td><b>post_per_page</b></td>
					<td><b>blog_status</b></td>
					<td><b>created_at</b></td>
					<td><b>updated_at</b></td>
					<td><b>Actions</b></td>
				</tr>
				<?php 
				$i = 1;
				// print_r($blog['blog_image']);
				while($blog = mysqli_fetch_array($blogs)){
					?>
					<tr>

						<td><?php echo $i; ?></td>
						<td><img src="blog-images/<?= $blog['blog_background_image'] ?>" width="50px" height="50px" ></td>
						<td><?= $blog['user_id'] ?></td>
						<td><?= $blog['blog_title'] ?></td>
						<td><?= $blog['post_per_page'] ?></td>
						<td><?= $blog['blog_status'] ?>
							<button class="actions btn btn-success"  onclick="active(<?php echo $blog['blog_id']?>)" title="Active" id = "active" ><i class='fas fa-eye'></i></i></button>
							<button class="actions btn btn-danger"  onclick="inactive(<?php echo $blog['blog_id']?>)" title="Inactive" ><i class='fas fa-eye-slash'></i></button>
						</td>
						<td><?= $blog['created_at'] ?>
						<td><?= $blog['updated_at'] ?>
							
						</td>
						<td>

							<button class="actions btn btn-success"  onclick="edit_blog(<?= $blog['blog_id']?>)" title="Edit"  ><i class='fas fa-edit' ></i></button>
							<button class="actions btn btn-danger"  onclick="delete_blog(<?php echo $blog['blog_id']?>)" title="Delete" ><i class="fa fa-trash-o"></i></button>
						</td>
					</tr>
					<?php
					$i++;
				} //end of while

				 ?>
			</table>
			<?php
		}// end of inner IF
		else{
			?>
			<div style="color: red">No Any Records Found</div>			
			<?php
		}
	}// end of elseif
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "delete_blog"){
		$query = "DELETE FROM blog WHERE blog_id = ".$_REQUEST['blog_id'];
		$result = mysqli_query($connection,$query);

		if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>blog ID: (<?= $_REQUEST['blog_id'];?>) Deleted Successfully</h3></strong></div>
			<?php
		}
		else{
			?>
			<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>blog ID: (<?= $_REQUEST['blog_id'];?>) Not Deleted Try Again Later</h3></strong></div>
			<?php
		}
	}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_blog"){
			// echo "Edit"; die;
			$query = "SELECT * FROM blog WHERE blog_id =".$_REQUEST['blog_id']."";
			// echo $query; 
			$result = mysqli_query($connection,$query);

			$blog = mysqli_fetch_assoc($result);

			?>
			<div class="container mt-2 border border-1">
				<div class="row">
					<div class="col-md-12">
						

			<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> EDIT blog </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr> 
					<tr>
						<td><b>Blog Title: </b></td>
						<td><input type="text" id="blog_title" value="<?= $blog['blog_title']?>"></td>
					</tr>
					<tr>
						<td><b>Post Per Page: </b></td>
						<td><input type="text" id="post_per_page" value="<?= $blog['post_per_page']?>"></td>
					</tr>
					<tr>
						<td><b>Blog Background Image: </b></td>
						<td><input type="file" id="blog_background_image" value="<?= $blog['blog_background_image']?>" accept="image/*"></td>
					</tr>
					<tr>
						<td><b>blog_status: </b></td>
						<td><select id="blog_status" ><option value="Active">Active</option>
							<option value="InActive">InActive</option></select></td>
						<td><b>Current Status: </b><input type="text" id="blog_status" value="<?= $blog['blog_status']?>"></td>
					</tr>

					<tr>
						<td colspan="2" align="center">
							<button onclick="update_blog(<?php echo $_REQUEST['blog_id'] ?>)" class="btn btn-success">Update blog</button>
							<button  onclick="cancel()" class="btn btn-danger">Cancel</button>
						</td>
					</tr>
				</table>
				</div>
				</div>
			</div>
			<?php




		}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "update_blog"){
			// echo "Update";
					

			$query = "UPDATE blog SET  blog_title = '".$_REQUEST['blog_title']."', post_per_page = '".$_REQUEST['post_per_page']."', blog_background_image = '".$_REQUEST['blog_background_image']."', blog_status = '".$_REQUEST['blog_status']."', updated_at = '".$update_time."' WHERE blog_id = '".$_REQUEST['blog_id']."' ";
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Blog ID: (<?= $_REQUEST['blog_id'];?>) Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Blog ID: (<?= $_REQUEST['blog_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "active"){
			// echo "Update";
			

			$query = "UPDATE blog SET blog_status = '".$_REQUEST['is_active']."' WHERE blog_id = ".$_REQUEST['blog_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>blog ID: (<?= $_REQUEST['blog_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>blog ID: (<?= $_REQUEST['blog_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "inactive"){
			// echo "Update";
			

			$query = "UPDATE blog SET blog_status = '".$_REQUEST['is_active']."' WHERE blog_id = ".$_REQUEST['blog_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>blog ID: (<?= $_REQUEST['blog_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>blog ID: (<?= $_REQUEST['blog_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "get_form"){
			?>	<div class="container mt-5 border border-1">
				<div class="row">
		<div class="col-md-12 ">
			<form  action="" method="POST" enctype="multipart/form-data" style="width: 80%; height: 80%;">
				<fieldset>
					
					<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> ADD BLOG </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr>
					
					<tr>
						<td><b>Blog Title: </b></td>
						<td><input type="text" class="form-control" id="blog_title" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>Post Per Page: </b></td>
						<td><input type="text" class="form-control" id="post_per_page" maxlength="50"></td>
					</tr>
					
					<tr>
						<td><b>blog Status: </b></td>
						<td><select id="blog_status"><option value="active">Active</option>
							<option value="inactive">Inactive</option></select>
					</tr>
					<tr>
						<td><b>Blog Background Image: </b></td>
						<td><input type="file" class="form-control"  id="blog_background_image" accept="image/*"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button onclick="add_blog()" class="btn btn-success">Add Blog</button>
							<button  onclick="cancel()" class="btn btn-danger">Cancel</button>
						</td>
					</tr>
				</table>
			</fieldset>
			</form>
		</div>
	</div>
</div>
			<?php
		}

		
	?>
