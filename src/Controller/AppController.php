<?php

declare(strict_types=1);

require_once("src/View.php");

class AppController
{
	private View $view;

	public function __construct()
	{
		$this->view = new View;
	}
	
	public function run(): void 
	{
		$this->view->render("sign_in");
	}

}