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
						<h3>Amount & Payment method</h3>
					</div>
					<div class="input">
						<div class="text">
							<span>Enter the amount:</span>
						</div>
						<div class="float">
							<input type="float" placeholder="$">
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
					</div>
					<div class="input">
						<div class="text">
							<span>Choose category: </span>
						</div>
						<div class="category-choose">
							<ul>
								<li><input type="radio" id="" name="category" value=""> Food</li>
								<li><input type="radio" id="" name="category" value=""> Rent</li>
								<li><input type="radio" id="" name="category" value=""> Transport</li>
							</ul>
							<ul>
								<li><input type="radio" id="" name="category" value=""> Telecommunication</li>
								<li><input type="radio" id="" name="category" value=""> Health care</li>
								<li><input type="radio" id="" name="category" value=""> Clothes</li>
							</ul>
							<ul>
								<li><input type="radio" id="" name="category" value=""> Hygiene</li>
								<li><input type="radio" id="" name="category" value=""> Kids</li>
								<li><input type="radio" id="" name="category" value=""> Entertainment</li>
							</ul>
							<ul>
								<li><input type="radio" id="" name="category" value=""> Trips</li>
								<li><input type="radio" id="" name="category" value=""> Self develepment</li>
								<li><input type="radio" id="" name="category" value=""> Books</li>
							</ul>
							<ul>
								<li><input type="radio" id="" name="category" value=""> Savings</li>
								<li><input type="radio" id="" name="category" value=""> Pensions</li>
								<li><input type="radio" id="" name="category" value=""> Commitments</li>
							</ul>
							<ul>
								<li><input type="radio" id="" name="category" value=""> Donation</li>
								<li><input type="radio" id="" name="category" value=""> Other</li>
							</ul>
						</div>
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

