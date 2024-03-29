<?php

declare(strict_types=1);

class View
{
	public function render(string $page): void
	{
		echo 'jestem tu 2';
		header("Location: src/templates/pages/$page.php");
	}
}