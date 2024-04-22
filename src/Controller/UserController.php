<?php

declare(strict_types=1);

namespace App\Controller;

include_once("../Model/UserModel.php");
include_once("../Auxiliary/Auxiliary.php");

use App\Model\UserModel;
use App\Auxiliary\AuxiliaryMethod;

class UserController
{
	private UserModel $user;

	public function __construct()
	{
		$this->user = new UserModel;
	}

	public function register(): void 
	{
		$registerData = [
			'username' => $_POST['newUsername'],
			'email' => $_POST['newEmail'],
			'password' => $_POST['password'],
			'comfirmPassword' => $_POST['confirmPassword']
		];

		$this->registerValidation($registerData);
		$this->user->register($registerData);
	}

	public function login(): void 
	{
		$loginData = [
			'username' => $_POST['username'],
			'password' => $_POST['password']
		];

		if($this->user->login($loginData)) {
			$_SESSION['logged'] = true;
			header("Location: ../templates/pages/overview.php");
		} else {
			$_SESSION['message'] = "Wrong username or password.";
			header("Location: ../templates/pages/sign_in.php");
		}
	}

	public function logout(): void
	{
		$_SESSION['logged'] = false; 
		header("Location: ../../index.php");
	}

	private function registerValidation(array $registerData): void
	{
		if(strlen($registerData['username']) < 1){
			$_SESSION['message'] = "Login too short. Minimum 3 characters.";
			header("Location: ../templates/pages/register.php");
			exit();
		}

		if($this->user->isNewUsernameAvailiabity($registerData['username'])){
			$_SESSION['message'] = "Login already exists";
			header("Location: ../templates/pages/register.php");
			exit();
		} 

		if(!strpos($registerData['email'], '@') || !strpos($registerData['email'], '.')){
			$_SESSION['message'] = "Wrong email";
			header("Location: ../templates/pages/register.php");
			exit();
		}

		if($this->user->isNewEmailAvailiabity($registerData['email'])){
			$_SESSION['message'] = "Email already exists";
			header("Location: ../templates/pages/register.php");
			exit();
		} 

		if(strlen($registerData['password']) < 6){
			$_SESSION['message'] = "Password is too short. Minimum 6 characters.";
			header("Location: ../templates/pages/register.php");
			exit();
		} 

		if($registerData['password'] != $registerData['confirmPassword']){
			$_SESSION['message'] = "Passwords are diffrent";
			header("Location: ../templates/pages/register.php");
			exit();
		} 
	}
}

$init = new UserController;

if($_SERVER['REQUEST_METHOD'] == 'POST'){
	switch($_POST['type']){
		case 'register':
			$init->register();
			break;
		case 'login':
			$init->login();
			break;
		default:
			redirect("../../index.php");
	} 
} elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
	switch ($_GET['q']) {
			case 'logout':
					$init->logout();
					break;
			default:
					redirect("../index.php");
	}
}
