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
			<h1>Add Food</h1>
			<br><br>
			<?php
				if (isset($_SESSION['upload'])) {
					# code...
					echo $_SESSION['upload'];
					unset($_SESSION['upload']);
				}
			?>
			<form action="" method="POST" enctype="multipart/form-data">
				<table class="tbl-30">
					<tr>
						<td>Title:</td>
						<td>
							<input type="text" name="title" placeholder="Title Of the Food">
						</td>
					</tr>
					<tr>
						<td>Description:</td>
						<td>
							<textarea name="description" cols="30" rows="5" placeholder="Description of the Food"></textarea>
						</td>
					</tr>
					<tr>
						<td>Price:</td>
						<td>
							<input type="number" name="price">
						</td>
					</tr>
					<tr>
						<td><pre>Select Image:</pre></td>
						<td>
							<input type="file" name="image">
						</td>
					</tr>
					<tr>
						<td>Category:</td>
						<td>
							<select name="category">
								<?php 
									//create php code to display category from database
									//create sql to get all active categories from database
									$sql = "SELECT * FROM category WHERE active='Yes'";
									//executing query
									$res = mysqli_query($conn,$sql);
									//count rows to check whether we have categories or not
									$count = mysqli_num_rows($res);
									//if count is greater then zero, we have categories else we don't have categories
									if ($count>0) {
										# code...
										while ($row=mysqli_fetch_assoc($res)) {
											# code...
											//get the details of categories
											$id = $row['id'];
											$title = $row['title'];
											?>
											<option value="<?php echo $id; ?>"><?php echo $title; ?></option>
											<?php
										}
									}
									else
									{
										?>
										<option value="0">No Category Found</option>
										<?php
									}
									//display an dropdown
								?>
							
							</select>
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
							<input type="submit" name="submit" value="Add Food" class="btn-secondary">
						</td>
					</tr>
				</table>
			</form>
			<?php
				//check whether the button is clicked or not
				if (isset($_POST['submit'])) {
					# code...
					//add the food in database
					//echo "Clicked";
					//get the data from form
					$title = $_POST['title'];
					$description = $_POST['description'];
					$price = $_POST['price'];
					$category = $_POST['category'];
					//check whether radio button for featured and active are checked or not
					if (isset($_POST['featured'])) {
						# code...
						$featured = $_POST['featured'];
					}
					else
					{
						$featured = "No";//settingdefault value
					}
					if (isset($_POST['active'])) {
						# code...
						$active = $_POST['active'];
					}
					else
					{
						$active = "No";//setting default value
					}
					//upload the image if selected
					//check whether the select image is clicked or not and upload the image only if the image is selected
					if (isset($_FILES['image']['name'])) {
						# code...
						//get the details of the selected image 
						$image_name = $_FILES['image']['name'];
						//check whether the image is selected or not and upload image only if selected
						if ($image_name !="") {
							# code...
							//image is selected
							//rename the image 
							//get the exiension of selected image
							$ext = end(explode('.', $image_name));
							//create new name for image
							$image_name = "Food-Name-".rand(0000,9999).".".$ext;
							//upload the image
							//get the src path and destination path
							//source path is the current location of the image
							$src = $_FILES['image']['tmp_name'];
							//destination path for the image to be uploaded
							$dst = "../images/food/".$image_name;
							//upload the food image
							$upload = move_uploaded_file($src, $dst);
							//check whether the image uploaded or not
							if($upload==false)
							{
								//failed to upload the image
								//redirect to add food page with error message
								$_SESSION['upload'] = "<div class'error'>Failed to Upload Image</div>";
								header('location:'.SITEURL.'admin/add-food.php');
								//stop the process
								die();
							}

						}
					}
					else
					{
						$image_name="";//setting default value as null
					}
					//insert into database
					//sql query to save or add food 
					$sql2 = "INSERT INTO food SET title = '$title', description ='$description', price = $price, image_name = '$image_name', category_id = $category, featured = '$featured', active= '$active' ";
					//execute the query
					$res2 = mysqli_query($conn,$sql2);
					//check whether the data inserted or not
					if ($res2 == true) {
						# code...
						//data inserted successfully
						$_SESSION['add']="<div class='success'>Food Added Successfully.</div>";
						header('location:'.SITEURL.'admin/manage-food.php');
					}
					else
					{
						//failed to insert data
						$_SESSION['add']="<div class='error'>Failed to Add Food.</div>";
						header('location:'.SITEURL.'admin/manage-food.php');
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
