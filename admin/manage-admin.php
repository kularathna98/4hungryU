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

	<!--Main Content Section Starts -->	
	<div class="main-content">
		<div class="wrapper">
			<h1>Manage Admin</h1>
			<br><br>
			<?php
				if (isset($_SESSION['add'])) {
					# code...
					echo $_SESSION['add'];//Displaying session message
					unset( $_SESSION['add']);//Removing session message
				}
				if(isset($_SESSION['delete']))
				{
					echo $_SESSION['delete'];
					unset($_SESSION['delete']);
				}
				if (isset($_SESSION['update'])) {
					# code...
					echo $_SESSION['update'];
					unset($_SESSION['update']);
				}
				if (isset($_SESSION['user-not-found'])) {
					# code...
					echo $_SESSION['user-not-found'];
					unset($_SESSION['user-not-found']);
				}
				if (isset($_SESSION['pwd-not-match'])) {
					# code...
					echo $_SESSION['pwd-not-match'];
					unset($_SESSION['pwd-not-match']);
				}
				if (isset($_SESSION['change-pwd'])){
					# code...
					echo $_SESSION['change-pwd'];
					unset($_SESSION['change-pwd']);
				}
			?>
			<br><br><br>

			<!-- Button to Add Admin -->
			<a href="add-admin.php" class="btn-primary">Add Admin</a>
			<br><br><br>
			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Name</th>
					<th>Username</th>
					<th>Actions</th>
				</tr>
				<?php
					//Query to get all admin
					$sql="SELECT * FROM admin";
					//Execute the query
					$res=mysqli_query($conn,$sql);
					//Check whether the query is executed or not
					if ($res==TRUE) {
						# code...
						//Count rows to check whether we have data in database or not
						$count = mysqli_num_rows($res);//Function to get all the rows in database
						$sn=1; //Create a variable and assign the value
						//Check the num of rows
						if ($count>0) {
							# code...
							while ($rows=mysqli_fetch_assoc($res)) {
								# code...
								$id=$rows['id'];
								$name=$rows['name'];
								$username=$rows['username'];

								?>
								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $name; ?></td>
									<td><?php echo $username; ?></td>
									<td>
										<a href="<?php echo SITEURL; ?>admin/update-password.php?id=<?php echo $id; ?>" class="btn-primary">Change Password</a>
										<a href="<?php echo SITEURL; ?>admin/update-admin.php?id=<?php echo $id; ?>" class="btn-secondary">Update Admin</a>
										<a href="<?php echo SITEURL; ?>admin/delete-admin.php?id=<?php echo $id; ?>" class="btn-danger">Delete Admin</a>

									</td>
								</tr>
								<?php

							}
						}
						else
						{
							//we do not have data in database
						}
					}
				?>
				
				
			</table>
			
		</div>	
		
	</div>
	<!--Main content Section Ends -->
	<!--Footer Section Starts -->
	<div class="footer">
		<div class="wrapper">
			<p class="text-center">2020 All rights reserved, NSBM Cafetaria Website. Developed By - <a href="#"> Sulani Kularathna</a></p>
		</div>	
		
	</div>
	<!--Footer Section Ends -->
</body>
</html>
