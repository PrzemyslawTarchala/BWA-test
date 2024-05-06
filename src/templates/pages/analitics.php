<?php
	include_once("../header.php");
?>

<section class="analitics-page">
	<div class="page-content">
		<div class="theme">
			<div class="text">
				<h2>Analitics</h2>
			</div>

		</div>
		<div class="analitics-content">
			<div class="time-period">
				<div class="header">
					<h3>Choose period of analitics:</h3>
				</div>

				<div class="display">
					<form action="/?action=analitics" class="form" method="post">
						<input type="hidden" name="analiticsPeriod" value="currentMonth">
						<button>Current Month</button>
					</form>

					<form action="/?action=analitics" class="form" method="post">
						<input type="hidden" name="analiticsPeriod" value="previoustMonth">
						<button>Previous Month</button>
					</form>

					<form action="/?action=analitics" class="form" method="post">
						<input type="hidden" name="analiticsPeriod" value="currentYear">
						<button>Current Year</button>
					</form>

					<form action="/?action=analitics" class="form" method="post">
						<input type="hidden" name="analiticsPeriod" value="customDate">
						<input type="date" name="costumStartDate">
						<input type="date" name="costumEndDate">
						<button>Go</button>
					</form>
				</div>
			</div>

			<div class="incomes">
				<div class="header">
					<h3>Incomes</h3>
				</div>
				<div class="display">
					<?php for($i = sizeof($_SESSION['AnaliticsData']['incomeData']) - 1; $i >= 0; --$i) : ?>
						<ul class="listOfIncome">
							<li class="name"><?php echo $_SESSION['AnaliticsData']['incomeData'][$i]['name']; ?></li>
							<li class="amountt"><i class='bx bx-dollar'></i><?php echo $_SESSION['AnaliticsData']['incomeData'][$i]['amount']; ?></li>
							<li class="date"><?php echo $_SESSION['AnaliticsData']['incomeData'][$i]['date_of_income']; ?></li>
							<li class="commentt"><?php echo $_SESSION['AnaliticsData']['incomeData'][$i]['income_comment']; ?></li>
							<li class="edit"><i class='bx bx-edit-alt'></i></li>
						</ul>
					<?php endfor; ?>
				</div>
			</div>
			<div class="expenses">
				<div class="header">
					<h3>Expenses</h3>
				</div>
				<div class="display">
					<?php for($i = sizeof($_SESSION['AnaliticsData']['expenseData']) - 1; $i >= 0; --$i) : ?>
						<ul class="listOfExpense">
							<li class="name"><?php echo $_SESSION['AnaliticsData']['expenseData'][$i]['name']; ?></li>
							<li class="amountt"><i class='bx bx-dollar'></i><?php echo $_SESSION['AnaliticsData']['expenseData'][$i]['amount']; ?></li>
							<li class="date"><?php echo $_SESSION['AnaliticsData']['expenseData'][$i]['date_of_expense']; ?></li>
							<li class="paymetMethod"><?php echo $_SESSION['AnaliticsData']['expenseData'][$i]['paymentMethod']; ?></li>
							<li class="commentt"><?php echo $_SESSION['AnaliticsData']['expenseData'][$i]['expense_comment']; ?></li>
							<li class="edit"><i class='bx bx-edit-alt'></i></li>
						</ul>
					<?php endfor; ?>
				</div>
			</div>
		</div>
	</div>
</section>


<?php
	include_once("../footer.php");
?>

