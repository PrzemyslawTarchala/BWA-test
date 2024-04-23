<?php

declare(strict_types=1);

namespace App\Model;

use PDO;

class RevenueModel
{
	private $conn;

	public function __construct(array $config)
	{
		$this->createConnection($config);
	}


	private function createConnection(array $config): void
	{
		$dsn = "mysql:dbname={$config['database']};host={$config['host']}";
		$this->conn = new PDO(
			$dsn,
			$config['user'],
			$config['password'],
			[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION //Przy polaczeniu ustwaione wszystkie "error'y" będa traktowane jako "exception"
			]
		);
	}
}