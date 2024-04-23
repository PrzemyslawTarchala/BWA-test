<?php

declare(strict_types=1);

namespace App\Controller;

require_once("src/Model/RevenueModel.php");

use App\Model\RevenueModel;

class RevenueController
{
	private RevenueModel $revenue;

	public function __construct(array $config)
	{
		$this->revenue = new RevenueModel($config);
	}
}