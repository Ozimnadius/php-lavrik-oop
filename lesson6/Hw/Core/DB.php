<?php

namespace Hw\Core;

use Hw\Traits\Singletone;
use PDO;
use PDOStatement;

class DB{
	protected PDO $db;
	use Singletone;

	protected function __construct()
	{
//		$this->db = new PDO('mysql:host=localhost;dbname=oop202304', 'root', '', [
//			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
//		]);
//
//		$this->db->exec('SET NAMES UTF8');
        echo '<pre>';
		var_dump(static::class);
        echo '</pre>';
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
			exit();
		}
	
		return true;
	}

	public function lastInsertId() : int{
		return (int)$this->db->lastInsertId();
	}
}