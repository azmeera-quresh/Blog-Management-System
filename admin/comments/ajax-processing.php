<?php 
	session_start();
// print_r($_REQUEST);
	require_once("../../require/connection.php");
	
	
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_comments"){

		if(isset($_REQUEST['search_input'])){
			$query = "SELECT * FROM user_post_comment WHERE post_id LIKE '%".$_REQUEST['search_input']."%' OR is_active LIKE '%".$_REQUEST['search_input']."%' OR user_id LIKE '%".$_REQUEST['search_input']."%'";
		}
		else{
			$query = "SELECT * FROM user_post_comment upc JOIN post p JOIN USER u ON upc.`post_id`=p.`post_id` AND upc.`user_id`=u.`user_id` ORDER BY post_comment_id DESC";
		}
		$comments = mysqli_query($connection,$query);
		// print_r($comments);
		if($comments->num_rows){
$_SESSION['comment']= $comments->field_count;

			?>
			<br>
			<table>
				<tr>
					<td><h3>Search: &nbsp </h3></td>
					<td><input type="text" placeholder="Search Here" id="search_comment" class="p-1"></td>
					<td><button onclick="search_comment()" class="btn btn-success " >Search</button></td>
				</tr>
			</table>
			<br>
			                  

			<table  border="1" cellpadding="12" cellspacing="2" width="30%" >
				<tr style="background-color: #0080ff; color: white;"  >
					<td><b>#</b></td>
					<td><b>User Id</b></td>
					<td><b>User Name</b></td>
					<td><b>Post Id</b></td>
					<td><b>Post Title</b></td>
					<td><b>Comment</b></td>
					<td><b>Is Active</b></td>
					<td><b>Created At</b></td>
					<td><b>Actions</b></td>
				</tr>
				<?php 
				$i = 1;
				// print_r($comment['comment_image']);
				while($comment = mysqli_fetch_array($comments)){
					?>
					<tr>

						<td><?php echo $i; ?></td>
						<td><?= $comment['user_id'] ?></td>
						<td><?= $comment['first_name'] ?></td>
						<td><?= $comment['post_id'] ?></td>
						<td><?= $comment['post_title'] ?></td>
						<td><?= $comment['comment'] ?></td>
						<td><?= $comment['is_active'] ?>
							<button class="actions btn btn-success"  onclick="active(<?php echo $comment['post_comment_id']?>)" title="Active" id = "active" ><i class='fas fa-eye'></i></i></button>
							<button class="actions btn btn-danger"  onclick="inactive(<?php echo $comment['post_comment_id']?>)" title="Inactive" ><i class='fas fa-eye-slash'></i></button>
						</td>
						<td><?= $comment['created_at'] ?>
							
						</td>
						<td>

 							<button class="actions btn btn-danger"  onclick="delete_comment(<?php echo $comment['post_comment_id']?>)" title="Delete" ><i class="fa fa-trash-o"></i></button>
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
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "delete_comment"){
		$query = "DELETE FROM user_post_comment WHERE post_comment_id = ".$_REQUEST['post_comment_id'];
		$result = mysqli_query($connection,$query);

		if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>comment ID: (<?= $_REQUEST['post_comment_id'];?>) Deleted Successfully</h3></strong></div>
			<?php
		}
		else{
			?>
			<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>comment ID: (<?= $_REQUEST['post_comment_id'];?>) Not Deleted Try Again Later</h3></strong></div>
			<?php
		}
	}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_comment"){
			// echo "Edit"; die;
			$query = "SELECT * FROM user_post_comment WHERE post_comment_id =".$_REQUEST['post_comment_id']."";
			// echo $query; 
			$result = mysqli_query($connection,$query);

			$comment = mysqli_fetch_assoc($result);
// print_r($comment);
			?>
			<div class="container mt-2 border border-1">
				<div class="row">
					<div class="col-md-12">
						

			<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> RESPONSE ON COMMENT </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr> 
					<tr>

						<td><b>User Id: </b></td>
						<td><input type="text" id="user_id" value="<?= $comment['user_id']?>"></td>
					</tr>
					<tr>
						<td><b>Post Id: </b></td>
						<td><input type="text" id="post_id" value="<?= $comment['post_id']?>"></td>
					</tr>
					<tr>
						<td><b>Comment: </b></td>
						<td><input type="text" id="comment" value="<?= $comment['comment']?>"></td>
					</tr>
					
					<tr>
						<td><b>Comment Status: </b></td>
						<td><select id="is_active">
							<option value="Active">Active</option>
							<option value="InActive">InActive</option></select></td>
					</tr>

					<tr>
						<td colspan="2" align="center">
							<button onclick="update_comment(<?php echo $_REQUEST['post_comment_id'] ?>)" class="btn btn-success">Send</button>
							<button  onclick="cancel()" class="btn btn-danger">Cancel</button>
						</td>
					</tr>
				</table>
				</div>
				</div>
			</div>
			<?php




		}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "update_comment"){
			// echo "Update";
					

			$query = "UPDATE user_post_comment SET user_id = '".$_REQUEST['user_id']."', post_id = '".$_REQUEST['post_id']."', comment = '".$_REQUEST['comment']."', is_active = '".$_REQUEST['is_active']."' WHERE post_comment_id = '".$_REQUEST['post_comment_id']."' ";
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>comment ID: (<?= $_REQUEST['post_comment_id'];?>) Response sent</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>comment ID: (<?= $_REQUEST['post_comment_id'];?>) Not Sent Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "active"){
			// echo "Update";
			

			$query = "UPDATE user_post_comment SET is_active = '".$_REQUEST['is_active']."' WHERE post_comment_id = ".$_REQUEST['post_comment_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>comment ID: (<?= $_REQUEST['post_comment_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>comment ID: (<?= $_REQUEST['post_comment_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "inactive"){
			// echo "Update";
			

			$query = "UPDATE user_post_comment SET is_active = '".$_REQUEST['is_active']."' WHERE post_comment_id = ".$_REQUEST['post_comment_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>comment ID: (<?= $_REQUEST['post_comment_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>comment ID: (<?= $_REQUEST['post_comment_id'];?>) Not Updated Try Again Later</h3></strong></div>
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
					<h3 style="padding-top: 25px;"> ADD comment </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr>
					
					<tr>
    <!-- post_comment_id  user_id  post_id  comment_per_page  comment_background_image  is_active           created_at  updated_at   -->

						<td><b>User Id: </b></td>
						<td><input type="text" class="form-control" id="user_id" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>Post Id: </b></td>
						<td><input type="text" class="form-control" id="post_id" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>comment Status: </b></td>
						<td><select id="is_active"><option value="active">Active</option>
							<option value="inactive">Inactive</option></select>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button onclick="add_comment()" class="btn btn-success">Add comment</button>
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
