<?php

declare(strict_types=1);

class View
{
	public function render(string $page): void
	{
		header("Location: src/templates/pages/$page.php");
	}
}
