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
				<form action="/?action=login" method="post" class="login-form">
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
						<a href="/?action=register">Registration here</a>
				</div>
			</div>
		</div>
	</section>
		

<?php
	include_once("../footer.php");
?>