<?php

namespace Sample3;
use PDO;
use PDOStatement;

enum Role : int{
	case SIMPLE = 1;
	case MANAGER = 2;
	case ADMIN = 3;
}

class User
{
	public int $id;
	public string $name;
	public Role $role;
	protected int $sex;

	public function __construct(int $id, string $name, Role $role, int $sex)
	{
		$this->id = $id;
		$this->name = $name;
		$this->role = $role;
		$this->sex = $sex;
	}

	public function isMale(){
		return $this->sex === 0;
	}

	public function isFemale(){
		return $this->sex === 1;
	}

	public function isAdmin(){
		return $this->role === Role::ADMIN;
	}

	public function isManager(){
		return $this->role === Role::MANAGER;
	}

	public function save(){
		dbQuery('UPDATE users SET name=:name,role=:role,sex=:sex WHERE id=:id', [ 
			'id' => $this->id,
			'name' => $this->name,
			'role' => $this->role->value,
			'sex' => $this->sex,
		]);
	}
}

function loadUser(int $id) : ?User{
	$query = dbQuery('SELECT * FROM users WHERE id=:id', [ 'id' => $id ]);
	$row = $query->fetch();

	if($row === false){
		return null;
	}

	return new User($row['id'], $row['name'], Role::from($row['role']), $row['sex']);
}

function dbInstance() : PDO{
	static $db;
	
	if($db === null){
		$db = new PDO('mysql:host=localhost;dbname=oop202304', 'root', '', [
			PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
		]);
		
		$db->exec('SET NAMES UTF8');
	}
	
	return $db;
}

function dbQuery(string $sql, array $params = []) : PDOStatement{
	$db = dbInstance();
	$query = $db->prepare($sql);
	$query->execute($params);
	dbCheckError($query);
	return $query;
}

function dbCheckError(PDOStatement $query) : bool{
	$errInfo = $query->errorInfo();

	if($errInfo[0] !== PDO::ERR_NONE){
		echo $errInfo[2];
		exit();
	}

	return true;
}

$u1 = loadUser(1);
$u1->role = Role::ADMIN;
$u1->save();
var_dump($u1->isAdmin());