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
				<li><a href="logout.php">Logout</a></li>
			</ul>
		</div>
	</div>
	<!-- Menu Section Ends -->
	<div class="main-content">
		<div class="wrapper">
			<h1>Add Category</h1>
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

			<!-- Add category form starts -->
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">
					<tr>
						<td>Title:</td>
						<td>
							<input type="text" name="title" placeholder="Category Title">
						</td>
					</tr>
					<tr>
						<td>Select Image:</td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>
					<tr>
						<td>Featured:</td>
						<td>
							<input type="radio" name="featured" value="Yes">Yes
							<input type="radio" name="featured" value="No">No
						</td>
					</tr>
					<tr>
						<td>Active:</td>
						<td>
							<input type="radio" name="active" value="Yes">Yes
							<input type="radio" name="active" value="No">No
						</td>
					</tr>
					<tr>
						<td colspan="2">
							<input type="submit" name="submit" value="Add Category" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
			<!-- Add category form ends -->
			<?php
				//check whether the submit button is clicked or not
				if (isset($_POST['submit'])) {
				 	# code...
				 	//echo "Clicked";
				 	//get the value from category form
				 	$title = $_POST['title'];
				 	//for radio input, we need to check whether the button is selected or not
				 	if (isset($_POST['featured'])) {
				 		# code...
				 		//get the value from form
				 		$featured = $_POST['featured'];
				 	}
				 	else
				 	{
				 		//set the default value
				 		$featured = "No";
				 	}
				 	if (isset($_POST['active'])) {
				 		# code...
				 		$active = $_POST['active'];
				 	}
				 	else
				 	{
				 		$active = "No";
				 	}
				 	//check whether the image is selected or not and set the value for image name accordingly
				 	//print_r($_FILES['image']);
				 	//die();//break the code here
				 	if (isset($_FILES['image']['name'])) {
				 		# code...
				 		//upload the image
				 		//to upload image we need image name, source path and destination path
				 		$image_name = $_FILES['image']['name'];
				 		//auto rename image
				 		//get the extension of the image (jpg,png, gif,etc)
				 		$ext = end(explode('.', $image_name));
				 		//rename the image
				 		$image_name = "Food_Category_".rand(000, 999).'.'.$ext;
				 		$source_path = $_FILES['image']['tmp_name'];
				 		$destination_path = "../images/category/".$image_name;
				 		//upload the image
				 		$upload = move_uploaded_file($source_path, $destination_path);
				 		//check whether the image uploaded or not and if the image is not uploaded then we will stop the process and redirect with error message
				 		if ($upload==false) {
				 			# code...
				 			//set message
				 			$_SESSION['upload'] = "<div class='error'>Failed to upload Image.</div>";
				 			//redirect to add category page
				 			header('location:'.SITEURL.'admin/add-category.php');
				 			//stop the process
				 			die();
				 		}
				 	}
				 	else
				 	{
				 		//don't upload the image and set the image_name value as blank
				 		$image_name = "";
				 	}


				 	//create sql query to insert category into database
				 	$sql = "INSERT INTO category SET title='$title', image_name='$image_name', featured='$featured', active='$active'";
				 	//execute the query and save in database
				 	$res = mysqli_query($conn, $sql);
				 	//check whwther the query executed or not
				 	if ($res==true) {
				 		# code...
				 		//query executed and category added
				 		$_SESSION['add'] = "<div class='success'>Category Added Successfully.</div>";
				 		//redirect to add category page
				 		header('location:'.SITEURL.'admin/manage-category.php');
				 	}
				 	else
				 	{
				 		//fail to add category
				 		$_SESSION['add'] = "<div class='error'>Failed to Add Category.</div>";
				 		//redirect to add category page
				 		header('location:'.SITEURL.'admin/add-category.php');
				 	}
				 } 
			?>
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