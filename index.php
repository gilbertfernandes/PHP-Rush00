<?php
require "header.php";
?>

	<main>
		<div class="wrapper-main">
			<section class="section-default">
				<?php
				if (!isset($_GET["error"]))
				{
					if (isset($_GET['signup']))
					{
						if ($_GET['signup'] == "success") {
							echo '<p class="success">Signup successfull!</p>';
						}
					}
					if (isset($_SESSION['userId'])) {
						if ($_SESSION['userUid'] == "admin")
						{
							$_SESSION['ADMIN'] == true;
							echo '<form action="admin.php" method="POST">
								<button class="admin-btn" type="submit" name="admin-submit">Manage Server</button>
							</form>';
						}
					}
				} else
					echo '<p>' . $_GET["error"] . '</p>';
				require 'landing.php';
				?>
			</section>
		</div>
	</main>
	
<?php 
	require "footer.php";
?>