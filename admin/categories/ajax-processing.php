<?php 
session_start();
// print_r($_REQUEST);
	require_once("../../require/connection.php");
		date_default_timezone_set("Asia/karachi");
	$update_time = date("Y-m-d h:m:s", time());


	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "add_category"){
		echo "working";

		$query = "INSERT INTO category (category_title, category_description, category_status ) VALUES ('".$_REQUEST['category_title']."','".$_REQUEST['category_description']."','".$_REQUEST['category_status']."')";

		
		$result = mysqli_query($connection,$query);
		if($result){
			$category_id = mysqli_insert_id($connection);
			?>
			<div style="color: green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>category (<?= $category_id ?>) Inserted Successfully</h3></strong></div>

			<?php
		}
		else{
			?>
			<div style="color: red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>">Category Not Inserted Try Again Later</h3></strong></div>
			<?php
		}
	}
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_categorys"){

		if(isset($_REQUEST['search_input'])){
			$query = "SELECT * FROM category WHERE category_title LIKE '%".$_REQUEST['search_input']."%'  OR category_status LIKE '%".$_REQUEST['search_input']."%'";
		}
		else{
			$query = "SELECT * FROM category ORDER BY category_id DESC";
		}
		$categorys = mysqli_query($connection,$query);
		if($categorys->num_rows){
			$_SESSION['category']=$categorys->num_rows;
			?>
			<br>
			<table>
				<tr>
					<td><h3>Search: &nbsp </h3></td>
					<td><input type="text" placeholder="Search Here" id="search_category" class="p-1"></td>
					<td><button onclick="search_category()" class="btn btn-success " >Search</button></td>
				</tr>
			</table>
			<br>
			                  

			<table  border="1" cellpadding="12" cellspacing="2" width="30%" >
				<tr style="background-color: #0080ff; color: white;"  >
					<td><b>#</b></td>
					<td><b>category_title</b></td>
					<td><b>category_description</b></td>
					<td><b>category_status</b></td>
					<td><b>created_at</b></td>
					<td><b>updated_at</b></td>
					<td><b>Actions</b></td>
				</tr>
				<?php 
				$i = 1;
				// print_r($category['category_image']);
				while($category = mysqli_fetch_array($categorys)){
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><?= $category['category_title'] ?></td>
						<td><?= $category['category_description'] ?></td>
						<td><?= $category['category_status'] ?>
							<button class="actions btn btn-success"  onclick="active(<?php echo $category['category_id']?>)" title="Active"  ><i class='fas fa-eye'></i></i></button>
							<button class="actions btn btn-danger"  onclick="inactive(<?php echo $category['category_id']?>)" title="InActive" ><i class='fas fa-eye-slash'></i></button>
						</td>
						<td><?= $category['created_at'] ?>
						<td><?= $category['updated_at'] ?>
							
						</td>
						<td>

							<button class="actions btn btn-success"  onclick="edit_category(<?= $category['category_id']?>)" title="Edit"  ><i class='fas fa-edit' ></i></button>
							<button class="actions btn btn-danger"  onclick="delete_category(<?php echo $category['category_id']?>)" title="Delete" ><i class="fa fa-trash-o"></i></button>
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
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "delete_category"){
		$query = "DELETE FROM category WHERE category_id = ".$_REQUEST['category_id'];
		$result = mysqli_query($connection,$query);

		if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>category ID: (<?= $_REQUEST['category_id'];?>) Deleted Successfully</h3></strong></div>
			<?php
		}
		else{
			?>
			<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>category ID: (<?= $_REQUEST['category_id'];?>) Not Deleted Try Again Later</h3></strong></div>
			<?php
		}
	}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_category"){
			// echo "Edit"; die;
			$query = "SELECT * FROM category WHERE category_id =".$_REQUEST['category_id']."";
			// echo $query; 
			$result = mysqli_query($connection,$query);

			$category = mysqli_fetch_assoc($result);

			?>
			<div class="container mt-2 border border-1">
				<div class="row">
					<div class="col-md-12">
						

			<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> EDIT CATEGORY </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr> 
					
					<tr>
						<td><b>category_title: </b></td>
						<td><input type="text" id="category_title" value="<?= $category['category_title']?>"></td>
					</tr>
					<tr>
						<td><b>category_description: </b></td>
						<td><input type="text" id="category_description" value="<?= $category['category_description']?>"></td>
					</tr>
					<tr>
						<td><b>category_status: </b></td>
						<td><input type="text" id="category_status" value="<?= $category['category_status']?>"></td>
					</tr>

					<tr>
						<td colspan="2" align="center">
							<button onclick="update_category(<?php echo $_REQUEST['category_id'] ?>)" class="btn btn-success">Update category</button>
							<button  onclick="cancel()" class="btn btn-danger">Cancel</button>
						</td>
					</tr>
				</table>
				</div>
				</div>
			</div>
			<?php




		}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "update_category"){
			// echo "Update";
		

			$query = "UPDATE category SET  category_title = '".$_REQUEST['category_title']."', category_description ='".$_REQUEST['category_description']."', category_status = '".$_REQUEST['category_status']."', updated_at = '".$update_time."'  WHERE category_id = ".$_REQUEST['category_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>category ID: (<?= $_REQUEST['category_id'];?>) Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>category ID: (<?= $_REQUEST['category_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "active_category")
		{
			
			$query_ = "UPDATE category SET category_status = 'Active' WHERE category_id =".$_REQUEST['category_id'];
			$result = mysqli_query($connection,$query_);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Category ID: (<?= $_REQUEST['category_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Category ID: (<?= $_REQUEST['category_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "inactive_category"){
			// echo "Update";
			

			$query = "UPDATE category SET category_status = 'InActive' WHERE category_id = ".$_REQUEST['category_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>category ID: (<?= $_REQUEST['category_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>category ID: (<?= $_REQUEST['category_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "get_form"){
			?>	<div class="container mt-5 border border-1">
				<div class="row">
		<div class="col-md-12 ">
			<form  action="" method="POST"  style="width: 80%; height: 80%;">
				<fieldset>
					
					<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> ADD CATEGORY </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr>
			        
			        <!-- category_id  category_title  category_description category_status created_at  updated_at   -->
					
					<tr>
						<td><b>Category Title: </b></td>
						<td><input type="text" class="form-control" id="category_title" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>Category Description: </b></td>
						<td><input type="text" class="form-control" id="category_description" ></td>
					</tr>
					<tr>
						<td><b>Category Status: </b></td>
						<td><select id="category_status"><option value="active">Active</option>
							<option value="inactive">Inactive</option></select>
					</tr>
					
					<tr>
						<td colspan="2" align="center">
							<button onclick="add_category()" class="btn btn-success">Add category</button>
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
