<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Model/ExpenseModel.php");
require_once("src/Auxiliary/Auxiliary.php");
require_once("src/Request.php");
require_once("src/Utils/debug.php");

use App\Model\ExpenseModel;
use App\Auxiliary\Auxiliary;
use App\Request;

class ExpenseController
{
	private ExpenseModel $expanse;
	private Request $request;

	public function __construct(array $config, Request $request)
	{
		$this->expanse = new ExpenseModel($config);
		$this->request = $request;
	}

	public function addNewTransaction(): void
	{
		if($this->request->isPost()){
			$expenseData = [
				'amount' => $_POST['amount'] ?? '',
				'paymentMethod' => $_POST['paymentMethod'] ?? '',
				'date' => $_POST['date'] ?? '',
				'category' => $_POST['category'] ?? '',
				'comment' => $_POST['comment'] ?? ''
			];
			$this->validateData($expenseData);
			$this->expense->addExpense($expenseData);
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