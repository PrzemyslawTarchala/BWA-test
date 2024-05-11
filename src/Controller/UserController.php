<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Request.php");
require_once("src/Model/UserModel.php");
require_once("src/Auxiliary/Auxiliary.php");
require_once("src/Controller/DataController.php");
require_once("src/Exception/AppException.php");

require_once("src/Utils/debug.php");

use App\Request;
use App\Model\UserModel;
use App\Auxiliary\Auxiliary;
use App\Controller\DataController;
use App\Exception\AppException;

class UserController
{
	private Request $request;
	private UserModel $userModel;
	private DataController $data;

	public function __construct(array $config, Request $request)
	{
		$this->request = $request;
		$this->userModel = new UserModel($config);
		$this->data = new DataController($config, $request);
	}

	public function login(): void
	{
		$loginData = [
			'username' => $this->request->postParam('username'),
			'password' => $this->request->postParam('password')
		];

		if($result = $this->userModel->login($loginData)) {
			$_SESSION['userId'] = $result['id'];
			$_SESSION['logged'] = true;
			$this->data->updateOverviewData();
			$this->data->updateAnaliticsData();
			Auxiliary::redirect("overview");
		} else {
			$_SESSION['userId'] = 0;
			$_SESSION['logged'] = false;
			$_SESSION['message'] = "Wrong username or password.";
			Auxiliary::redirect("login");
		}
	}

	public function register(): void 
	{
		$registerData = [
			'username' => $this->request->postParam('newUsername'),
			'email'	=> $this->request->postParam('newEmail'),
			'password' => $this->request->postParam('password'),
			'confirmPassword' => $this->request->postParam('confirmPassword')
		];	

		$this->registerValidation($registerData);
		$this->assignDefaultSettings($this->userModel->register($registerData));
		$_SESSION['message'] = "Registration correct! :)";
		Auxiliary::redirect("login");
	}

	public function logout(): void
	{
		$_SESSION['userId'] = 0;
		$_SESSION['logged'] = false; 
		session_destroy();
		Auxiliary::redirect("login");
	}

	private function registerValidation(array $registerData): void
	{
		if(strlen($registerData['username']) < 1){
			$_SESSION['message'] = "Login too short. Minimum 3 characters.";
			Auxiliary::redirect("register");
		}

		if($this->userModel->isNewUsernameAvailiabity($registerData['username'])){
			$_SESSION['message'] = "Login already exists";
			Auxiliary::redirect("register");
		} 

		if(!strpos($registerData['email'], '@') || !strpos($registerData['email'], '.')){
			$_SESSION['message'] = "Wrong email";
			Auxiliary::redirect("register");
		}

		if($this->userModel->isNewEmailAvailiabity($registerData['email'])){
			$_SESSION['message'] = "Email already exists";
			Auxiliary::redirect("register");
		} 

		if(strlen($registerData['password']) < 6){
			$_SESSION['message'] = "Password is too short. Minimum 6 characters.";
			Auxiliary::redirect("register");
		} 

		if($registerData['password'] !== $registerData['confirmPassword']){
			$_SESSION['message'] = "Passwords are diffrent";
			Auxiliary::redirect("register");
		} 
	}

	private function assignDefaultSettings(int $userId): void
	{
		$this->userModel->assignDefaultRevenueCategory($userId);
		$this->userModel->assignDefaultExpenseCategory($userId);
		$this->userModel->assignDefaultPaymentMethods($userId);
	}
 }
