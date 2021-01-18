<?php include('../config/constants.php'); ?>

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
		<div clas="wrapper">
			<h1>Add Admin</h1>
			<br><br>
			<?php
				if (isset($_SESSION['add'])) //Checking whether the session is set or not
				{
					# code...
					echo $_SESSION['add'];//Display the session message if set
					unset($_SESSION['add']);//Remove sesssion message
				}
			?>
			<form action="" method="POST">
				<table class="tbl-30">
					<tr>
						<td>Name</td>
						<td>
							<input type="text" name="name" placeholder="Enter Your Name">
						</td>
					</tr>
					<tr>
						<td>Username</td>
						<td>
							<input type="text" name="username" placeholder="Your Username">
						</td>
					</tr>
					<tr>
						<td>Password</td>
						<td>
							<input type="password" name="password" placeholder="Your Password">
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Admin" class="btn-secondary">
						</td>
					</tr>

				</table>
			</form>

		</div>
	</div>
	<!--Footer Section Starts -->
	<div class="footer">
		<div class="wrapper">
			<p class="text-center">2020 All rights reserved, NSBM Cafetaria Website. Developed By - <a href="#"> Sulani Kularathna</a></p>
		</div>	
		
	</div>
	<!--Footer Section Ends -->
</body>
</html>

<?php
	//process the value from Form and save it in Database
	//Check whether the submit button is clicked or not
	if(isset($_POST['submit']))
	{
		//Button Clicked
		//echo "Button Clicked";
		//Get the data from form
		$name = $_POST['name'];
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		//SQL Query to save the data into database
		$sql = "INSERT INTO admin SET
			name = '$name',
			username = '$username',
			password = '$password'
		";

		// Executing query and saving data into database
		$res = mysqli_query($conn,$sql) or die(mysqli_error());
		//Check whether the query is executed) data is inserted or not and display appropiate message
		if ($res==TRUE) {
			//Data Inserted
			//echo "Data Inserted";
			//Create a session variable to display message
			$_SESSION['add']="<div class='success'>Admin Added Successfully</div>";
			//Redirect Page to manage admin
			header("location:".SITEURL.'admin/manage-admin.php');

		}
		else
		{
			//Failed to insert data
			//echo "Fail to Insert Data";
			//Create a session variable to display message
			$_SESSION['add']="<div class='error'>Fail to Add Admin</div>";
			//Redirect Page to add admin
			header("location:".SITEURL.'admin/manage-admin.php');

		}

	}
?>







