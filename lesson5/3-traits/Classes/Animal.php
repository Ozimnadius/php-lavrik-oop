<?php

namespace Classes;

use Traits\Log;

class Animal{
	use Log;

	public function __construct(public string $name, public int $health, public int $power)
	{
	}

	public function isAlive(){
		return $this->health > 0;
	}

	public function getDamage(int $damage){
		$this->health -= $damage;

		if($this->health < 0){
			$this->health = 0;
		}
	}

	public function calcDamage() : int{
		return (int)($this->power * mt_rand(10, 30) / 20);
	}
}