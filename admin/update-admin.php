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
			</ul>
		</div>
	</div>
	<!-- Menu Section Ends -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Update Admin</h1>
			<br><br>
			<?php
				include('../config/constants.php');
				// Get the id of selected admin
				$id = $_GET['id'];
				// Create sql query to get the details
				$sql = "SELECT * FROM admin WHERE id=$id";
				//Execute the query
				$res = mysqli_query($conn, $sql);
				//Check whether the query is executed or not
				if ($res==true) {
					//Check whether the data is available or not
					# code...
					$count = mysqli_num_rows($res);
					//Check whether we have admin data or not
					if($count == 1)
					{
						//Get the details
						//echo "Admin Available";
						$row = mysqli_fetch_assoc($res);
						$name = $row['name'];
						$username = $row['username'];
					}
					else
					{
						//redirect to manage admin page
						header("location:".SITEURL.'admin/manage-admin.php');
					}

				}
			?>

			<form action="" method="POST">
				<table class="tbl-30">
					<tr>
						<td>Name:</td>
						<td>
							<input type="text" name="name" value="<?php echo $name; ?>">
						</td>
					</tr>
					<tr>
						<td>Username:</td>
						<td>
							<input type="text" name="username" value="<?php echo $username; ?>">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="hidden" name="id" value="<?php echo $id; ?>">
							<input type="submit" name="submit" value="Update Admin" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
		</div>
	</div>
	<?php 
		//check whether the submit button is clicked or not 
		if (isset($_POST['submit'])) {
			# code...
			//echo "Button Clicked";
			//get all values from form to update
			$id = $_POST['id'];
			$name = $_POST['name'];
			$username = $_POST['username'];
			//create a sql query to update admin
			$sql = "UPDATE admin SET
			name = '$name',
			username = '$username'
			WHERE id = '$id'
			";
			//execute the query
			$res = mysqli_query($conn, $sql);
			//check whether the query executed successfully or not 
			if($res==true)
			{
				//Query executed and admin updated
				$_SESSION['update'] = "<div class='success'>Admin Updated Successfully.</div>";
				//redirect to manage admin page
				header('location:'.SITEURL.'admin/manage-admin.php');
			}
			else
			{
				//failed to update admin
				$_SESSION['update'] = "<div class='error'>Failed to Delete Admin.</div>";
				//redirect to manage admin page
				header('location:'.SITEURL.'admin/manage-admin.php');
			}
		}
	?>
	<!--Footer Section Starts -->
	<div class="footer">
		<div class="wrapper">
			<p class="text-center">2020 All rights reserved, NSBM Cafetaria. Developed By - <a href="#"> Sulani Kularathna</a></p>
		</div>	
		
	</div>
	<!--Footer Section Ends -->
</body>
</html>
