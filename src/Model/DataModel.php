<?php

declare(strict_types=1);

namespace App\Model;

require_once("src/Model/AbstractModel.php");
require_once("src/Utils/debug.php");

use App\Model\AbstractModel;
use PDO;

class DataModel extends AbstractModel
{
	private $defaultMonth;
	private $defaultYear;
	private $defaultStartCurrentMonthDate;
	private $defaultEndCurrentMonthDate;

	public function setDefault(): void
	{
		$this->defaultMonth = date('m');
		$this->defaultYear = date('Y');
		$this->defaultStartCurrentMonthDate = $this->defaultYear . "-"  . $this->defaultMonth . "-"  . "01";
		$this->defaultEndCurrentMonthDate = $this->defaultYear . "-"  .  $this->defaultMonth  . "-" . cal_days_in_month(CAL_GREGORIAN, (int)$this->defaultMonth, (int)$this->defaultYear);
	}

	public function overviewIncomePieChartOverview(): array
	{
		$loggedUserId = $_SESSION['userId'];

		$query = "SELECT incomes_category_assigned_to_users.name, SUM(incomes.amount) AS incomeByCategory 
		FROM incomes_category_assigned_to_users, incomes WHERE incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id 
		AND incomes.date_of_income BETWEEN '$this->defaultStartCurrentMonthDate' AND '$this->defaultEndCurrentMonthDate' AND incomes.user_id = :user_id
		GROUP BY incomes_category_assigned_to_users.name";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function overviewExpensePieChartOverview(): array 
	{
		$loggedUserId = $_SESSION['userId'];

		$query = "SELECT expenses_category_assigned_to_users.name, SUM(expenses.amount) AS expenseByCategory  
		FROM expenses_category_assigned_to_users, expenses  WHERE expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id
		AND expenses.date_of_expense BETWEEN '$this-> ' AND '$this->defaultEndCurrentMonthDate' AND expenses.user_id = :user_id
		GROUP BY expenses_category_assigned_to_users.name";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function overwievBalancePlot(): array
	{
		$dailyBalance = 0;
		$monthDailyBalance = [];
		$numOfDays = (string) cal_days_in_month(CAL_GREGORIAN, (int)$this->defaultMonth, (int)$this->defaultYear);

		for ($i = 1; $i <= $numOfDays; ++$i){
			$dailyBalance += $this->dailyBalnce($this->defaultYear . '-' . $this->defaultMonth . '-' . $i);
			$monthDailyBalance[$i] = $dailyBalance;
		}
		return $monthDailyBalance;
	}

	public function totalMonthIncome(): int 
	{
		$loggedUserId = $_SESSION['userId'];

		$query = "SELECT SUM(incomes.amount) AS monthIncome FROM incomes 
							WHERE incomes.date_of_income BETWEEN '$this->defaultStartCurrentMonthDate' AND '$this->defaultEndCurrentMonthDate' 
							AND incomes.user_id = :user_id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return (int) $result['monthIncome'];	
	}

	public function totalMonthExpense(): int 
	{
		$loggedUserId = $_SESSION['userId'];

		$query = "SELECT SUM(expenses.amount) AS monthExpense FROM expenses
		WHERE expenses.date_of_expense BETWEEN '$this->defaultStartCurrentMonthDate' AND '$this->defaultEndCurrentMonthDate' 
		AND expenses.user_id = :user_id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return (int) $result['monthExpense'];	
	}

	public function getIncomeData(string $startDate = null, string $endDate = null): array
	{
		if($startDate == null || $endDate == null){
			$startDate = $this->defaultStartCurrentMonthDate;
			$endDate = $this->defaultEndCurrentMonthDate;
		}

		$loggedUserId = $_SESSION['userId'];

		$query = "SELECT incomes_category_assigned_to_users.name, incomes.amount, incomes.date_of_income, incomes.income_comment
		FROM incomes_category_assigned_to_users, incomes WHERE incomes.income_category_assigned_to_user_id = incomes_category_assigned_to_users.id 
		AND incomes.date_of_income BETWEEN '$startDate' AND '$endDate' AND incomes.user_id = :user_id
		ORDER BY incomes.date_of_income DESC";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function getExpenseData(string $startDate = null, string $endDate = null): array
	{
		if($startDate == null || $endDate == null){
			$startDate = $this->defaultStartCurrentMonthDate;
			$endDate = $this->defaultEndCurrentMonthDate;
		}

		$loggedUserId = $_SESSION['userId'];

		$query = "SELECT expenses_category_assigned_to_users.name, expenses.amount, payment_methods_assigned_to_users.name AS paymentMethod, expenses.date_of_expense, expenses.expense_comment 
		FROM expenses_category_assigned_to_users, expenses, payment_methods_assigned_to_users 
		WHERE expenses.expense_category_assigned_to_user_id = expenses_category_assigned_to_users.id 
		AND payment_methods_assigned_to_users.id = expenses.payment_method_assigned_to_user_id 
		AND expenses.date_of_expense BETWEEN '$startDate' AND '$endDate' AND expenses.user_id = :user_id
		ORDER BY expenses.date_of_expense DESC";

		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
		$stmt->execute();		
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	private function dailyBalnce(string $date): int 
	{
		$loggedUserId = $_SESSION['userId'];

		$query = "SELECT SUM(incomes.amount) AS dailyIncome FROM incomes
							WHERE incomes.date_of_income = '$date' AND incomes.user_id = :user_id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$dailyIncome = (int) $result['dailyIncome'];

		$query = "SELECT SUM(expenses.amount) AS dailyExpense FROM expenses
		WHERE expenses.date_of_expense = '$date' AND expenses.user_id = :user_id";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		$dailyExpense = (int) $result['dailyExpense'];

		return ($dailyIncome - $dailyExpense);
	}
}