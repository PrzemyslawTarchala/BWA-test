<?php

declare(strict_types=1);

namespace App\Model;

require_once("src/Model/AbstractModel.php");
require_once("src/Utils/debug.php");

use PDO;
use App\Model\AbstractModel;

class RevenueModel extends AbstractModel
{
	public function addRevenue(array $revenueData)
	{
		$categoryId = $this->getCategoryId($revenueData);
		$this->insert($revenueData, $categoryId);
	}

	public function getIncomesCategory(): array
	{
    $loggedUserId = $_SESSION['userId'];
    $query = "SELECT income_category_assigned_to_user_id FROM incomes WHERE user_id = :user_id";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
    $stmt->execute();
    $result = $stmt->fetchAll(PDO::FETCH_COLUMN);
    return array_unique($result);
	}
	
	private function insert(array $revenueData, int $categoryId): void
	{
		$loggedUserId = $_SESSION['userId'];
		$query = "INSERT INTO incomes (user_id, income_category_assigned_to_user_id, amount, date_of_income, income_comment)
							VALUES (:user_id, :category_id, :amount, :date_of_income, :income_comment)";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
		$stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
		$stmt->bindParam(':amount', $revenueData['amount']);
		$stmt->bindParam(':date_of_income', $revenueData['date']);
		$stmt->bindParam(':income_comment', $revenueData['comment']);
		$stmt->execute();
	}
}