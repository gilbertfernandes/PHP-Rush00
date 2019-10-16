<?php
	session_start();
	if (isset($_POST['profile-submit']))
	{
		require 'includes/dbh.inc.php';
		
		$username = $_SESSION['userUid'];
		
		$sql = "SELECT * FROM users WHERE uidUsers=? OR emailUsers=?;";
		$stmt = mysqli_stmt_init($conn);
		if (!mysqli_stmt_prepare($stmt, $sql)){
			header("Location: internal_error.php");
			exit();
		}
		else {
			mysqli_stmt_bind_param($stmt, "ss", $username, $username);
				mysqli_stmt_execute($stmt);
				$result = mysqli_stmt_get_result($stmt);
				if ($row = mysqli_fetch_assoc($result)) {
					require "header.php";
					?>
					<!-- UPDATE FORM  -->
						<main>
							<div class="wrapper-main">
								<section class="section-default">
									<h1>Profile</h1>
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
										else if ($_GET['error'] == "passwordcheck") {
											echo '<p class="error">Passwords do not match!</p>';
										}
										else if ($_GET['error'] == "usertaken") {
											echo '<p class="error">Username is already taken!</p>';
										}

									}
									?>
									<form action="includes/update.inc.php" method="post">
										<?php
											echo '<h1>' . $row['uidUsers'] .'</h1>';
										?>
										<input type="hidden" name="uid" <?php echo "value= \"" . $row['uidUsers'] . "\""; ?> >
										<input type="email" name="mail" placeholder="E-mail"
											<?php 
												if (isset($_GET['mail']))
												{
													echo 'value="' . $_GET['mail'].'"';
												}
												else
												{
													echo 'value="' . $row['emailUsers'] .'"';
												}
											?>>
										<input type= "password" name="pwd" placeholder="Password">
										<input type="password" name="pwd-repeat" placeholder="Repeat password">
										<button type="submit" name="update-submit">update</button>
										
									</form>
									<!-- Delete item -->
									<form action="includes/delete.inc.php" method="post" onSubmit="return confirm('Are you sure you want to delete your accopunt?')">
										<input type="hidden" name="uid" <?php echo "value= \"" . $row['uidUsers'] . "\""; ?> >
										<button type="submit" name="delete-submit">Delete</button>
									</form>
								</section>
							</div>
						</main>
					<?php
						require "footer.php";
				// END FORM 
			}
			else 
			{
				header("Location: ../internal_error.php");
				exit();
			}
		}
	}
	else
	{
		header("Location: ../index.php");
		exit();
	}

?>
