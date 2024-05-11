<?php

declare(strict_types=1);

namespace App\Auxiliary;

class Auxiliary
{
	public static function display(): void
	{
		if(!empty($_SESSION['message'])){
			echo "</br><strong>" . $_SESSION["message"] . "</strong></br></br>";
			unset($_SESSION["message"]);
		}
	}

	public static function redirect($page): void
	{
		header("Location: /src/templates/pages/$page.php");
		exit();
	}
}