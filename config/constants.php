<?php
		 
	//Start Session
	session_start();

	//Create Constants to store non repeating values
	define('SITEURL', 'http://localhost/4hungryU/');
	define('LOCALHOST', 'localhost');
	define('DB_USERNAME', 'root');
	define('DB_PASSWORD', '');
	define('DB_NAME', '4hungryU');


	$conn = mysqli_connect(LOCALHOST, DB_USERNAME, DB_PASSWORD) or die(mysql_error()); // Database Connection
	$db_select = mysqli_select_db($conn, DB_NAME) or die(mysql_error()); //Selecting database


?>