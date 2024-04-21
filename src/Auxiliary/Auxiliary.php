<?php

declare(strict_types=1);

class AuxiliaryMethod 
{
	public static function display(): void
	{
		if(!empty($_SESSION['message'])){
			echo "</br>" . $_SESSION["message"] . "</br></br>";
			unset($_SESSION["message"]);
		}
	}
}