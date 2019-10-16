<?php
	require '../admin.nav.php';

	if (isset($_POST['admin-user-delete']))
	{
		require '../../dbh.inc.php';
		session_start();
		$username = $_POST['uid'];
		$sql = "DELETE FROM users WHERE uidUsers=?";
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
			header("Location: ../../../admin.php?success=Deleted user successfully");
			exit();
		}
	}
?>