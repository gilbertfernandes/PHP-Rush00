<!DOCTYPE HTML>

<html>
	<head>
	<meta charset="utf-8">
	<meta name=viewport content="width=device-width, initial-scale=1">
	<title></title>
<?php session_start();?>	
<!DOCTYPE HTLM>
	</head>
	<body>
		<header>
			<nav>
			<a href="#"><img src="../../img/logo.png" alt="logo"></a>
			<ul>
				<li><a href="../../index.php">Home</a></li>
				<li><a href="../../shop.php">Shop</a></li>
				<li><a href="../../about.php">About</a></li>
				<li><a href="../../cart.php">cart</a></li>
				<?php if (isset($_SESSION['userId'])) {
					echo '<form action="../../update.php" method="POST">
					<button type="submit" name="profile-submit">Profile</button>
					</form>';
				}
				?>
			</ul>
			<div>
			<?php if (!isset($_SESSION['userId'])) {
				echo '<form action="../includes/login.inc.php" method="POST">
					<input type="text" name="mailuid" placeholder="Username/ E-mail">
					<input type="password" name="pwd" placeholder="Password">
					<button type="submit" name="login-submit">Login</button>
				</form>
				<a href="../../signup.php">Signup</a>';
			} else {
				echo '<form action="../includes/logout.inc.php" method="POST">
					<button type="submit" name="logout-submit">Logout</button>
				</form>';
			}
			if (isset($_SESSION['userId']))
			{
					if ($_SESSION['userUid'] == "admin")
					{
						$_SESSION['ADMIN'] == true;
						echo '<form action="../../admin.php" method="POST">
							<button type="submit" name="admin-submit">Manage Server</button>
						</form>';
					}
			}
			?>
			</div>
			</nav>
		</header>