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
			'monthIncome' => $this->dataModel->totalMonthIncome(),
			'monthExpense' => $this->dataModel->totalMonthExpense(),
			'monthDiffernce' => ($this->dataModel->totalMonthIncome() - $this->dataModel->totalMonthExpense())
		];
	}

	public function updateAnaliticsData(): void 
	{
		switch($_POST['analiticsPeriod']){
			case('previoustMonth'):	
				$this->getIncomeExpenseDataForPreviousMonth();
				break;
			case('currentYear'):
				dump('currentYear');
				exit();
				break;
			case('customDate'):
				dump('customDate');
				exit();
				break;
			default:
				$_SESSION['AnaliticsData'] = [
					'incomeData' => $this->dataModel->getIncomeData($startDate, $endDate),
					'expenseData' => $this->dataModel->getExpenseData($startDate, $endDate)
				];
				break;
		}
	}

	private function getIncomeExpenseDataForPreviousMonth(): void 
	{ 
		if(date('m') == 1){
			$starDate = date('Y') -1 . '-12-01';
			$endDate = date('Y') -1 . '-12-31';
		} else {
			$starDate = date('Y') . '-' .  date('m') - 1 . '-01';
			$endDate = date('Y') . '-' . date('m') - 1 . (string) cal_days_in_month(CAL_GREGORIAN, date('m') - 1, date('Y'));
 		}

		$_SESSION['AnaliticsData'] = [
			'incomeData' => $this->dataModel->getIncomeData($startDate, $endDate),
			'expenseData' => $this->dataModel->getExpenseData($startDate, $endDate)
		];
	}
}

