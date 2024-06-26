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

	private function getCategoryId(array $revenueData): int
	{
    $query = "
			SELECT 
				id 
			FROM 
				incomes_category_assigned_to_users 
			WHERE 
				user_id = :user_id 
				AND name = :category_name
		";

    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $_SESSION['userId'], PDO::PARAM_INT);
    $stmt->bindParam(':category_name', $revenueData['category']);
    $stmt->execute();
    return (int) $stmt->fetchColumn();
	}

	private function insert(array $revenueData, int $categoryId): void
	{
		$query = "
			INSERT INTO 
				incomes (user_id, income_category_assigned_to_user_id, amount, date_of_income, income_comment)
			VALUES 
				(:user_id, :category_id, :amount, :date_of_income, :income_comment)
		";
		
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':user_id', $_SESSION['userId'], PDO::PARAM_INT);
		$stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
		$stmt->bindParam(':amount', $revenueData['amount']);
		$stmt->bindParam(':date_of_income', $revenueData['date']);
		$stmt->bindParam(':income_comment', $revenueData['comment']);
		$stmt->execute();
	}
}