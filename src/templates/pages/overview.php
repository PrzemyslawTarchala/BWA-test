<?php
	include_once("../header.php");
?>

<section class="overview-page">

	<div class="page-content">
		
		<div class="theme">
			<div class="text">
				<h2>Quick Month Overview</h2>
			</div>
		</div>
		
		<div class="charts">
			<div class="monthly-balance">
				<div class="revenue">
					<div class="title">
						<h3>Monthly revenue</h3>
					</div>
					<div class="pie-chart">

						<?php 
							$jsonData = json_encode($_SESSION['overviewData']['incomeDoughnutChartData']);
							echo "<script>var incomeDoughnutChartData = $jsonData;</script>";
						?>
						<?php if(($_SESSION['overviewData']['monthIncome']) <= 0) :?>
							<h3><strong>There are no incomes in this month.</strong></h3>
						<?php else: ?>
							<canvas id="incomeDoughnutChart"></canvas>
						<?php endif; ?>
					</div>
				</div>

				<div class="expense">
					<div class="title">
						<h3>Monthly expense</h3>						
					</div>
					<div class="pie-chart">
						<?php 
							$jsonData = json_encode($_SESSION['overviewData']['expenseDoughnutChartData']);
							echo "<script>var expenseDoughnutChartData = $jsonData;</script>";
						?>
						<?php if(($_SESSION['overviewData']['monthExpense']) <= 0) :?>
							<h3><strong>There are no expenses in this month.</strong></h3>
						<?php else:?>
							<canvas id="expenseDoughnutChart"></canvas>
						<?php endif; ?>
					</div>
				</div>
			</div>

			<div class="current-month">
				<div class="plot-balance">
					<div class="plot">
						<?php 
							$jsonData = json_encode($_SESSION['overviewData']['balancePlotData']);
							echo "<script>var balancePlotData = $jsonData;</script>";
						?>
						<canvas id="balancePlot"></canvas>
					</div>

					<div class="balance">
						<div class="revenue-month">
							<i class='bx bx-trending-up'></i>
							<h4><?php echo ($_SESSION['overviewData']['monthIncome']); ?></h4>
						</div>
						<div class="expense-month">
							<i class='bx bx-trending-down' ></i>
							<h4><?php echo ($_SESSION['overviewData']['monthExpense']); ?></h4>
						</div>

						<div class="summary-month">
							<?php if (($_SESSION['overviewData']['monthDiffernce']) > 0) : ?>
								<box-icon name='happy-beaming'></box-icon>
							<?php elseif (($_SESSION['overviewData']['monthDiffernce']) <= 0) :?>
								<box-icon name='sad' ></box-icon>
							<?php endif; ?>
								<h4><?php echo ($_SESSION['overviewData']['monthDiffernce']); ?></h4>
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

