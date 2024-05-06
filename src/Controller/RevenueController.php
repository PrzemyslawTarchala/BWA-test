<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Model/RevenueModel.php");
require_once("src/Auxiliary/Auxiliary.php");
require_once("src/Request.php");
require_once("src/Controller/DataController.php");

require_once("src/Utils/debug.php");

use App\Model\RevenueModel;
use App\Auxiliary\Auxiliary;
use App\Request;
use App\Controller\DataController;

class RevenueController
{
	private RevenueModel $revenue;
	private Request $request;
	private DataController $data;

	public function __construct(array $config, Request $request)
	{
		$this->revenue = new RevenueModel($config);
		$this->request = $request;
		$this->data = new DataController($config, $request);
	}

	public function addNewTransaction(): void
	{
		if($this->request->isPost()){
			$revenueData = [
				'amount' => $_POST['amount'] ?? '',
				'date' => $_POST['date'] ?? '',
				'category' => $_POST['source'] ?? '',
				'comment' => $_POST['comment'] ?? ''
			];
			$this->validateData($revenueData);
			$this->revenue->addRevenue($revenueData);
			$this->data->updateOverviewData();
			$this->data->updateAnaliticsData();
		}
		Auxiliary::redirect("addRevenue");
	}

	private function validateData(array $revenueData): void 
	{
		foreach($revenueData as $key => $value){
			if(empty($value) && $key !== 'comment'){
				$_SESSION['message'] = "The $key must has value!";
				Auxiliary::redirect("addRevenue");
			}
		}

		if($revenueData['amount'] <= 0){
			$_SESSION['message'] = "The amount has to be greater than 0!";
			Auxiliary::redirect("addRevenue");
		}

		if(strtotime($revenueData['date']) <= strtotime('2020-01-01')){
			$_SESSION['message'] = "The date has to be greater than 2020-01-01!";
			Auxiliary::redirect("addRevenue");
		}
	}
}
