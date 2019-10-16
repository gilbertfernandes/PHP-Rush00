<?php
require "header.php";

session_start();

if (isset($_GET['action']))
{
	if($_GET["action"] == "clear_cart")
	{
		foreach($_SESSION["shopping_cart"] as $keys => $values)
		{
				unset($_SESSION["shopping_cart"][$keys]);
				echo '<script>window.location="cart.php"</script>';
		}
		echo '<script>alert("cart cleared!")</script>';
	}
}


if (isset($_GET['remove']))
{
	if (isset($_SESSION["shopping_cart"][$_GET['remove']]))
	{
		if ($_SESSION["shopping_cart"][$_GET['remove']]['item_quantity'] > 1)
			$_SESSION["shopping_cart"][$_GET['remove']]['item_quantity']--;
	}
	else 
	{
		echo '<p class="error">Item not Found in cart</p>';
	}
}

if (isset($_GET['add']))
{
	if (isset($_SESSION["shopping_cart"][$_GET['add']]))
		$_SESSION["shopping_cart"][$_GET['add']]['item_quantity']++;
	else
	{
		echo '<p class="error">Item not Found in cart</p>';
	}
}


if (isset($_GET['error']))
{
	if ($_GET['error'] == "loginrequired") {
		echo '<p class="error">Please login to checkout your cart!</p>';
	}
}

?>

	<main>
		<div class="wrapper-main">
		<?php
		if (isset($_GET['checkout']))
		{
			if ($_GET['checkout'] == "success") {
				echo '<p class="success">Your order has been set!</p>';
			}
		}
		?>
			<section class="section-default">
				<h3 class="order">Order Details</h3>
			<div class="table-responsive">
				<table class="table table-bordered">
					<tr>
						<th width="40%">Item Name</th>
						<th width="10%">Quantity</th>
						<th width="20%">Price</th>
						<th width="15%">Total</th>
						<th width="5%">Action</th>
					</tr>
					<?php
					if(!empty($_SESSION["shopping_cart"]))
					{
						$total = 0;
						foreach($_SESSION["shopping_cart"] as $keys => $values)
						{
					?>
					<tr>
						<td><?php echo $values["item_name"]; ?></td>
						<td>
						<a href= "<?php echo 'cart.php?remove=' . $keys ?>"><</a>
							<?php echo $values["item_quantity"]; ?>
						<a href= "<?php echo 'cart.php?add=' . $keys ?>">></a>
						</td>
						<td>R <?php echo $values["item_price"]; ?></td>
						<td>R <?php echo number_format($values["item_quantity"] * $values["item_price"], 2);?></td>
						
						<td><a href="shop.php?action=delete&id=<?php echo $values["item_id"]; ?>"><span class="text-danger">Remove</span></a></td>
					</tr>
					<?php
							$total = $total + ($values["item_quantity"] * $values["item_price"]);
						}
					?>
					<tr>
						<td class="total" colspan="3">Total</td>
						<td class="total" >R <?php echo number_format($total, 2); ?></td>
						<td></td>
					</tr>
					<?php
					}
					?>
						
				</table>
				<?php
				if(!empty($_SESSION["shopping_cart"]))
				{
					echo '<button class="cart-btn" onclick="window.location.href=\'cart.php?action=clear_cart\'"><span>Clear Cart</span></button>
					<form action="/includes/order.inc.php" method="POST">
						<button class="checkout-btn" type="submit" name="order-submit" onclick="return confirm(\'Are you sure you want to checkout?\');">Checkout</button>
					</form>';
				}
				else
				{
					echo '<h1 class="cartempty" >Cart is empty</h1>';
				}
				?>
				
		</div>
		</section>
	</main>
	
<?php 
	require "footer.php";
?>