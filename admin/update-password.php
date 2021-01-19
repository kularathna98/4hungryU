<?php include('../config/constants.php'); ?>
<?php include('../partials/login-check.php'); ?>
<html>
	<head>
		<title>4hungryU Website-Home Page</title>

		<link rel="stylesheet" type="text/css" href="../css/admin.css">
	</head>
<body>
	<!--Menu Section Starts -->
	<div class="menu text-center">
		<div class="wrapper">
			<ul>
				<li><a href="index.php">Home</a></li>
				<li><a href="manage-admin.php">Admin</a></li>
				<li><a href="manage-category.php">Category</a></li>
				<li><a href="manage-food.php">Food</a></li>
				<li><a href="manage-order.php">Order</a></li>
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
	<!-- Menu Section Ends -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Change Password</h1>
			<br><br>
			<?php
			 if (isset($_GET['id'])) {

			 	# code...
			 	$id=$_GET['id'];
			 }
			?>
			<form action="" method="POST">
				<table class="tbl-30">
					<tr>
						<td>Current Password:</td>
						<td>
							<input type="password" name="current_password" placeholder="Current Password">
						</td>
					</tr>
					<tr>
						<td>New Password:</td>
						<td>
							<input type="password" name="new_password" placeholder="New Password">
						</td>
					</tr>
					<tr>
						<td>Confirm Password</td>
						<td>
							<input type="password" name="confirm_password" placeholder="Confirm Password">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" name="submit" value="Change Password" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<?php 
		// check whether the submit button is clicked or not
		if(isset($_POST['submit']))
		{
			//echo "Clicked";
			//get the data from form
			$id = $_POST['id'];
			$current_password = md5($_POST['current_password']);
			$new_password = md5($_POST['new_password']);
			$confirm_password = md5($_POST['confirm_password']);
			//check whether the user with current id and current password exists or not
			$sql = "SELECT * FROM admin WHERE id=$id AND password='$current_password'";
			//execute th query
			$res = mysqli_query($conn, $sql);

			if ($res==true) {
				# code...
				//check whether data is available or not
				$count=mysqli_num_rows($res);
				if ($count==1) {
					# code...
					//user exists and password can be changed
					//echo "User Found";
					//check whether the new password and confirm password match or not
					if ($new_password==$confirm_password) {
						# code...
						//update password
						$sql2 = "UPDATE admin SET password='$new_password' WHERE id=$id";
						//execute the query
						$res2 = mysqli_query($conn, $sql2);
						//check whether the query executed or not
						if ($res2==true) {
							# code...
							//display success message
							//redirect to manage admin page with success message
							$_SESSION['change-pwd'] = "<div class='success'>Password Change Successfully.</div>";
							//redirect the user
							header('location:'.SITEURL. 'admin/manage-admin.php');
						}
						else
						{
							//display error message
							//redirect to manage admin page with success message
							$_SESSION['change-pwd'] = "<div class='error'>Failed to Change Password.</div>";
							//redirect the user
							header('location:'.SITEURL. 'admin/manage-admin.php');
						}

					}
					else
					{
						//redirect to manage admin page with error message
						$_SESSION['pwd-not-match'] = "<div class='error'>Password did not Match.</div>";
						//redirect the user
						header('location:'.SITEURL. 'admin/manage-admin.php');
					}
				}
				else
				{
					//user does not exist set message and redirect
					$_SESSION['user-not-found'] = "<div class='error'>User Not Found.</div>";
					//redirect the user
					header('location:'.SITEURL. 'admin/manage-admin.php');
				}
			}
			//check whether the new password and confirm password match or not
			//change password if all above is true  
		}
	?>
	<!--Footer Section Starts -->
	<div class="footer">
		<div class="wrapper">
			<p class="text-center">2020 All rights reserved, NSBM Cafetaria Website. Developed By - <a href="#"> Sulani Kularathna</a></p>
		</div>	
		
	</div>
	<!--Footer Section Ends -->
</body>
</html>
