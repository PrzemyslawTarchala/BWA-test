<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Model/RevenueModel.php");
require_once("src/Auxiliary/Auxiliary.php");
require_once("src/Request.php");
require_once("src/Controller/DataController.php");

require_once("src/Utils/debug.php");

use App\Request;
use App\Model\RevenueModel;
use App\Auxiliary\Auxiliary;
use App\Controller\DataController;

class RevenueController
{
	private Request $request;
	private RevenueModel $revenueModel;
	private DataController $data;

	public function __construct(array $config, Request $request)
	{
		$this->request = $request;
		$this->revenueModel = new RevenueModel($config);
		$this->data = new DataController($config, $request);
	}

	public function addNewTransaction(): void
	{
		if($this->request->isPost()){
			$revenueData = [
				'amount'	 	=> $this->request->postParam('amount'),
				'date' 			=> $this->request->postParam('date'),
				'category' 	=> $this->request->postParam('source'),
				'comment' 	=> $this->request->postParam('comment')
			];
			
			$this->validateData($revenueData);
			$this->revenueModel->addRevenue($revenueData);
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
