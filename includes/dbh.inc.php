<?php
	$db_server = "localhost";
	$db_username = "root";
	$db_password = "password";
	$db_Name = "db_rush00";

	$conn = mysqli_connect($db_server, $db_username, $db_password, $db_Name);

	if (!$conn) {
		die("Connection failed:" . mysqli_connect_error());
	}