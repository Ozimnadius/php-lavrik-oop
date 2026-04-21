<?php

declare(strict_types=1);

/* new PDO(, [
	PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]) */
/*
	0 -> new
	1 -> activated
	2 -> baned
*/

class UserStatuses{
	const CREATED = 0;
	const ACTIVATED = 1;
	const BANED = 2;
}

class User{
	public $id;
	public $login;
	public $name;
	public $created;
	private $status;
	private $now;

	public function __construct(int $id, string $login, string $name, int $status, int $created){
		$this->id = $id;
		$this->login = $login;
		$this->name = $name;
		$this->status = $status;
		$this->created = $created;
		$this->now = time();
	}

	public function isActive(){
		return $this->status == UserStatuses::ACTIVATED;
	}

	public function activate(){
		$this->status = UserStatuses::ACTIVATED;
	}

	public function ban(){
		$this->status = UserStatuses::BANED;
	}

	public function save(){
		// save db
	}
}

$user1 = new User(1, 'admin', 'Dmitry', 0, 1635961129);
$user1->activate();
echo '<pre>';
print_r($user1);
echo '</pre>';

//echo $user1->status;

/* $user2 = new User(2, 'maganer', 'Some', 0, 1635962129);
echo '<pre>';
print_r($user2);
echo '</pre>'; */