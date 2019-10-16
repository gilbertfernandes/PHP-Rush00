<?php
	require '../../dbh.inc.php';
	session_start();

if (isset($_POST['admin-item-insert']))
{

	$name = $_POST['name'];
	$price = $_POST['price'];
	$cat = $_POST['catagory'];
	$img =  $_FILES['file'];

	if (empty($img) || empty($cat) || empty($price) || empty($name))
	{
		header("Location: ../../../admin.php?error=Please ensure all fields are filled!");
		exit();
	}
	else
	{
		if ($img["size"] > (1024 * 1024))
		{
			header("Location: ../../../admin.php?error=Image is too big Ensure the image smaller than 1MB!");
			exit();
		}
		if ($img["error"])
		{
			header("Location: ../../../admin.php?error=A error occoured please try again later:" . $img["error"]);
			exit();
		}
		$img = explode(".", $_FILES['file']['name']);
		$ext = end($img);
		$file = "../../../image/" . uniqid() . "." . $ext;
		if (file_exists($file))
		{
			header("Location: ../../../admin.php?error=Uniqe id did not create a unique id please try again");
			exit();
		}
		$sql = "SELECT * FROM tbl_product WHERE `name`=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../../../internal_error.php");
			exit();
		}
		mysqli_stmt_bind_param($stmt, "s", $name);
		mysqli_stmt_execute($stmt);
		$result = mysqli_stmt_get_result($stmt);
		if (($row = mysqli_fetch_assoc($result)))
		{
			header("Location: ../../../admin.php?error=this item allready exists");
			exit();
		}
		else
		{
			if (move_uploaded_file($_FILES['file']['tmp_name'], $file))
			{
				$sql = "INSERT INTO `tbl_product` (`name`, `image`, `price`, `catagory` ) VALUES ( ?, ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location ../../../internal_error.php");
					exit();
				}
				else 
				{
					mysqli_stmt_bind_param($stmt, "ssds", $name, $file, $price, $cat);
					mysqli_stmt_execute($stmt);
					header("Location: ../../../admin.php?success=Itemadded Successfully!");
					exit();
				}
			}
			else
			{
				header("Location: ../../../admin.php?error=Uploading Image!");
				exit();
			}
		}
	}
}
else 
	header("Location: ../../../admin.php");
	exit();