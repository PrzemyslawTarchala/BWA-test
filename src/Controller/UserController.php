<?php

declare(strict_types=1);

include_once("../Model/UserModel.php");

class UserController
{
	private $User;

	public function __construct()
	{
		$this->User = new UserModel;
	}

	public function register(): void 
	{

		echo "register";

		$registerData = [
			'username' => $_POST['newUsername'],
			'email' => $_POST['newEmail'],
			'password' => $_POST['password'],
			'comfirmPassword' => $_POST['confirmPassword']
		];


		$this->User->register($registerData);
	}

	public function login(): void 
	{
		
		echo 'Login';

		$loginData = [
			'username' => $_POST['username'],
			'password' => $_POST['password']
		];

		if($this->User->login($loginData)) {
			echo '222';
			header("Location: ../templates/pages/menu.php");
		} else {
			echo 'L333';
			header("Location: ../../index.php");
		}
	}

}

//Utworzenie obiektu
$init = new UserController;

//Sprawdzenie czy użytkownik wysłał dane:
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

}