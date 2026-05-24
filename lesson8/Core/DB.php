<?php

namespace Core;

use Core\Traits\Singleton;
use PDO;
use PDOStatement;

class DB
{
	use Singleton;
	protected PDO $db;

	protected function __construct()
	{
		$this->db = new PDO('mysql:host=' . DB_HOST . ';dbname=' . DB_NAME, DB_USER, DB_PASSWORD, [
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
			PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		]);
		
		$this->db->exec('SET NAMES UTF8');
	}
	
	public function query(string $sql, array $params = []) : PDOStatement{
		$query = $this->db->prepare($sql);
		$query->execute($params);
		return $query;
	}

	public function lastInsertId() : int{
		return (int)$this->db->lastInsertId();
	}	
}