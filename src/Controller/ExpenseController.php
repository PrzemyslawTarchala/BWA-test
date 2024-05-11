<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Model/ExpenseModel.php");
require_once("src/Auxiliary/Auxiliary.php");
require_once("src/Request.php");
require_once("src/Controller/DataController.php");

require_once("src/Utils/debug.php");

use App\Request;
use App\Model\ExpenseModel;
use App\Auxiliary\Auxiliary;
use App\Controller\RevenueController;

class ExpenseController
{
	private Request $request;
	private ExpenseModel $expenseModel;
	private DataController $data;

	public function __construct(array $config, Request $request)
	{
		$this->request = $request;
		$this->expenseModel = new ExpenseModel($config);
		$this->data = new DataController($config, $request);
	}

	public function addNewTransaction(): void
	{
		if($this->request->isPost()){
			$expenseData = [
				'amount' 				=> $this->request->postParam('amount'),
				'paymentMethod' => $this->request->postParam('paymentMethod'),
				'date' 					=> $this->request->postParam('date'),
				'category'		 	=> $this->request->postParam('category'),
				'comment' 			=> $this->request->postParam('comment')
			];
			$this->validateData($expenseData);
			$this->expenseModel->addExpense($expenseData);
			$this->data->updateOverviewData();
			$this->data->updateAnaliticsData();
		} else {
			Auxiliary::redirect("addExpanse");
		}
	}

	private function validateData(array $expenseData): void 
	{
		foreach($expenseData as $key => $value){
			if(empty($value) && $key !== 'comment'){
				$_SESSION['message'] = "The $key must has value!";
				Auxiliary::redirect("addExpense");
			}
		}

		if($expenseData['amount'] <= 0){
			$_SESSION['message'] = "The amount has to be greater than 0!";
			Auxiliary::redirect("addExpense");
		}

		if(strtotime($expenseData['date']) <= strtotime('2020-01-01')){
			$_SESSION['message'] = "The date has to be greater than 2020-01-01!";
			Auxiliary::redirect("addExpense");
		}
	}
}