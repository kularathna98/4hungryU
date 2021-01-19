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
			<h1>Manage Food</h1>
			<br><br>
			<!-- Button to Add Admin -->
			<a href="<?php echo SITEURL; ?>admin/add-food.php" class="btn-primary">Add Food</a>
			<br><br><br>
			<?php
				if (isset($_SESSION['add'])) {
					# code...
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}
			?>
			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Title</th>
					<th>Price</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>
				<?php
					//create a sql query to get all the food 
					$sql = "SELECT * FROM food";
					//execute the query
					$res = mysqli_query($conn,$sql);
					//count rows to check whether we have food or not
					$count = mysqli_num_rows($res);
					//create serial number variable and set default value as 1
					$sn=1;
					if ($count>0) {
						# code...
						//get the food from database and display
						while ($row=mysqli_fetch_assoc($res)) {
							# code...
							//get the values from individual columns
							$id = $row['id'];
							$title = $row['title'];
							$price = $row['price'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];
							?>
								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $title; ?></td>
									<td>Rs<?php echo $price; ?></td>
									<td>
										<?php
											//check whether we have image or not
											if ($image_name=="") {
												# code...
												echo "<div class='error'>Image not Added.</div>";
											}
											else
											{
												?>
												<img src="<?php echo SITEURL;?>images/food/<?php echo $image_name ?>" width="100px">
												<?php
											}
										?>
									</td>
									<td><?php echo $featured; ?></td>
									<td><?php echo $active; ?></td>
									<td>
										<a href="#" class="btn-secondary">Update Food</a>
										<a href="#" class="btn-danger">Delete Food</a>
									</td>
								</tr>
							<?php
						}
					}
					else
					{
						echo "<tr><td colspan='7' class='error'>Food not Added Yet.</td></tr>";
					}
				?>
				
				
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
