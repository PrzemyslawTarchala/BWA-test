<?php
	include_once("../header.php");
	include_once("../../Auxiliary/Auxiliary.php");
	use App\Auxiliary\Auxiliary;
?>

<section class="expense-page">
	<div class="page-content">

		<div class="message-window">
			<?php Auxiliary::display()?>
		</div>
			
		<div class="theme">
			<div class="text">
				<h2>Add Expense</h2>
			</div>
		</div>
		
		<div class="expense-data">
			<form action="/?action=addExpense" class="form" method="post">
				<div class="amount ">
					<div class="header">
						<h3>Amount & Payment method</h3>
					</div>
					<div class="input">
						<div class="text">
							<span>Enter the amount:</span>
						</div>
						<div class="float">
							<input type="number" name="amount" placeholder="$">
						</div>
						<div class="payment-method">
							<span>Payment method:</span>
							<li><input type="radio" id="" name="paymentMethod" value="cash">Cash</li>
							<li><input type="radio" id="" name="paymentMethod" value="debetCard"> Debet Card</li>
							<li><input type="radio" id="" name="paymentMethod" value="creditCard"> Credit Card</li>
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
							<input type="date" name="date">
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
								<li><input type="radio" id="category" name="category" value="food"> Food</li>
								<li><input type="radio" id="category" name="category" value="rent"> Rent</li>
								<li><input type="radio" id="category" name="category" value="transport"> Transport</li>
							</ul>
							<ul>
								<li><input type="radio" id="category" name="category" value="telecomunication"> Telecommunication</li>
								<li><input type="radio" id="category" name="category" value="healthCare"> Health care</li>
								<li><input type="radio" id="category" name="category" value="clothes"> Clothes</li>
							</ul>
							<ul>
								<li><input type="radio" id="category" name="category" value="hygiene"> Hygiene</li>
								<li><input type="radio" id="category" name="category" value="kids"> Kids</li>
								<li><input type="radio" id="category" name="category" value="entertainment"> Entertainment</li>
							</ul>
							<ul>
								<li><input type="radio" id="category" name="category" value="trips"> Trips</li>
								<li><input type="radio" id="category" name="category" value="selfdevelopment"> Self development</li>
								<li><input type="radio" id="category" name="category" value="books"> Books</li>
							</ul>
							<ul>
								<li><input type="radio" id="category" name="category" value="savings"> Savings</li>
								<li><input type="radio" id="category" name="category" value="pensions"> Pensions</li>
								<li><input type="radio" id="category" name="category" value="commitmens"> Commitments</li>
							</ul>
							<ul>
								<li><input type="radio" id="category" name="category" value="donation"> Donation</li>
								<li><input type="radio" id="category" name="category" value="other"> Other</li>
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
						<button type="button" onclick="window.location.reload();">Cancel</button>
					</div>
				</div>
			</form>
			
		</div>
	</div>
</section>


<?php
	include_once("../footer.php");
?>

