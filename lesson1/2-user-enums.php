<?php

namespace Sample2;

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
}

$u1 = new User(1, 'Dmitry', Role::ADMIN, 0);
var_dump($u1->isMale());
var_dump($u1->isAdmin());
$u1->role = Role::MANAGER;
var_dump($u1->isAdmin());
var_dump($u1->isManager());


/* $user = [
	'id' => 1,
	'name' => 'Dmitry',
	'role' => 'admin',
	'sex' => 0
];


function isMale($user){
	return $user['sex'] === 0;
}

var_dump(isMale($user)); */