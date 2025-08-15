<?php 
session_start();
// print_r($_REQUEST);
	require_once("../../require/connection.php");
		date_default_timezone_set("Asia/karachi");
	$update_time = date("Y-m-d h:m:s", time());

	
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_feedbacks"){
    //feedback_id  user_id  user_name  user_email feedback created_at  updated_at        

		if(isset($_REQUEST['search_input'])){
			$query = "SELECT * FROM user_feedback WHERE user_id LIKE '%".$_REQUEST['search_input']."%' OR user_name LIKE '%".$_REQUEST['search_input']."%' OR user_email LIKE '%".$_REQUEST['search_input']."%'";
		}
		else{
			$query = "SELECT * FROM user_feedback ORDER BY feedback_id DESC";
		}
		$feedbacks = mysqli_query($connection,$query);
		if($feedbacks->num_rows){
			$_SESSION['feedback']=$feedbacks->num_rows;

			?>
			<br>
			<table>
				<tr>
					<td><h3>Search: &nbsp </h3></td>
					<td><input type="text" placeholder="Search Here" id="search_feedback" class="p-1"></td>
					<td><button onclick="search_feedback()" class="btn btn-success " >Search</button></td>
				</tr>
			</table>
			<br>
			                  

			<table  border="1" cellpadding="12" cellspacing="2" width="30%" >
				<tr style="background-color: #0080ff; color: white;"  >
					<td><b>#</b></td>
					<td><b>user_id</b></td>
					<td><b>user_name</b></td>
					<td><b>user_email</b></td>
					<td><b>feedback</b></td>
					<td><b>created_at</b></td>
					<td><b>updated_at</b></td>
					<td><b>Actions</b></td>
				</tr>
				<?php 
				$i = 1;
				// print_r($feedback['feedback_image']);
				while($feedback = mysqli_fetch_array($feedbacks)){
					?>
					<tr>

						<td><?php echo $i; ?></td>
						<td><?= $feedback['user_id'] ?></td>
						<td><?= $feedback['user_name'] ?></td>
						<td><?= $feedback['user_email'] ?></td>
						<td><?= $feedback['feedback'] ?> </td>
						
						<td><?= $feedback['created_at'] ?>
						<td><?= $feedback['updated_at'] ?>
							
						</td>
						<td>

							<button class="actions btn btn-success"  onclick="edit_feedback(<?= $feedback['feedback_id']?>)" title="Respond"  ><i class='fas fa-edit' ></i></button>
							<button class="actions btn btn-danger"  onclick="delete_feedback(<?php echo $feedback['feedback_id']?>)" title="Delete" ><i class="fa fa-trash-o"></i></button>
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
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "delete_feedback"){
		$query = "DELETE FROM user_feedback WHERE feedback_id = ".$_REQUEST['feedback_id'];
		$result = mysqli_query($connection,$query);

		if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>feedback ID: (<?= $_REQUEST['feedback_id'];?>) Deleted Successfully</h3></strong></div>
			<?php
		}
		else{
			?>
			<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>feedback ID: (<?= $_REQUEST['feedback_id'];?>) Not Deleted Try Again Later</h3></strong></div>
			<?php
		}
	}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_feedback"){
			// echo "Edit"; die;
			$query = "SELECT * FROM user_feedback WHERE feedback_id =".$_REQUEST['feedback_id']."";
			// echo $query; 
			$result = mysqli_query($connection,$query);

			$feedback = mysqli_fetch_assoc($result);

			?>
			<div class="container mt-2 border border-1">
				<div class="row">
					<div class="col-md-12">
						

			<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> Respond On Feedback </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr> 
					<tr>

						<td><b>User Id: </b></td>
						<td><input type="text" id="user_id" value="<?= $feedback['user_id']?>"></td>
					</tr>
					<tr>
						<td><b>User Name: </b></td>
						<td><input type="text" id="user_name" value="<?= $feedback['user_name']?>"></td>
					</tr>
					<tr>
						<td><b>User Email: </b></td>
						<td><input type="text" id="user_email" value="<?= $feedback['user_email']?>"></td>
					</tr>
					<tr>
						<td><b>Feedback : </b></td>
						<td><input type="text" id="feedback" value="<?= $feedback['feedback']?>" ></td>
					</tr>
					<tr>
						<td><b>Feedback Response: </b></td>
						<td><input type="text" id="feedback" value="" placeholder="Your response here"></td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button onclick="update_feedback(<?php echo $_REQUEST['feedback_id'] ?>)" class="btn btn-success">Send</button>
							<button  onclick="cancel()" class="btn btn-danger">Cancel</button>
						</td>
					</tr>
				</table>
				</div>
				</div>
			</div>
			<?php




		}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "update_feedback"){
			// echo "Update";
					

			$query = "UPDATE user_feedback SET user_id = '".$_REQUEST['user_id']."', user_name = '".$_REQUEST['user_name']."', user_email = '".$_REQUEST['user_email']."', feedback = '".$_REQUEST['feedback']."', updated_at = '".$update_time."' WHERE feedback_id = '".$_REQUEST['feedback_id']."' ";
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>feedback ID: (<?= $_REQUEST['feedback_id'];?>) Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>feedback ID: (<?= $_REQUEST['feedback_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}

		
		

		
	?>
