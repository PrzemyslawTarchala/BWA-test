<?php 
  include_once("../header.php");
	include_once("../../Auxiliary/Auxiliary.php");
	use App\Auxiliary\Auxiliary;
?>

	<section class="login-register">

		<div class="message-window">
				<?php Auxiliary::display()?>
		</div>
		
		<div class="input-window">

			<div class="logo-section">
				<img src="/img/logo.png" alt="">
				<h2>Budget App</h2>
			</div>
			<div class="input-section">
				<form action="/?action=register" method="post" class="login-form">
					
				<label for="newUsername"></label>
					<input type="text" id="newUsername" name="newUsername" placeholder="Enter username"></br>
					<label for="newEmail"></label>
					<input type="text" id="newEmail" name="newEmail" placeholder="Enter email"></br>
					<label for="password"></label>
					<input type="password" id="password" name="password" placeholder="Enter password"></br>
					<label for="confirmPassword"></label>
					<input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirm password"></br>
					<div class="button">
						<button type="submit">Register</button>
					</div>
				</form>
				<div>
						<a href="/?action=login">Sign in</a>
				</div>
			</div>
		</div>
	</section>

<?php
	include_once("../footer.php");
?>