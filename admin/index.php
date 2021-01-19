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
			<h1>Dashboard</h1>
			<br><br>
			<?php
				if (isset($_SESSION['login'])) {
				 	# code...
				 	echo $_SESSION['login'];
				 	unset($_SESSION['login']);
				 } 
				 if (isset($_SESSION['no-login-message'])) {

				 	# code...
				 	echo $_SESSION['no-login-message'];
				 	unset($_SESSION['no-login-message']);
				 }
			?>
			<br><br>
			<div class="col-4 text-center">
				<h1>5</h1>
				<br>
				Categories
			</div>
			<div class="col-4 text-center">
				<h1>5</h1>
				<br>
				Categories
			</div>
			<div class="col-4 text-center">
				<h1>5</h1>
				<br>
				Categories
			</div>
			<div class="col-4 text-center">
				<h1>5</h1>
				<br>
				Categories
			</div>
			<div class="clearfix"></div>
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
