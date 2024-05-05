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
	private Request $request;
	private DataModel $dataModel; 

	public function __construct(array $config, Request $request)
	{
		$this->dataModel = new DataModel($config);
		$this->dataModel->setDefault();
		$this->request = $request;
	}

	public function updateOverviewCharts(): void 
	{
		$_SESSION['incomeDoughnutChartData'] = $this->dataModel->overviewIncomePieChartOverview();
		$_SESSION['expenseDoughnutChartData'] = $this->dataModel->overviewExpensePieChartOverview();
		$_SESSION['balancePlotData'] = $this->dataModel->overwievBalancePlot();
	}

	public function updateTotalMonthIncomeExpenseDifference(): void 
	{
		$_SESSION['monthIncomeExpenseDifference'] = $this->dataModel->totalMonthIncomeDifference();
	}
}

