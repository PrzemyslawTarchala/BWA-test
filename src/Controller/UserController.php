<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Model/UserModel.php");
require_once("src/Auxiliary/Auxiliary.php");

use App\Model\UserModel;
use App\Auxiliary\Auxiliary;

class UserController
{
	private UserModel $user;

	public function __construct(array $config)
	{
		$this->user = new UserModel($config);
	}

	public function login(): void 
	{
		$loginData = [
			'username' => $_POST['username'],
			'password' => $_POST['password']
		];

		if($this->user->login($loginData)) {
			$_SESSION['logged'] = true;
			Auxiliary::redirect("overview");
		} else {
			$_SESSION['message'] = "Wrong username or password.";
			Auxiliary::redirect("login");
		}
	}

	public function register(): void 
	{
		$registerData = [
			'username' => $_POST['newUsername'],
			'email' => $_POST['newEmail'],
			'password' => $_POST['password'],
			'confirmPassword' => $_POST['confirmPassword']
		];

		$this->registerValidation($registerData);
		$this->user->register($registerData);
	}

	private function registerValidation(array $registerData): void
	{
		if(strlen($registerData['username']) < 1){
			$_SESSION['message'] = "Login too short. Minimum 3 characters.";
			Auxiliary::redirect("register");
		}

		if($this->user->isNewUsernameAvailiabity($registerData['username'])){
			$_SESSION['message'] = "Login already exists";
			Auxiliary::redirect("register");
		} 

		if(!strpos($registerData['email'], '@') || !strpos($registerData['email'], '.')){
			$_SESSION['message'] = "Wrong email";
			Auxiliary::redirect("register");
		}

		if($this->user->isNewEmailAvailiabity($registerData['email'])){
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

	public function logout(): void
	{
		$_SESSION['logged'] = false; 
		Auxiliary::redirect("login");
	}
 }
