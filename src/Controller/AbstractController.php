<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Controller/UserController.php");
require_once("src/Controller/RevenueController.php");
require_once("src/Controller/ExpenseController.php");
require_once("src/Exception/ConfigurationException.php");

require_once("src/Utils/debug.php");

use App\Request;
use App\View;
use App\Controller\UserController;
use App\Controller\RevenueController;
use App\Controller\ExpenseController;
use App\Exception\ConfigurationException;

abstract class AbstractController
{
	protected const DEFAULT_ACTION = 'login';
	private static array $configuration = [];

	protected Request $request;
	protected View $view;
	protected UserController $user;
	protected RevenueController $revenue;
	protected ExpenseController $expense;

	public function __construct(Request $request)
	{
		if(empty(self::$configuration['db'])){
			throw new ConfigurationException('Configuration Error');
		}

		$this->request = $request;
		$this->view = new View();
		$this->user = new UserController(self::$configuration['db']);
		$this->revenue = new RevenueController(self::$configuration['db'], $request);
	  $this->expense = new ExpenseController(self::$configuration['db'], $request);
	}

	public static function initConfiguration(array $configuration): void
	{
		self::$configuration = $configuration;
	}

	final public function run(): void 
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
