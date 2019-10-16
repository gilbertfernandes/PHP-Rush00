<?php

	if (isset($_POST['admin-item-delete']))
	{
		require '../../dbh.inc.php';
		session_start();
		$name = $_POST['name'];
		$sql = "DELETE FROM tbl_product WHERE `name`=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../../../internal_error.php");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "s", $name);
			mysqli_stmt_execute($stmt);
			header("Location: ../../../admin.php?success=Removed item successfully");
			exit();
		}
	}
?>