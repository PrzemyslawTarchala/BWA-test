<?php 
  include_once("../header.php");
?>
	<h3>Register</h3>

	<form action="../../Controller/UserController.php" method="post" class="login-form">
		
	<input type="hidden" name="type" value="register">

		<label for="newUsername"></label>
		<input type="text" id="newUsername" name="newUsername" placeholder="Enter username"></br>
		<label for="newEmail"></label>
		<input type="text" id="newEmail" name="newEmail" placeholder="Enter email"></br>
		<label for="password"></label>
		<input type="text" id="password" name="password" placeholder="Enter password"></br>
		<label for="confirmPassword"></label>
		<input type="text" id="confirmPassword" name="confirmPassword" placeholder="Confirm password"></br>
		
		<div class="button">
			<button type="submit">Register</button>
		</div>

	</form>

<a href="sign_in.php">Sign in</a>

<?php
	include_once("../footer.php");
?>