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
			$this->user->login();
		}
		$this->view->render('login');
	}

	public function registerAction(): void 
	{
		if($this->request->hasPost()){
			$this->user->register();
		}
		$this->view->render('register');
	}

	public function addRevenueAction(): void 
	{
		if($this->request->hasPost()){
			$this->revenue->addNewTransaction();
		}
		$this->view->render("addRevenue");
	}

	public function addExpenseAction(): void
	{
		if($this->request->hasPost()){
			$this->expense->addNewTransaction();
		}
		$this->view->render("addExpense");
	}

	public function overviewAction(): void
	{
		$this->view->render("overview");
	}

	public function analiticsAction(): void
	{
		$this->view->render("analitics");
	}

	public function logoutAction(): void
	{
		$this->user->logout();
	}
}