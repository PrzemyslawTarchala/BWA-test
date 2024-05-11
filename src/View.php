<?php

declare(strict_types=1);

namespace App;

class View
{
	public function render(string $page, ?array $param = null): void
	{
		header("Location: src/templates/pages/$page.php");
	}
}
