<?php 
	session_start();
// print_r($_REQUEST);
	require_once("../../require/connection.php");
	
	
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_settings"){

		if(isset($_REQUEST['search_input'])){
			$query = "SELECT * FROM setting WHERE setting_id LIKE '%".$_REQUEST['search_input']."%' OR setting_status LIKE '%".$_REQUEST['search_input']."%' OR first_name LIKE '%".$_REQUEST['search_input']."%' OR email LIKE '%".$_REQUEST['search_input']."%'";
		}
		else{
			$query = "SELECT first_name, email, gender, date_of_birth, setting_id, setting_key, setting_value, setting_status FROM USER, setting WHERE user.`user_id`=setting.`user_id`";
		}
		$settings = mysqli_query($connection,$query);
		// print_r($settings);
		if($settings->num_rows){
$_SESSION['setting']= $settings->field_count;

			?>
			<br>
			<table>
				<tr>
					<td><h3>Search: &nbsp </h3></td>
					<td><input type="text" placeholder="Search Here" id="search_setting" class="p-1"></td>
					<td><button onclick="search_setting()" class="btn btn-success " >Search</button></td>
				</tr>
			</table>
			<br>
			                  

			<table  border="1" cellpadding="12" cellspacing="2" width="30%" >
				<tr style="background-color: #0080ff; color: white;"  >
					<td><b>#</b></td>
					<td><b>First_name</b></td>
					<td><b>Email</b></td>
					<td><b>Gender</b></td>
					<td><b>Date_of_birth</b></td>
					<td><b>Setting Id</b></td>
					<td><b>Setting key</b></td>
					<td><b>Setting value</b></td>
					<td><b>Setting Status</b></td>
					<!-- <td><b>Created At</b></td> -->
					<td><b>Actions</b></td>
				</tr>
				<?php 
				$i = 1;
				// print_r($setting['setting_image']);
				while($setting = mysqli_fetch_array($settings)){
					?>
					<tr>

						<td><?php echo $i; ?></td>
						<td><?= $setting['first_name'] ?></td>
						<td><?= $setting['email'] ?></td>
						<td><?= $setting['gender'] ?></td>
						<td><?= $setting['date_of_birth'] ?></td>
						<td><?= $setting['setting_id'] ?></td>
						<td><?= $setting['setting_key'] ?></td>
						<td><?= $setting['setting_value'] ?></td>
						<td><?= $setting['setting_status'] ?>
							<button class="actions btn btn-success"  onclick="active(<?php echo $setting['setting_id']?>)" title="Active" id = "active" ><i class='fas fa-eye'></i></i></button>
							<button class="actions btn btn-danger"  onclick="inactive(<?php echo $setting['setting_id']?>)" title="Inactive" ><i class='fas fa-eye-slash'></i></button>
						</td>
							
						</td>
						<td>

							<!-- <button class="actions btn btn-success"  onclick="edit_setting(<?= $setting['setting_id']?>)" title="Respond" ><i class='fas fa-edit' ></i></button> -->
							<button class="actions btn btn-danger"  onclick="delete_setting(<?php echo $setting['setting_id']?>)" title="Delete" ><i class="fa fa-trash-o"></i></button>
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
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "delete_setting"){
		$query = "DELETE FROM setting WHERE setting_id = ".$_REQUEST['setting_id'];
		$result = mysqli_query($connection,$query);

		if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>setting ID: (<?= $_REQUEST['setting_id'];?>) Deleted Successfully</h3></strong></div>
			<?php
		}
		else{
			?>
			<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>setting ID: (<?= $_REQUEST['setting_id'];?>) Not Deleted Try Again Later</h3></strong></div>
			<?php
		}
	}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_setting"){
			// echo "Edit"; die;
			$query = "SELECT * FROM setting WHERE setting_id =".$_REQUEST['setting_id']."";
			// echo $query; 
			$result = mysqli_query($connection,$query);

			$setting = mysqli_fetch_assoc($result);
// print_r($setting);
			?>
			<div class="container mt-2 border border-1">
				<div class="row">
					<div class="col-md-12">
						
first_name  email   gender  date_of_birth  setting_id  setting_key       setting_value  setting_status  

			<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> Update Setting </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr> 
					<tr>

						<td><b>User Id: </b></td>
						<td><input type="text" id="user_id" value="<?= $setting['user_id']?>"></td>
					</tr>
					<tr>
						<td><b>Post Id: </b></td>
						<td><input type="text" id="post_id" value="<?= $setting['post_id']?>"></td>
					</tr>
					<tr>
						<td><b>setting: </b></td>
						<td><input type="text" id="setting" value="<?= $setting['setting']?>"></td>
					</tr>
					
					<tr>
						<td><b>setting Status: </b></td>
						<td><select id="setting_status">
							<option value="Active">Active</option>
							<option value="InActive">InActive</option></select></td>
					</tr>

					<tr>
						<td colspan="2" align="center">
							<button onclick="update_setting(<?php echo $_REQUEST['setting_id'] ?>)" class="btn btn-success">Send</button>
							<button  onclick="cancel()" class="btn btn-danger">Cancel</button>
						</td>
					</tr>
				</table>
				</div>
				</div>
			</div>
			<?php




		}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "update_setting"){
			// echo "Update";
					

			$query = "UPDATE setting SET user_id = '".$_REQUEST['user_id']."', post_id = '".$_REQUEST['post_id']."', setting = '".$_REQUEST['setting']."', setting_status = '".$_REQUEST['setting_status']."' WHERE setting_id = '".$_REQUEST['setting_id']."' ";
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>setting ID: (<?= $_REQUEST['setting_id'];?>) Response sent</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>setting ID: (<?= $_REQUEST['setting_id'];?>) Not Sent Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "active"){
			// echo "Update";
			

			$query = "UPDATE setting SET setting_status = '".$_REQUEST['setting_status']."' WHERE setting_id = ".$_REQUEST['setting_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>setting ID: (<?= $_REQUEST['setting_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>setting ID: (<?= $_REQUEST['setting_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "inactive"){
			// echo "Update";
			

			$query = "UPDATE setting SET setting_status = '".$_REQUEST['setting_status']."' WHERE setting_id = ".$_REQUEST['setting_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>setting ID: (<?= $_REQUEST['setting_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>setting ID: (<?= $_REQUEST['setting_id'];?>) Not Updated Try Again Later</h3></strong></div>
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
					<h3 style="padding-top: 25px;"> ADD setting </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr>
					
					<tr>
    <!-- setting_id  user_id  post_id  setting_per_page  setting_background_image  setting_status           created_at  updated_at   -->

						<td><b>User Id: </b></td>
						<td><input type="text" class="form-control" id="user_id" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>Post Id: </b></td>
						<td><input type="text" class="form-control" id="post_id" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>setting Status: </b></td>
						<td><select id="setting_status"><option value="active">Active</option>
							<option value="inactive">Inactive</option></select>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button onclick="add_setting()" class="btn btn-success">Add setting</button>
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
