<?php

declare(strict_types=1);

namespace App\Controller;

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

	public function logout(): void
	{
		$this->user->logout();
	}
}