<?php 
	include_once("../header.php");
	include_once("../../Auxiliary/Auxiliary.php");
?>
	
	<section class="login-register">

		<div class="message-window">
			<?php AuxiliaryMethod::display()?>
		</div>
		
		<div class="input-window">

			<div class="logo-section">
				<img src="/img/logo.png" alt="">
				<h2>Budget App</h2>
			</div>

			<div class="input-section">

				<form action="../../Controller/UserController.php" method="post" class="login-form">
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
				</form>
				
				<div>
						<a href="register.php">Registration here</a>
				</div>

			</div>
		</div>
	</section>
		

<?php
	include_once("../footer.php");
?>