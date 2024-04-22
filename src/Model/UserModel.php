<?php 

declare(strict_types=1);

namespace App\Model;

use PDO;

session_start();

class UserModel
{
	private $conn;

	public function __construct()
	{
		$this->createConnectionToDB();
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

	public function login(array $loginData): bool
	{
		$query = "SELECT users.id FROM users WHERE username = :username AND password = :password";
		$stmt = $this->conn->prepare($query);
		$stmt->bindParam(':username', $loginData['username']);
		$stmt->bindParam(':password', $loginData['password']);
		$stmt->execute();
		$result = $stmt->fetch(PDO::FETCH_ASSOC);

		if($result != 0){
			return true;
		} else {
			return false;
		} 
	}

	private function createConnectionToDB(): void
	{
		$config = require_once("../../config/config.php");
		$dsn = "mysql:dbname={$config['db']['database']};host={$config['db']['host']}";
		$this->conn = new PDO(
			$dsn,
			$config['db']['user'],
			$config['db']['password'],
			[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION 
			]
		);
	}
}