<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Request.php");
require_once("src/Model/DataModel.php");

require_once("src/Utils/debug.php");

use App\Request;
use App\Model\DataModel;

class DataController
{
	private const DEFAULT_DATA = "currentMonth";
	private Request $request;
	private DataModel $dataModel; 

	public function __construct(array $config, Request $request)
	{
		$this->dataModel = new DataModel($config);
		$this->dataModel->setDefault();
		$this->request = $request;
	}

	public function updateOverviewData(): void //Always preapre data for current month
	{
		$_SESSION['overviewData'] = [
			'incomeDoughnutChartData' => $this->dataModel->overviewIncomePieChartOverview(),
			'expenseDoughnutChartData' => $this->dataModel->overviewExpensePieChartOverview(),
			'balancePlotData' => $this->dataModel->overwievBalancePlot(),
			'monthIncome' => $this->dataModel->totalIncome(),
			'monthExpense' => $this->dataModel->totalExpense(),
			'monthDiffernce' => ($this->dataModel->totalIncome() - $this->dataModel->totalExpense())
		];
	}

	public function updateAnaliticsData(): void 
	{
		if(!isset($_POST['analiticsPeriod'])){
			$_POST['analiticsPeriod'] = null;
			$_SESSION['AnaliticsData'] = null;
		}

		switch($_POST['analiticsPeriod']){
			case('previoustMonth'):	
				$this->getIncomeExpenseDataForPreviousMonth();
				// dump(111);
				// exit();
				break;
			case('currentYear'):
				$this->getIncomeExpenseDataForCurrentYear();
				// dump(112);
				// exit();
				break;
			case('customDate'):
				$this->getIncomeExpenseDataForCustomDate();
				// dump(113);
				// exit();
				break;
			default:
				$_SESSION['AnaliticsData'] = [
					'incomeData' => $this->dataModel->getIncomeData(),
					'expenseData' => $this->dataModel->getExpenseData(),
					'totalIncome' => $this->dataModel->totalIncome(),
					'totalExpense' => $this->dataModel->totalExpense(),
				];
				break;
		}
	}

	private function getIncomeExpenseDataForPreviousMonth(): void
	{
		if (date('m') == 1) {
				$startDate = date('Y') - 1 . '-12-01';
				$endDate = date('Y') - 1 . '-12-31';
		} else {
				$startDate = date('Y') . '-' . date('m') - 1 . '-01';
				$endDate = date('Y') . '-' . date('m') - 1 . '-' . (string) cal_days_in_month(CAL_GREGORIAN, (int) date('m') -1, (int) date('Y'));
		}

		$_SESSION['AnaliticsData'] = [
				'incomeData' => $this->dataModel->getIncomeData($startDate, $endDate),
				'expenseData' => $this->dataModel->getExpenseData($startDate, $endDate),
				'totalIncome' => $this->dataModel->totalIncome($startDate, $endDate),
				'totalExpense' => $this->dataModel->totalExpense($startDate, $endDate),
		];
	}

	private function getIncomeExpenseDataForCurrentYear(): void 
	{
		$startDate = date('Y') . '-01-01';
		$endDate = date('Y') . '-12-31';

		$_SESSION['AnaliticsData'] = [
			'incomeData' => $this->dataModel->getIncomeData($startDate, $endDate),
			'expenseData' => $this->dataModel->getExpenseData($startDate, $endDate),
			'totalIncome' => $this->dataModel->totalIncome($startDate, $endDate),
			'totalExpense' => $this->dataModel->totalExpense($startDate, $endDate),
	];
	}

	private function getIncomeExpenseDataForCustomDate(): void 
	{
		$startDate = $_POST['costumStartDate'];
		$endDate = $_POST['costumEndDate'];

		$_SESSION['AnaliticsData'] = [
			'incomeData' => $this->dataModel->getIncomeData($startDate, $endDate),
			'expenseData' => $this->dataModel->getExpenseData($startDate, $endDate),
			'totalIncome' => $this->dataModel->totalIncome($startDate, $endDate),
			'totalExpense' => $this->dataModel->totalExpense($startDate, $endDate),
	];
	}
}

