<?php
	require "header.php";
?>

	<main>
		<div class="wrapper-main">
			<section class="section-default">
				<h1>Signup</h1>
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
				}
				?>
				<form action="includes/signup.inc.php" method="post">
					<input type="text" name="uid" placeholder="Username"  <?php 
					if (isset($_GET['uid']))
					{
						echo 'value="' . $_GET['uid'].'"';
					}
					?>>

					<input type="email" name="mail" placeholder="E-mail"  <?php 
					if (isset($_GET['mail']))
					{
						echo 'value="' . $_GET['mail'].'"';
					}
					?>>
					<input type= "password" name="pwd" placeholder="Password">
					<input type="password" name="pwd-repeat" placeholder="Repeat password">
					<button type="submit" name="signup-submit">Signup</button>
				</form>
			</section>
		</div>
	</main>

<?php
	require "footer.php";
?>