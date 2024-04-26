<?php 

declare(strict_types=1);

namespace App\Model;

require_once("src/Model/AbstractModel.php");

use PDO;
use App\Model\AbstractModel;

class UserModel extends AbstractModel
{
	public function login(array $loginData): array
	{
		$query = "SELECT users.id FROM users WHERE username = :username AND password = :password";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':username', $loginData['username']);
		$stmt->bindParam(':password', $loginData['password']);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		return $result;
	}

	public function register(array $registerData): void 
	{	
		$query = "INSERT INTO users(username, password, email) VALUES(:username, :password, :email)";
    $stmt = $this->conn->prepare($query);
    $stmt->bindParam(':username', $registerData['username']);
    $stmt->bindParam(':password', $registerData['password']);
    $stmt->bindParam(':email', $registerData['email']);
    $stmt->execute();
	}

	public function isNewUsernameAvailiabity(string $newUsername): bool
	{
		$query = "SELECT users.username FROM users WHERE username = :username";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':username', $newUsername);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($result == ''){
			return false;
		} else {
			return true;
		}
	}

	public function isNewEmailAvailiabity(string $newEmail): bool
	{
		$query = "SELECT users.email FROM users WHERE email = :email";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':email', $newEmail);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($result == ''){
			return false;
		} else {
			return true;
		}
	}
 }