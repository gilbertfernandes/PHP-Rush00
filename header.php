<!DOCTYPE HTML>

<html>
	<head>
	<meta charset="utf-8">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<title>G & R Apothecary</title>
<?php session_start(); ?>	
<!DOCTYPE HTLM>
	</head>
	<link rel= "stylesheet" href="css/main.css">
	<link rel= "stylesheet" href="css/forms.css">
	<link rel= "stylesheet" href="css/slide.css">
	<body>
		<header>
			<div class="header">
			<a href="index.php"><img class="logo" src="image/Navlogo.png" alt="Logo"></a>
			<nav class="nav_bar">
				<a href="index.php">Home</a>
				<a href="shop.php">Shop</a>
				<a href="about.php">About</a>
				<a href="cart.php">Cart</a>	
			<div class="login">
			<?php if (isset($_SESSION['userId'])) {
					echo '<form action="update.php" method="POST">
					<button class="profile-btn" type="submit" name="profile-submit">Profile</button>
					</form>';
				}
				?>
			<?php if (!isset($_SESSION['userId'])) {
				echo '<a class="signup" href="signup.php">Signup</a><form action="includes/login.inc.php" method="POST">
					<input type="text" name="mailuid" placeholder="Username/ E-mail">
					<input type="password" name="pwd" placeholder="Password">
					<button type="submit" name="login-submit">Login</button>
				</form>';
			} else {
				echo '<form action="includes/logout.inc.php" method="POST">
					<button class="logout-btn" type="submit" name="logout-submit">Logout</button>
				</form>';
			}
			?>
			</div>
			</nav>
		</header>
	</body>