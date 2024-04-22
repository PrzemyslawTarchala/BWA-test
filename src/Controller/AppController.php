<?php

declare(strict_types=1);

namespace App\Controller;

use App\Controller\AbstractController;

class AppController extends AbstractController
{
	public function loginAction(): void
	{
		$this->view->render('login');
	}

	public function registerAction(): void 
	{
		$this->view->render('register');
	}

}