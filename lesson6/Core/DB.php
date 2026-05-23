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
		$this->db = new PDO('mysql:host=localhost;dbname=oop202304', 'root', '', [
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
		
		$this->db->exec('SET NAMES UTF8');
	}
	
	public function query(string $sql, array $params = []) : PDOStatement{
		$query = $this->db->prepare($sql);
		$query->execute($params);
		$this->checkError($query);
		return $query;
	}
	
	public function checkError(PDOStatement $query) : bool{
		$errInfo = $query->errorInfo();
	
		if($errInfo[0] !== PDO::ERR_NONE){
			echo $errInfo[2];
			exit(); //:todo exception
		}
	
		return true;
	}
}