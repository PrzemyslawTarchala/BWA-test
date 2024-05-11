<?php

declare(strict_types=1);

namespace App\Model;

require_once("src/Exception/StorageException.php");
require_once("src/Exception/ConfigurationException.php");

use PDO;
use App\Exception\StorageException;
use App\Exception\ConfigurationException;

class AbstractModel
{
	protected $conn;

	public function __construct(array $config)
	{
		try{
			$this->validateConfig($config);
			$this->createConnection($config);
		} catch(PDOException $e) {
			throw new StorageException('Connection Error');
		}
	}

	protected function createConnection(array $config): void
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

	protected function validateConfig(array $config): void
	{
		if(empty($config['database']) || empty($config['host']) || empty($config['user']) || empty($config['password'])){
			throw new ConfigurationException('Storage configuration error');
		}
	}
} 