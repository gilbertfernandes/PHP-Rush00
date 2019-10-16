<?php
	require '../admin.nav.php';

	if (isset($_POST['admin-order-delete']))
	{
		require '../../dbh.inc.php';
		session_start();
		$orderid = $_POST['orderid'];
		$sql = "DELETE FROM ordered_items WHERE id=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../../../internal_error.php");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "i", $orderid);
			mysqli_stmt_execute($stmt);
			header("Location: ../../../admin.php?success=Removed orderid successfully");
			exit();
		}
	}

	if (isset($_POST['admin-order-delete-username']))
	{
		require '../../dbh.inc.php';
		session_start();
		$username = $_POST['orderer'];
		$sql = "DELETE FROM ordered_items WHERE orderer=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql))
		{
			header("Location: ../../../internal_error.php");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "s", $username);
			mysqli_stmt_execute($stmt);
			header("Location: ../../../admin.php?success=Removed users orders successfully");
			exit();
		}
	}
?>