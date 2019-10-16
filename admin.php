<?php
	require 'header.php';
	require 'includes/dbh.inc.php';
?>
	<script>
	function ShowOrdersTable()
	{
		var x = document.getElementById("orders-table");
		if (x.style.display === "none")
		{
			x.style.display = "block";
			} 
			else {
				x.style.display = "none";
			}
	}
	</script>
	<?php
	if (isset($_GET['error']))
	{
		if ($_GET['error'] == "emptyfields") {
			echo '<p class="error">Please Fill in all fields!</p>';
		}
		else if ($_GET['error'] == "invaliduidmail") {
			echo '<p class="error">Invalid username or email entered!</p>';
		}
		else if ($_GET['error'] == "invaliduid") {
			echo '<p class="error">Invalid username!</p>';
		}
		else if ($_GET['error'] == "invalidmail") {
			echo '<p class="error">Invalid email!</p>';
		}
		else if ($_GET['error'] == "emailtaken") {
			echo '<p class="error">This E-mail is allready in use!</p>';
		}
		else if ($_GET['error'] == "passwordcheck") {
			echo '<p class="error">Passwords do not match!</p>';
		}
		else if ($_GET['error'] == "usertaken") {
			echo '<p class="error">Username is already taken!</p>';
		}
		else 
			echo '<p class="error">' . $_GET['error'] . '</p>';
	}
	if (isset($_GET['success']))
	{
		echo '<p class="sucess">' . $_GET['success'] . '</p>';
	}

	if (isset($_POST['admin-submit']))
	{
		session_start();
		
	?>

		<div class="container">

		<h1>Users</h1>
		<form action=<?php echo "./includes/admin/insert/user.php" ?> method="post">
				<input type="text" name="uid" placeholder="Username">
				<input type="email" name="mail" placeholder="E-mail">
				<input type= "password" name="pwd" placeholder="Password">
				<input type="password" name="pwd-repeat" placeholder="Repeat password">
			<button type="submit" name="admin-user-insert" >Insert</button>
		</form>

		<form action=<?php echo "./includes/admin/update/user.php" ?> method="post">
			<input type="text" name="uid" placeholder="Username">
			<input type="email" name="mail" placeholder="E-mail">
			<input type= "password" name="pwd" placeholder="Password">
			<input type="password" name="pwd-repeat" placeholder="Repeat password">
			<button type="submit" name="admin-user-update" >Update</button>
		</form>

		<form action=<?php echo "./includes/admin/delete/user.php" ?> method="post" onSubmit="return confirm('Are you sure you want to delete this account?')">
				<input type="text" name="uid" value="" placeholder="Username">
			<button type="submit" name="admin-user-delete" >Delete</button>
		</form>
		</div>

		<div class="container">
		<h1>Orders</h1>
		<button onclick="ShowOrdersTable()">Orders</button>
		
		<table id="orders-table" border="1" style="display:none">
			<tr>
				<th>Id</th>
				<th>Orderer</th>
				<th>Quantity</th>
				<th>Product id</th>
			</tr>
			<?php
			$sql = "SELECT * FROM ordered_items";
			$result = $conn->query($sql);
			if ($result->num_rows > 0) {
				 while($row = $result->fetch_assoc()) {
					echo	'<tr><td>' . $row["id"] . '</td>' .
						'<td>' . $row["orderer"] . '</td>' .
						'<td>' . $row["quantity"] . '</td>' .
						'<td>' . $row["product_id"] . '</td></tr>';
				 }
			}
			?>
		</table>

		<form action=<?php echo "./includes/admin/insert/order.php" ?> method="post">
		<!-- set orderer , quantity, productid -->
			<input type="text" name="orderer" placeholder="Orderer">
			<input type="number" name="quantity" min="1" value="" placeholder="quantity" class="form-control" />
			<input type="number" name="productid" min="0" value="" placeholder="productid" class="form-control" />
			<button type="submit" name="admin-order-insert" >Insert</button>
		</form>

		<form action=<?php echo "./includes/admin/update/order.php" ?> method="post">
			<input type="text" name="orderer" placeholder="Orderer">
			<input type="number" name="quantity" min="1" max="100" value="" class="form-control" placeholder="quantity"/>
			<input type="number" name="orderid" min="0" value="" class="form-control" placeholder="orderid"/>
			<input type="number" name="productid" min="0" value="" class="form-control" placeholder="productid"/>
			<button type="submit" name="admin-order-update" >Update</button>
		<!-- change orderer, quantity, productid -->
		</form>

			<!-- Delete Order -->
		<form action=<?php echo "./includes/admin/delete/order.php" ?> method="post">
			<input type="number" name="orderid" min="0" placeholder="Orderid">
			<button type="submit" name="admin-order-delete" >Delete Order by id</button>
		</form>
		<form action=<?php echo "./includes/admin/delete/order.php" ?> method="post">
			<input type="text" name="orderer" placeholder="Orderer">
			<button type="submit" name="admin-order-delete-username" >Delete Users orders</button>
		</form>
		</div>




		<div class="container">
		<h1>Items</h1>
		<!-- set name image(save) price catagory-->
		<form action=<?php echo "./includes/admin/insert/item.php" ?> enctype="multipart/form-data" method="post">
			<input type="text" name="name" placeholder="Product Name" />
			<input type="file" name="file" accept=".jpg, .jpeg, .png">
			<input type="number" min="1" step="any" name="price" placeholder="Price">
			<input type="text" name="catagory" placeholder="Catagory">
			<button type="submit" name="admin-item-insert" >Insert</button>
		</form>
		

		<!-- edit image(save) price catagory-->
		<form action=<?php echo "./includes/admin/update/item.php" ?> enctype="multipart/form-data" method="post">
			<input type="text" name="name" placeholder="Product Name" />
			<input type="file" name="file-update" accept=".jpg, .jpeg, .png">
			<input type="number" min="1" step="any" name="price" placeholder="Price">
			<input type="text" name="catagory" placeholder="Catagory">
			<button type="submit" name="admin-item-update" >Update</button>
		</form>
		
		
		
		<!-- delete item-->
		<form action=<?php echo "./includes/admin/delete/item.php" ?> method="post">
			<input type="text" name="name" placeholder="Name">
			<button type="submit" name="admin-item-delete" >Delete</button>
		</form>
		</div>
	<?php	
	}

	require 'footer.php';
?>