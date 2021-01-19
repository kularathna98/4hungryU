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
			<h1>Manage Order</h1>
			
			<br><br><br>
			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Full Name</th>
					<th>Username</th>
					<th>Actions</th>
				</tr>
				
				<tr>
					<td>1.</td>
					<td>Sulani kularathna</td>
					<td>Sulani Kularathna</td>
					<td>
						<a href="#" class="btn-secondary">Update Admin</a>
						<a href="#" class="btn-danger">Delete Admin</a>
					</td>
				</tr>
				<tr>
					<td>2.</td>
					<td>Sulani kularathna</td>
					<td>Sulani Kularathna</td>
					<td>
						<a href="#" class="btn-secondary">Update Admin</a>
						<a href="#" class="btn-danger">Delete Admin</a>
					</td>
				</tr>
				<tr>
					<td>3.</td>
					<td>Sulani kularathna</td>
					<td>Sulani Kularathna</td>
					<td>
						<a href="#" class="btn-secondary">Update Admin</a>
						<a href="#" class="btn-danger">Delete Admin</a>
					</td>
				</tr>
			</table>
			
		</div>	
		
	</div>
	<!--Main content Section Ends -->
	<!--Footer Section Starts -->
	<div class="footer">
		<div class="wrapper">
			<p class="text-center">2020 All rights reserved, NSBM Cafetaria. Developed By - <a href="#"> Sulani Kularathna</a></p>
		</div>	
		
	</div>
	<!--Footer Section Ends -->
</body>
</html>
