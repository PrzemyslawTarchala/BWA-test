<?php

declare(strict_types=1);

namespace App\Model;

require_once("src/Model/AbstractModel.php");

use PDO;
use App\Model\AbstractModel;

class RevenueModel extends AbstractModel
{
	public function addRevenue(array $revenueData)
	{
		$categoryId = $this->getCategoryId($revenueData);
		$this->insert($revenueData, $categoryId);
	}

	private function getCategoryId(array $revenueData): int
	{
		$loggedUserId = $_SESSION['userId'];
    $query = "SELECT id FROM incomes_category_assigned_to_users WHERE user_id = :user_id AND name = :category_name";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
    $stmt->bindParam(':category_name', $revenueData['category']);
    $stmt->execute();
    return (int) $stmt->fetchColumn();
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