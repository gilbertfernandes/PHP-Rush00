<?php

	if (isset($_POST['admin-order-insert']))
	{
		$user = $_POST['orderer'];
		$itemid = $_POST['productid'];
		$quantity = $_POST['quantity'];

		echo $user;
		echo $itemid;
		echo $quantity;

		if (empty($user) || empty($itemid) || empty($quantity))
		{
			header("Location: ../../../admin.php?error=emptyfields");
			exit();
		}
		require '../../dbh.inc.php';
		session_start();
			$sql = "SELECT * FROM users WHERE uidUsers=?";
			$stmt = mysqli_stmt_init($conn);
			if (!mysqli_stmt_prepare($stmt, $sql))
			{
				header("Location: ../../../internal_error.php");
				exit();
			}
			mysqli_stmt_bind_param($stmt, "s", $user);
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt);
			if (!($row = mysqli_fetch_assoc($result)))
			{
				header("Location: ../../../admin.php?error=nouser");
				exit();
			}
			else {
				$sql = "SELECT * FROM tbl_product WHERE id=?";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location: ../../../internal_error.php");
					exit();
				}
				else {
					mysqli_stmt_bind_param($stmt, "s", $itemid);
					mysqli_stmt_execute($stmt);
					$result = mysqli_stmt_get_result($stmt);
					if (!($row = mysqli_fetch_assoc($result)))
					{
						header("Location: ../../../admin.php?error=No item with that id!");
						exit();
					}
					$sql = "INSERT INTO `ordered_items` ( `orderer`, `quantity`, `product_id`) VALUES ( ?, ?, ?);";
					$stmt = mysqli_stmt_init($conn);
					if (!mysqli_stmt_prepare($stmt, $sql))
					{
						header("Location ../../../internal_error.php");
						exit();
					}
					else
					{
						$orderer = $user;
						$product_id = $itemid;
						$quantity = $quantity;
						mysqli_stmt_bind_param($stmt, "sii", $orderer, $quantity, $product_id);
						mysqli_stmt_execute($stmt);
					}
				}
				
			}
				header("Location: ../../../admin.php?success=Item added!");
				exit();
	}
	else
	{
		header("Location: ../../../admin.php");
		exit();
	}