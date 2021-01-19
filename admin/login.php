<?php include('../config/constants.php') ?>
<!DOCTYPE html>
<html>
<head>
	<title>Login-4hungryU</title>
	<link rel="stylesheet" type="text/css" href="../css/admin.css">
</head>
<body>
	<div class="login">
		<h1 class="text-center">Login</h1>
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
		<!--login form starts here -->
		<form action="" method="POST" class="text-center">
			Username:<br>
			<input type="text" name="username" placeholder="Enter Username"><br><br>
			Password:<br>
			<input type="password" name="password" placeholder="Enter password"><br><br>
			<input type="submit" name="submit" value="Login" class="btn-primary">
			<br><br>
		</form>
		<!--login form ends here -->
		<p class="text-center">Created By - <a href="wwww.sulanikularathna.com">Sulani Kularathna</a></p>
	</div>
</body>
</html>
<?php
	//check whether the submit button is clicked or not
	if(isset($_POST['submit']))
	{
		//process for login
		//get the data from login form
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		//sql to check whether the user with username and password exists or not
		$sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
		//execute the query
		$res = mysqli_query($conn,$sql);

		//count rows to check whether the user exists or not
		$count = mysqli_num_rows($res);
		if($count==1)
		{
			//user available and login success
			$_SESSION['login'] = "<div class='success'>Login Successfull.</div> ";
			$_SESSION['user'] = $username;//check whether the user is logged in or not and logout will unset it
			//redirect to homepage/dashboard
			header('location:' .SITEURL. 'admin/');
		}
		else
		{
			//user not available and login fail
			$_SESSION['login'] = "<div class='error text-center'>Username or Password did not match.</div> ";
			//redirect to homepage/dashboard
			header('location:' .SITEURL. 'admin/login.php');
		}
	} 
?>