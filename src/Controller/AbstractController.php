<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Controller/UserController.php");
require_once("src/Controller/RevenueController.php");
require_once("src/Controller/ExpenseController.php");
require_once("src/Controller/DataController.php");
require_once("src/Exception/ConfigurationException.php");
require_once("src/Exception/StorageException.php");
require_once("src/Exception/AppException.php");

require_once("src/Utils/debug.php");

use App\Request;
use App\View;
use App\Controller\UserController;
use App\Controller\RevenueController;
use App\Controller\ExpenseController;
use App\Controller\DataController;
use App\Exception\ConfigurationException;
use App\Exception\StorageException;
use App\Exception\AppException;
use Thorwable;

abstract class AbstractController
{
	protected const DEFAULT_ACTION = 'login';
	private static array $configuration = [];

	protected Request $request;
	protected View $view;
	protected UserController $user;
	protected RevenueController $revenue;
	protected ExpenseController $expense;
	protected DataController $data;

	public static function initConfiguration(array $configuration): void
	{
		self::$configuration = $configuration;
	}

	public function __construct(Request $request)
	{
		if(empty(self::$configuration['db'])){
			throw new ConfigurationException('Configuration Error');
		}

		$this->request = $request;
		$this->view = new View();
		$this->user = new UserController(self::$configuration['db'], $request);
		$this->revenue = new RevenueController(self::$configuration['db'], $request);
	  $this->expense = new ExpenseController(self::$configuration['db'], $request);
		$this->data = new DataController(self::$configuration['db'], $request);
	}

	protected function checkLoggins(): void 
	{
		if(isset($_SESSION['userId']) && $_SESSION['userId'] > 0){ 
			$this->view->render("overview");
			exit();
		} 
	}

	final public function run(): void 
	{
		try{
			$action = $this->action() . 'Action';
			if(!method_exists ($this, $action)){
				$action = self::DEFAULT_ACTION . 'Action';
			}
			$this->$action();
		}	catch(AppException $e) {
			throw new AppException();
		} catch(StorageException $e) {
			throw new StorageException();
		}
	}

	private function action(): string
	{
		return $this->request->getParam('action', self::DEFAULT_ACTION);
	}
	
}
