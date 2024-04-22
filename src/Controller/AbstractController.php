<?php

declare(strict_types=1);

namespace App\Controller;

use App\Request;
use App\View;

abstract class AbstractController
{
	protected const DEFAULT_ACTION = 'login';
	private static array $configuration = [];

	protected Request $request;
	protected View $view;
	protected UserModel $user;
	protected RevenueModel $revenue;
	protected ExpenseModel $expense;

	public static function initConfiguration(array $configuration): void
	{
		self::$configuration = $configuration;
	}

	public function __construct(Request $request)
	{
		$this->request = $request;
		$this->view = new View();
	}

	final public function run(): void //walidacja czy ktos jest zalogowany
	{
		$action = $this->action() . 'Action';
		if(!method_exists ($this, $action)){
			$action = self::DEFAULT_ACTION . 'Action';
		}
		$this->$action();
	}

	private function action(): string
	{
		return $this->request->getParam('action', self::DEFAULT_ACTION); //pobierz dane z parametru 'action' w przeciwnym razie DEFAULT
	}
}
