<?php

declare(strict_types=1);

session_start();

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
		if($_SESSION['logged']){
			$this->view->render("overview");
		} else {
			$this->view->render("sign_in");
		}
		
	}

}