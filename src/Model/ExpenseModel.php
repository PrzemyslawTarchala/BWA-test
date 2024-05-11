<?php

declare(strict_types=1);

namespace App\Model;

require_once("src/Model/AbstractModel.php");

use App\Model\AbstractModel;
use PDO;

class ExpenseModel extends AbstractModel
{
	public function addExpense(array $expenseData): void
	{
		$categoryId = $this->getCategoryId($expenseData);
		$paymentMethodId = $this->getPaymentMethodId($expenseData);
		$this->insert($expenseData, $categoryId, $paymentMethodId);
	}

	private function getCategoryId(array $expenseData): int
	{
		$loggedUserId = $_SESSION['userId'];
    $query = "SELECT id FROM expenses_category_assigned_to_users WHERE user_id = :user_id AND name = :category_name";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
    $stmt->bindParam(':category_name', $expenseData['category']);
    $stmt->execute();
    return (int)$stmt->fetchColumn();
	}

	private function getPaymentMethodId(array $expenseData): int
	{
		$loggedUserId = $_SESSION['userId'];
		$query = "SELECT id FROM payment_methods_assigned_to_users WHERE user_id = :userId AND name = :paymentMethod";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':userId', $loggedUserId, PDO::PARAM_INT);
    $stmt->bindParam(':paymentMethod', $expenseData['paymentMethod']);
    $stmt->execute();
    return (int) $stmt->fetchColumn();
	}

	private function insert(array $expenseData, int $categoryId, int $paymentMethodId): void
	{
		$loggedUserId = $_SESSION['userId'];
    $query = "INSERT INTO expenses (user_id, expense_category_assigned_to_user_id, payment_method_assigned_to_user_id, amount, date_of_expense, expense_comment)
              VALUES (:user_id, :category_id, :payment_method_id, :amount, :date_of_expense, :expense_comment)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':user_id', $loggedUserId, PDO::PARAM_INT);
    $stmt->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
		$stmt->bindParam(':payment_method_id', $paymentMethodId, PDO::PARAM_INT);
    $stmt->bindParam(':amount', $expenseData['amount']);
    $stmt->bindParam(':date_of_expense', $expenseData['date']);
    $stmt->bindParam(':expense_comment', $expenseData['comment']);
    $stmt->execute();
	}
}