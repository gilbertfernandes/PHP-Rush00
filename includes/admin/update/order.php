<?php
if (isset($_POST['admin-order-update']))
{
	require '../../dbh.inc.php';
	
	$orderer = $_POST['orderer'];
	$orderid = $_POST['orderid'];
	$quantity = $_POST['quantity'];
	$productid = $_POST['productid'];
	if (empty($orderer) || empty($quantity) || empty($productid) || empty($orderid)) {
		header("Location: ../../../admin.php?error=emptyfields");
		exit();
	}
	else if (!preg_match("/^[a-zA-Z0-9]*$/", $orderer)) {
		header("Location: ../../../admin.php?error=invalid Orderer");
		exit();
	}
	else
	{
		$sql = "SELECT uidUsers FROM users WHERE uidUsers=?";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)) {
			header("Location: ../../../internal_error.php");
			exit();
		}
		else
		{
			mysqli_stmt_bind_param($stmt, "s", $orderer);
			mysqli_stmt_execute($stmt);
			mysqli_stmt_store_result($stmt);
			$resultCheck = mysqli_stmt_num_rows($stmt);
			if ($resultCheck != 1) {
				header("Location: ../../../admin.php?error=Invalid Orderer");
				exit();
			}
			else
			{
				$sql = "SELECT id FROM ordered_items WHERE id=?";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql)) {
					header("Location: ../../../internal_error.php");
					exit();
				}
				else
				{
					mysqli_stmt_bind_param($stmt, "i", $orderid);
					mysqli_stmt_execute($stmt);
					mysqli_stmt_store_result($stmt);
					$resultCheck = mysqli_stmt_num_rows($stmt);
					if ($resultCheck != 1) {
						header("Location: ../../../admin.php?error=Invalid Orderid");
						exit();
					}
					$sql = 'UPDATE `ordered_items` SET orderer = ?, quantity=?, product_id= ? WHERE id = ?';
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql)) {
						header("Location ../../../internal_error.php");
						exit();
					}
					else {
						$hashedPwd = password_hash($password, PASSWORD_DEFAULT);
						mysqli_stmt_bind_param($stmt, "siii", $orderer, $quantity, $productid, $orderid);
						mysqli_stmt_execute($stmt);
						header("Location: ../../../admin.php?success=Order updated Successfully");
						exit();
					}
				}
			}
		}
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	}
}
else 
{
	header("Location: ../../../admin.php");
	exit();
}