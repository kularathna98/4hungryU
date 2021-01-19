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
			<h1>Manage Category</h1>
			<br><br>
			<?php
				if (isset($_SESSION['add'])) {
					# code...
					echo $_SESSION['add'];
					unset($_SESSION['add']);
				}
				if (isset($_SESSION['upload'])) {
					# code...
					echo $_SESSION['upload'];
					unset($_SESSION['upload']);
				}
			?>
			<br><br>
			<!-- Button to Add Admin -->
			<a href="<?php echo SITEURL; ?>admin/add-category.php" class="btn-primary">Add Category</a>
			<br><br><br>
			<table class="tbl-full">
				<tr>
					<th>S.N.</th>
					<th>Title</th>
					<th>Image</th>
					<th>Featured</th>
					<th>Active</th>
					<th>Actions</th>
				</tr>
				<?php
					//query to get all categories from database
					$sql = "SELECT * FROM category";
					//execute query
					$res = mysqli_query($conn,$sql);
					//count rows
					$count = mysqli_num_rows($res);
					//create serial number variable and assign value as 1
					$sn=1;
					//check whether we have data in database or not
					if ($count>0) {
						# code...
						//get the data and display
						while ($row=mysqli_fetch_assoc($res)) {
							# code...
							$id = $row['id'];
							$title = $row['title'];
							$image_name = $row['image_name'];
							$featured = $row['featured'];
							$active = $row['active'];

							?>
								<tr>
									<td><?php echo $sn++; ?></td>
									<td><?php echo $title; ?></td>
									<td>
										<?php
											 //check whether image name is available or not
											if($image_name !="")
											{
												?>
												<img src="<?php echo SITEURL; ?>images/category/<?php echo $image_name; ?>" width="100px">
												<?php
											}
											else
											{
												echo "<div class='error'>Image not Added.</div>";
											}
										?>
											
									</td>

									<td><?php echo $featured; ?></td>
									<td><?php echo $active; ?></td>
									<td>
										<a href="#" class="btn-secondary">Update Category</a>
										<a href="#" class="btn-danger">Delete Category</a>
									</td>
								</tr>
							<?php
						}
					}
					else
					{
						//display the message inside the table
						?>
						<tr>
							<td colspan="6">
								<div class="error">No Category Added.</div>
							</td>
						</tr>
						<?php
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
