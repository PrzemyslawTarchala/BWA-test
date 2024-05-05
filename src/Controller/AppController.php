<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Utils/debug.php");

use App\Controller\AbstractController;

class AppController extends AbstractController
{
	public function loginAction(): void
	{
		if($this->request->hasPost()){
			if($this->user->login()){
				$this->overviewAction();
				exit();
			}
		}
		$this->view->render('login');
	}

	public function registerAction(): void 
	{
		$this->checkLoggins();
		if($this->request->hasPost()){
			$this->user->register();
		}
		$this->view->render('register');
	}

	public function addRevenueAction(): void 
	{
		$this->checkLoggins();
		if($this->request->hasPost()){
			$this->revenue->addNewTransaction();
		}
		$this->view->render("addRevenue");
	}

	public function addExpenseAction(): void
	{
		$this->checkLoggins();
		if($this->request->hasPost()){
			$this->expense->addNewTransaction();
		}
		$this->view->render("addExpense");
	}

	public function overviewAction(): void
	{
		$this->checkLoggins();
		$this->data->updateOverviewCharts();
		$this->data->updateTotalMonthIncomeExpenseDifference();

		$this->view->render("overview");
	}

	public function analiticsAction(): void
	{
		$this->checkLoggins();
		$this->view->render("analitics");
	}

	public function logoutAction(): void
	{
		$this->checkLoggins();
		$this->user->logout();
	}

	private function updateData(): void 
	{
		$this->revenue->updateRevenueData(); 
	}
}