<?php
	if (isset($_POST['order-submit']))
	{
		require 'dbh.inc.php';
		session_start();
		if (isset($_SESSION['userUid']))
		{
			foreach($_SESSION["shopping_cart"] as $keys => $values)
			{
				$sql = "INSERT INTO `ordered_items` ( `orderer`, `quantity`, `product_id`) VALUES ( ?, ?, ?);";
				$stmt = mysqli_stmt_init($conn);
				if (!mysqli_stmt_prepare($stmt, $sql))
				{
					header("Location ../internal_error.php");
					exit();
				}
				else {
					$orderer = $_SESSION['userUid'];
					$product_id = $values['item_id'];
					$quantity = $values['item_quantity'];
					mysqli_stmt_bind_param($stmt, "sii", $orderer, $quantity, $product_id);
					mysqli_stmt_execute($stmt);
				}
			}
			header("Location: ../cart.php?action=clear_cart&checkout=success");
			exit();
		}
		else
		{
			header("Location: ../cart.php?error=loginrequired");
			exit();
		}
	}
	else
	{
		header("Location: ../cart.php");
		exit();
	}