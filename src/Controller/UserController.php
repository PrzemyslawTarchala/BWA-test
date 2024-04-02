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

	public function logout(): void
{
		$_SESSION['logged'] = false; 
		header("Location: ../../index.php");
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
