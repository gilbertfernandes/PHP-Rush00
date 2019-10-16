<?php

$servername = "localhost";
$username = "root";
$password = "password";

$conn = new mysqli($servername, $username, $password);
if ($conn->connect_error) {
	die("Connection failed: " . $conn->connect_error);
}

// Create database

$sql = "DROP DATABASE IF EXISTS db_rush00";
	if ($conn->query($sql) === TRUE) {
	echo "Database Droped successfully" . "<br/>";
	} else {
		echo "Error Dropping database: " . $conn->error . "<br/>";
 	}


$sql = "CREATE DATABASE IF NOT EXISTS db_rush00";
if ($conn->query($sql) === TRUE) {
	echo "Database created successfully" . "<br/>";
} else {
	echo "Error creating database: " . $conn->error . "<br/>";
}

$sql = "USE db_rush00;";
if ($conn->query($sql) === TRUE) {
	echo "Database connected successfully<br/>";
} else {
	echo "Error connecting database: " . $conn->error . "<br/>";
}

$sql = "CREATE TABLE IF NOT EXISTS users(
	idUsers int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	uidUsers TINYTEXT NOT NULL,
	emailUsers TINYTEXT NOT NULL,
	pwdUsers LONGTEXT NOT NULL
);";
if ($conn->query($sql) === TRUE) {
	echo "Table users created successfully<br/>";
} else {
	echo "Error creating users table: " . $conn->error . "<br/>";
}
// Create orders table

$sql = "CREATE TABLE IF NOT EXISTS ordered_items(
	id int(11) AUTO_INCREMENT PRIMARY KEY NOT NULL,
	orderer TINYTEXT NOT NULL,
	quantity int(255) NOT NULL,
	product_id int(255) NOT NULL
);";
if ($conn->query($sql) === TRUE) {
	echo "Table ordered_items created successfully<br/>";
} else {
	echo "Error creating ordered_items table: " . $conn->error . "<br/>";
}

// Create items table

$password = "admin";
$sql = 'INSERT INTO users SET uidUsers = "admin" , emailUsers= "admin@test.com", pwdUsers="' . password_hash($password, PASSWORD_DEFAULT) . '"';
if ($conn->query($sql) === TRUE) {
	echo "User Admin created successfully<br/>";
} else {
	echo "Error creaing admin user: " . $conn->error . "<br/>";
}

$sql = "CREATE TABLE IF NOT EXISTS `tbl_product` (
	`id` int(11) NOT NULL AUTO_INCREMENT,
	`name` varchar(255) NOT NULL,
	`image` varchar(255) NOT NULL,
	`price` double(10,2) NOT NULL,
	`catagory` varchar(255) NOT NULL,
	PRIMARY KEY (`id`)
)";
if ($conn->query($sql) === TRUE) {
	echo "Table products created successfully<br/>";
} else {
	echo "Error creating products table: " . $conn->error. "<br/>";
}

$sql = "INSERT INTO tbl_product (`id`, `name`, `image`, `price`, `catagory`) VALUES (NULL, 'item1', '/image/a.png', '10.50', 'Steve'), (NULL, 'item3', '/image/b.png', '12.00', 'Stan;Steve'), (NULL, 'item2', '/image/b.png', '12.00', 'Stan');";
if ($conn->query($sql) === TRUE) {
	echo "products added successfully<br/>";
} else {
	echo "Error adding products: " . $conn->error . "<br/>";
}

$conn->close();
?>
