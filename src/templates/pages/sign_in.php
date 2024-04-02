<?php 
  include_once("../header.php");
?>
	<h3>Sign in</h3>

	<form action="../../Controller/UserController.php" method="post">
	
	<input type="hidden" name="type" value="login">

		<label for="username"></label>
		<input type="text" id="username" name="username" placeholder="username"></br>
		<label for="password"></label>
		<input type="password" id="password" name="password" placeholder="password">

		<div class="remeber">
			<input type="checkbox"><label for="">Remeber me</label>
		</div>

		<div class="button">
			<button type="submit">Sign in</button>
		</div>

		<a href="register.php">Registration here</a>

	</form>

<?php
	include_once("../footer.php");
?>