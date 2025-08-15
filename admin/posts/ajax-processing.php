<?php 
session_start();
require_once("../../require/connection.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/src/PHPMailer.php';
require '../PHPMailer/src/SMTP.php';
require '../PHPMailer/src/Exception.php';

	date_default_timezone_set("Asia/karachi");
	$update_time = date("Y-m-d h:m:s", time());
// print_r($_REQUEST);
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "add_post"){
		// echo "working";

		$dir="../../images/";
			$file_path=$dir.substr($_REQUEST['featured_image'],12);
			echo $file_path;

		$query = "INSERT INTO post(blog_id,post_title,post_summary,post_description,featured_image) 
				VALUES('".$_REQUEST['blog_id']."','".htmlspecialchars($_REQUEST['post_title'])."','".htmlspecialchars($_REQUEST['post_summary'])."','".htmlspecialchars($_REQUEST['post_description'],true)."','".$file_path."')";

		
		$result = mysqli_query($connection,$query);
		if($result)
		{
		$post_id = mysqli_insert_id($connection);

			$Category_query="INSERT INTO post_category(post_id,category_id) VALUES('".$post_id."','".$_REQUEST['category_id']."')";
					
			$category_result = mysqli_query($connection,$Category_query);

			$query = "SELECT * FROM blog b JOIN post p ON b.blog_id=p.blog_id";
			$result = mysqli_query($connection,$query);
			if ($result) {
				while ($res=mysqli_fetch_assoc($result)) {
				$blog_id= $res['blog_id'];
				$user_query = "SELECT * FROM USER u JOIN blog b JOIN post p JOIN `user_blog_following` ubf ON u.`user_id`=ubf.`follower_id` AND b.`blog_id`=ubf.`blog_following_id` AND p.`blog_id`=ubf.`blog_following_id` WHERE ubf.`status`='Followed' AND ubf.`blog_following_id` = '".$blog_id."' AND p.`post_id`='".$post_id."' ";
$user_result = mysqli_query($connection, $user_query);
print_r($user_result);

$users= mysqli_fetch_assoc($user_result);

//Create a new PHPMailer instance
$mail = new PHPMailer();
//Tell PHPMailer to use SMTP
$mail->isSMTP();
//Enable SMTP debugging
// SMTP::DEBUG_OFF = off (for production use)
// SMTP::DEBUG_CLIENT = client messages
// SMTP::DEBUG_SERVER = client and server messages
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;
//Set the hostname of the mail server
$mail->Host = 'smtp.gmail.com';

// use
// $mail->Host = gethostbyname('smtp.gmail.com');
// if your network does not support SMTP over IPv6
//Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
$mail->Port = 587;
//Set the encryption mechanism to use - STARTTLS or SMTPS
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//Whether to use SMTP authentication
$mail->SMTPAuth = true;
//Username to use for SMTP authentication - use full email address for gmail
$mail->Username = "dummy723example@gmail.com";
//Password to use for SMTP authentication
$mail->Password = "dummy@723";
//Set who the message is to be sent from
// $mail->setFrom('phpbasic2k22@gmail.com', 'Php Basic');
$mail->setFrom($users['email']);



//Set an alternative reply-to address
//$mail->addReplyTo('hidayatrust1788@gmail.com', 'Hidaya Trust');
//Set who the message is to be sent to
$mail->addAddress($users['email']);

//Set the subject line
$mail->Subject = "New Post Added Alert";
//Read an HTML message body
//$mail->isHTML();
$mail->msgHTML("Dear"." ".$users['first_name']." ".$users['last_name'].".<br>"."New Post Has Been Added In The Blog (".$users['blog_title'].") That You Have Followed. <br> Post Title Is:".$users['post_title']." and short post summary is: "." ".$users['post_summary'].".");

if (!$mail->send()) {
   echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
   echo 'Message sent!';
}



				}
			}
				

				?>


				<div style="color: green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post (<?= $post_id ?>) Inserted Successfully</h3></strong></div>

				<?php
		}
			    else
			    {
				?>
				<div style="color: red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>">post Not Inserted Try Again Later</h3></strong></div>
				<?php
			   	}
		
		
	}
	if(isset($_REQUEST['action']) && $_REQUEST['action'] == "get_attachment_form"){
			?>
			<div class="container mt-5 border border-1">
				<div class="row">
		<div class="col-md-12 ">
			<form  action="" method="POST" enctype="multipart/form-data" style="width: 80%; height: 80%;">
				<fieldset>
					
					<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> ADD POST ATTACHMENT</h3>
					<hr style="width:100%; height:4px; background-color: black" >					
					</tr>
					<tr>
						<td><b>Post Attachment Title :</b></td>
						<td><input type="text" class="form-control" id="post_attachment_title"  required></td>
					</tr>
				 	<tr>
						<td><b>Post Attachment path:</b></td>
						<td> 
							<input type="File" id="post_attachment_path" name="post_path" required class="form-control">
						</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button onclick="add_post_attachment()" class="btn btn-success">Add Attachment</button>
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
				
					//$file = $_FILES['post_path'];
					$dir="../../images/";
					$file_path=$dir.substr($_REQUEST['post_attachment_path'],12);
					//move_uploaded_file($dir,substr($_REQUEST['post_attachment_path'],12));

		         
					$query = "INSERT INTO post_atachment(post_attachment_title,post_attachment_path) 
						VALUES('".$_REQUEST['post_attachment_title']."','".$file_path."')";

						$result = mysqli_query($connection,$query);

						if($result){
							$attachment_id = mysqli_insert_id($connection);
							?>
						<div style="color: green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>Post Attachment Inserted Successfully</h3></strong></div>
							<?php
						}
						else{
							?>
						<div style="color: red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>">Post Attachment Not Inserted Try Again Later</h3></strong></div>
							<?php
						}
					}
	
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "show_posts"){

		if(isset($_REQUEST['search_input'])){
			$query = "SELECT * FROM post WHERE post_title LIKE '%".$_REQUEST['search_input']."%' OR post_summary LIKE '%".$_REQUEST['search_input']."%' OR blog_id LIKE '%".$_REQUEST['search_input']."%'";
		}
		else{
			$query = "SELECT * FROM blog,post,category,`post_category` WHERE post.post_id = `post_category`.`post_id` AND blog.blog_id = post.`blog_id` AND category.category_id = `post_category`.`category_id` ORDER BY post.post_id DESC";
		}
		$posts = mysqli_query($connection,$query);

		if($posts){
			//$_SESSION['post']=$posts->num_rows;

			?>
			<br>
			<table>
				<tr>
					<td><h3>Search: &nbsp </h3></td>
					<td><input type="text" placeholder="Search Here" id="search_post" class="p-1"></td>
					<td><button onclick="search_post()" class="btn btn-success " >Search</button></td>
				</tr>
			</table>
			<br>
			                  
        <!-- post_atachment_id  post_id  post_attachment_title  post_attachment_path  is_active  created_at  updated_at   -->

			<table  border="1" cellpadding="12" cellspacing="2" width="30%" >
				<tr style="background-color: #0080ff; color: white;"  >
					<td><b>#</b></td>
					<td><b>Featured Image</b></td>
					<td><b>Blog Title</b></td>
					<td><b>Category Title</b></td>
					<td><b>Post Title</b></td>
					<td><b>Post Summary</b></td>
					<td><b>Post Status</b></td>
					<td><b>Is Comment Allowed</b></td>
					<!-- <td><b>created_at</b></td>
					<td><b>updated_at</b></td> -->
					<td><b>Actions</b></td>
				</tr>
				<?php 
				$i = 1;
				// print_r($post['post_image']);
				while($post = mysqli_fetch_array($posts)){
					?>
					<tr>
						<td><?php echo $i; ?></td>
						<td><img src="../../images/<?= $post['featured_image'] ?>" width="50px" height="50px" ></td>
						<td><?= $post['blog_title'] ?></td>
						<td><?= $post['category_title'] ?></td>
						<td><?= $post['post_title'] ?></td>
						<td><?= $post['post_summary'] ?></td>
						<td><?= $post['post_status'] ?>
							<button class="actions btn btn-success"  onclick="active(<?php echo $post['post_id']?>)" title="Active" id = "active" ><i class='fas fa-eye'></i></i></button>
							<button class="actions btn btn-danger"  onclick="inactive(<?php echo $post['post_id']?>)" title="Inactive" ><i class='fas fa-eye-slash'></i></button>
						</td>
						<td><?= $post['is_comment_allowed'] ?>
							<button class="actions btn btn-success"  onclick="approve(<?php echo $post['post_id']?>)" title="Allowed"  ><i class='fas fa-plus-circle'></i></i></button>
							<button class="actions btn btn-danger"  onclick="reject(<?php echo $post['post_id']?>)" title="Not Allowed" ><i class='fas fa-minus-circle'></i></button>
						</td>
						<td>

							<button class="actions btn btn-success"  onclick="edit_post(<?= $post['post_id']?>)" title="Edit"  ><i class='fas fa-edit' ></i></button>
							<button class="actions btn btn-danger"  onclick="delete_post(<?php echo $post['post_id']?>)" title="Delete" ><i class="fa fa-trash-o"></i></button>
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
	elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "delete_post"){
		$query = "DELETE FROM post WHERE post_id = ".$_REQUEST['post_id'];
		$result = mysqli_query($connection,$query);

		if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Deleted Successfully</h3></strong></div>
			<?php
		}
		else{
			?>
			<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Not Deleted Try Again Later</h3></strong></div>
			<?php
		}
	}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "edit_post"){
			// echo "Edit"; die;
			$query = "SELECT * FROM post WHERE post_id =".$_REQUEST['post_id']."";
			// echo $query; 
			$result = mysqli_query($connection,$query);

			$post = mysqli_fetch_assoc($result);

			?>
			<div class="container mt-2 border border-1">
				<div class="row">
					<div class="col-md-12">
						

			<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> EDIT POST </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr> 
					<tr>
						<td><b>blog_id: </b></td>
						<td><input type="text" id="blog_id" value="<?= $post['blog_id']?>"></td>
					</tr>
					<tr>
						<td><b>post_title: </b></td>
						<td><input type="text" id="post_title" value="<?= $post['post_title']?>"></td>
					</tr>
					<tr>
						<td><b>post_summary: </b></td>
						<td><input type="text" id="post_summary" value="<?= $post['post_summary']?>"></td>
					</tr>
					<tr>
						<td><b>post_description: </b></td>
						<td><input type="text" id="post_description" value="<?= $post['post_description']?>"></td>
					</tr>
					<tr>
						<td><b>featured_image: </b></td>
						<td><input type="file" id="featured_image" value="<?= $post['featured_image']?>" accept="image/*"></td>
					</tr>
					<tr>
						<td><b>post_status: </b></td>
						<td><input type="text" id="post_status" value="<?= $post['post_status']?>"></td>
					</tr>
					<tr>
						<td><b>is_comment_allowed: </b></td>
						<td><input type="text" id="is_comment_allowed" value="<?= $post['is_comment_allowed']?>"></td>
					</tr>

					<tr>
						<td colspan="2" align="center">
							<button onclick="update_post(<?php echo $_REQUEST['post_id'] ?>)" class="btn btn-success">Update Post</button>
							<button  onclick="cancel()" class="btn btn-danger">Cancel</button>
						</td>
					</tr>
				</table>
				</div>
				</div>
			</div>
			<?php




		}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "update_post"){
			// echo "Update";
					

			$query = "UPDATE post SET blog_id = '".$_REQUEST['blog_id']."', post_title = '".$_REQUEST['post_title']."', post_summary = '".$_REQUEST['post_summary']."', post_description ='".$_REQUEST['post_description']."', featured_image = '".$_REQUEST['featured_image']."', post_status = '".$_REQUEST['post_status']."', is_comment_allowed = '".$_REQUEST['is_comment_allowed']."', updated_at = '".$update_time."' WHERE post_id = ".$_REQUEST['post_id'];
			$result = mysqli_query($connection,$query);
			// echo "updated at: ".$update_time;

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>POST ID: (<?= $_REQUEST['post_id'];?>) Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "active"){
			// echo "Update";
			

			$query = "UPDATE post SET post_status = '".$_REQUEST['is_active']."' WHERE post_id = ".$_REQUEST['post_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "inactive"){
			// echo "Update";
			

			$query = "UPDATE post SET post_status = '".$_REQUEST['is_active']."' WHERE post_id = ".$_REQUEST['post_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "approve"){
			// echo "Update";
			

			$query = "UPDATE post SET is_comment_allowed = '".$_REQUEST['is_approved']."' WHERE post_id = ".$_REQUEST['post_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}
		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "reject"){
			// echo "Update";
			

			$query = "UPDATE post SET is_comment_allowed = '".$_REQUEST['is_approved']."' WHERE post_id = ".$_REQUEST['post_id'];
			$result = mysqli_query($connection,$query);

			if($result){
			?>
			<div style="color:green; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Status Updated Successfully</h3></strong></div>
			<?php
			}
			else{
				?>
				<div style="color:red; font-weight: bold; margin-top: 20px; margin-bottom: 10px;"><strong><h3>post ID: (<?= $_REQUEST['post_id'];?>) Not Updated Try Again Later</h3></strong></div>
				<?php
			}
		}

		elseif(isset($_REQUEST['action']) && $_REQUEST['action'] == "get_form")
		{
			?>	<div class="container mt-5 border border-1">
				<div class="row">
		<div class="col-md-12 ">
			<form  action="" method="POST" enctype="multipart/form-data" style="width: 80%; height: 80%;">
				<fieldset>
					
					<table cellpadding="10">
					<tr align="center">
					<h3 style="padding-top: 25px;"> ADD POST </h3>
					<hr style="width:100%; height:4px; background-color: black" >					</tr>
					
					<tr>
						<td><b>Select Blog</b></td>
						<td>
						<select id="blog_id" class="form-control">
							<option>SELECT BLOG</option>
							<?php 
							 $query="SELECT * from blog where blog_status='Active'";
							 $result = mysqli_query($connection,$query);
								if($result)
								{
									while ($res = mysqli_fetch_assoc($result)) 
									{
										?>
                                         <option value="<?php echo $res['blog_id'] ?>"><?php echo $res['blog_title'] ?></option>
										<?php
									}

								}

							?>
							
						</select>
					    </td>
					</tr>
					<tr>
						<td><b>Select Category</b></td>
						<td>
						<select id="category_id" class="form-control">
							<option>SELECT Category</option>
							<?php 
							 $query="SELECT * from category where category_status='Active'";
							 $result = mysqli_query($connection,$query);
								if($result)
								{
									while ($res = mysqli_fetch_assoc($result)) 
									{
										?>
                                         <option value="<?php echo $res['category_id'] ?>"><?php echo $res['category_title'] ?></option>
										<?php
									}

								}

							?>
							
						</select>
					    </td>
					</tr>
					<tr>
						<td><b>Post Title: </b></td>
						<td><input type="text" class="form-control" id="post_title" maxlength="30"></td>
					</tr>
					<tr>
						<td><b>Post Summary: </b></td>
						<td><input type="text" class="form-control" id="post_summary" maxlength="50"></td>
					</tr>
					<tr>
						<td><b>Post Description: </b></td>
						<td><input type="text" class="form-control" id="post_description" ></td>
					</tr>
					<tr>
						<td><b>Post Status: </b></td>
						<td><select id="post_status"><option value="active">Active</option>
							<option value="inactive">Inactive</option></select>
					</tr>
					<tr>
						<td><b>Featured Image: </b></td>
						<td><input type="file" class="form-control"  id="featured_image" accept="image/*"></td>
					</tr>
					<tr>
						<td><b>Is Comment allowed: </b></td>
						<td><select id="is_comment_allowed">
							<option value="allow">Allow</option>
							<option value="not allow">Not Allow</option></select></td>
					</tr>
					<tr>
						<td><b>Add Attachment: </b></td>
						<td><input type="radio" name="attachment" id="attachment_yes" value="yes" onclick="get_attachment_form()" >Yes   
							<input type="radio" name="attachment" id="attachment_no" value="no" >No</td>
					</tr>
					<tr>
						<td colspan="2" align="center">
							<button onclick="add_post()" class="btn btn-success">Add Post</button>
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
