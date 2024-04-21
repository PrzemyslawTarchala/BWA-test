<?php
	include_once("../header.php");
?>

<section class="revenue-page">
	<div class="page-content">
		
		<div class="theme">
			<div class="text">
				<h2>Add Revenue</h2>
			</div>
		</div>
		
		<div class="revenue-data">
			<form action="" class="form">
					<div class="amount">
						<div class="header">
							<h3>Amount</h3>
						</div>
						<div class="input">
							<div class="text">
								<span>Enter the amount:</span>
							</div>
							<div>
								<input type="float" placeholder="$">
							</div>
						</div>
					</div>

					<div class="date">
						<div class="header">
							<h3>Date</h3>
						</div>
						<div class="input">
							<div class="text">
								<span>Enter the amount:</span>
							</div>
							<div>
								<input type="date">
							</div>
						</div>
					</div>

					<div class="category">
						<div class="header">
							<h3>Category</h3>
						</div>
						<div class="input">
							<div class="text">
								<span>Choose category: </span>
							</div>
							<ul>
								<li><input type="radio" id="" name="Salary" value=""> Salary</li>
								<li><input type="radio" id="" name="Salary" value=""> Bank interest</li>
								<li><input type="radio" id="" name="Salary" value=""> Allegro</li>
								<li><input type="radio" id="" name="Salary" value=""> Other</li>
							</ul>
						</div>
					</div>

					<div class="comment">
						<div class="header">
							<h3>Comment</h3>
						</div>
						<div class="input">
							<textarea name="comment" id="comment" cols="30" rows="10" placeholder="Put some comment here ..."></textarea>
						</div>
					</div>

					<div class="submit">
						<div class="comfirm">
							<button type="Submit">Comfirm</button>
						</div>
						<div class="cancel">
							<button type="Cancel">Cancel</button>
						</div>
					</div>
				</form>
		</div>
	</div>
</section>

<?php
	include_once("../footer.php");
?>
