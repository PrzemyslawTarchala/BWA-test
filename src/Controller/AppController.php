<?php

declare(strict_types=1);

require_once("src/View.php");

class AppController
{
	private View $view;

	//Tutaj powinno odbyć się sprawdzenie czy user jest zalogowany, w przeciwnym wypadku przenieść go na strone logowania
	public function __construct()
	{
		$this->view = new View;
	}

	
	public function run(): void 
	{
		$this->view->render("sign_in");
	}

	private function register(): void
	{


	}

	private function signIn(): void
	{


	}
}