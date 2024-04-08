<?php
	include_once("../header.php");
?>

<section class="overview-page">

	<div class="page-content">
		
		<div class="theme">
			
			<div class="text">
				<h2>Overview</h2>
			</div>

			<div class="month-selector">
				<form action="">
					<input type="month">
					<button type="submit">Submit</button>
				</form>
				
			</div>
		</div>
		
		<div class="charts">

			<div class="monthly-balance">
				
				<div class="revenue">
					<h5>Monthly revenue</h5>
				</div>

				<div class="expense">
					<h5>Monthly income</h5>
				</div>
		
			</div>

			<div class="current-year">
				

				<div class="text">
					<h4>Balance <?php echo date("Y"); ?></h4>
				</div>

				<div class="plot-balance">
					<div class="plot">

					</div>

					<div class="balance">
						<div class="revenue-year">

						</div>

						<div class="expense-year">

						</div>

						<div class="summary-year">

						</div>
					</div>
				</div>

			</div>

		</div>
	</div>

</section>

<?php
	include_once("../footer.php");
?>

