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
			<h1>Update Category</h1>
			<br><br>
			<?php
				//check whether the id is set or not
				if (isset($_GET['id'])) {
					# code...
					//get the id and all other details
					//echo "Getting the data";
					$id = $_GET['id'];
					//create sql query to get all other details
					$sql = "SELECT * FROM category WHERE id=$id";
					//execute the query
					$res = mysqli_query($conn,$sql);
					//count the rows to check whether the id is valid or not
					$count = mysqli_num_rows($res);
					if ($count==1) {
						# code...
						//get all the data
						$row = mysqli_fetch_assoc($res);
						$title = $row['title'];
						$current_image = $row['image_name'];
						$featured = $row['featured'];
						$active = $row['active'];

					}
					else
					{
						//redirect to manage category with session message
						$_SESSION['no-category-found'] = "<div class='error'>Category not Found.</div>";
						header('location:'.SITEURL.'admin/manage-category.php');
					}

				}
				else
				{
					//redirect to mange category
					header('location:'.SITEURL.'admin/manage-category.php');
				}
			?>

			<form action="" method="POST" enctype="multipart/form-data">
			<table class="tbl-30">
				<tr>
					<td>Title:</td>
					<td>
						<input type="text" name="title" value="<?php echo $title; ?>">
					</td>
				</tr>
				<tr>
					<td>Current Image:</td>
					<td>
						<?php
							if ($current_image != "") {
								# code...
								//display the image
								?>
								<img src="<?php echo SITEURL; ?>images/category/<?php echo $current_image; ?>" width="150px">
								<?php
							}
							else
							{
								//display message
								echo "<div class='error'>Image Not Added.</div>";
							}
						?>
					</td>
				</tr>
				<tr>
					<td>New Image:</td>
					<td>
						<input type="file" name="image">
					</td>
				</tr>
				<tr>
					<td>Featured:</td>
					<td>
						<input <?php if($featured=="Yes"){ echo "checked";} ?> type="radio" name="featured" value="Yes">Yes
						<input <?php if($featured=="No"){ echo "checked";} ?> type="radio" name="featured" value="No">No
					</td>
				</tr>
				<tr>
					<td>Active:</td>
					<td>
						<input  <?php if($active=="Yes"){ echo "checked";} ?> type="radio" name="active" value="Yes">Yes
						<input  <?php if($active=="No"){ echo "checked";} ?> type="radio" name="active" value="No">No
					</td>
				</tr>
				<tr>
					<td>
						<input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
						<input type="hidden" name="id" value="<?php echo $id; ?>">
						<input type="submit" name="submit" value="Update Category" class="btn-secondary">
					</td>
				</tr>
			</table>
		</form>
		<?php
			if (isset($_POST['submit'])) {
				# code...
				//echo "Clicked";
				//get all values from form
				$id = $_POST['id'];
				$title = $_POST['title'];
				$current_image = $_POST['current_image'];
				$featured = $_POST['featured'];
				$active = $_POST['active'];
				//update new image if selected
				//check whether the image is selected or not
				if (isset($_FILES['image']['name'])) {
					# code...
					//get the image details
					$image_name = $_FILES['image']['name'];

					//check whether the image is available or not
					if ($image_name != "") {
						# code...
						//image available
						//upload the new image

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
					 			header('location:'.SITEURL.'admin/manage-category.php');
					 			//stop the process
					 			die();
					 		} 
						//remove the current image if available
					 	if ($current_image !="") {
					 		# code...
						 	$remove_path = "../images/category/".$current_image;

						 	$remove = unlink($remove_path);
						 	//check whether the image is removed or not
						 	//if failed to remove then display message and stop the process
						 	if ($remove==false) {
						 		# code...
						 		//failed to remove image
						 		$_SESSION['failed-remove'] = "<div class='error'>Failed to remove current Image.</div>";
						 		header('location:'.SITEURL.'admin/manage-category.php');
						 		die();//stop the process
						 	}
					 	}
					 	
					}
					else
					{
						$image_name = $current_image;
					}
				}
				else
				{
					$image_name = $current_image;
				}
				//update the database
				$sql2 = "UPDATE category SET title ='$title', image_name='$image_name', featured='$featured', active='$active' WHERE id=$id";
				//execute the query
				$res2 = mysqli_query($conn, $sql2);
				//redirect to manage category with message
				//check whether executed or not
				if ($res2==true) {
					# code...
					//categroy updated
					$_SESSION['update'] = "<div class='success'>Category Updated Successfully.</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}
				else
				{
					$_SESSION['update'] = "<div class='error'>Failed to Update category.</div>";
					header('location:'.SITEURL.'admin/manage-category.php');
				}
				
			}
		?>
	</div>
	</div>
	<!--Footer Section Starts -->
	<div class="footer">
		<div class="wrapper">
			<p class="text-center">2020 All rights reserved, NSBM Cafetaria. Developed By - <a href="#"> Sulani Kularathna</a></p>
		</div>	
		
	</div>
	<!--Footer Section Ends -->
</body>
</html>
