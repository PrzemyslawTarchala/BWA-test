<?php

declare(strict_types=1);

namespace App\Model;

require_once("src/Model/AbstractModel.php");

use App\Model\AbstractModel;

class ExpenseModel extends AbstractModel
{
	public function addExpense(array $expenseData)
	{
		echo('Expense Model');
		exit();
	}
}