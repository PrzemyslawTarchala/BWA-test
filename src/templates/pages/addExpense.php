<?php
	include_once("../header.php");
?>

<section class="expense-page">
	<div class="page-content">
			
		<div class="theme">
			<div class="text">
				<h2>Add Expense</h2>
			</div>
		</div>
		
		<div class="expense-data">
			<form action="" class="form">
				<div class="amount ">
					<div class="header">
						<h3>Amount</h3>
					</div>
					<div class="input">
						<div class="text">
							<span>Enter the amount:</span>
						</div>
						<div>
							<input type="float">
						</div>
						<div class="payment-method">
							<span>Payment method:</span>
							<li><input type="radio" id="" name="payment" value="cash">Cash</li>
							<li><input type="radio" id="" name="payment" value="debetCard"> Debet Card</li>
							<li><input type="radio" id="" name="payment" value="creditCard"> Credit Card</li>
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
						<i class='bx bx-chevron-up expand'></i>
					</div>
					<div class="input up">
						<div class="text">
							<span>Choose category: </span>
						</div>
						<ul>
							<li><input type="radio" id="" name="" value=""> Salary</li>
							<li><input type="radio" id="" name="bankInterst" value=""> Bank interest</li>
							<li><input type="radio" id="" name="allegro" value=""> Allegro</li>
							<li><input type="radio" id="" name="other" value=""> Other</li>
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

