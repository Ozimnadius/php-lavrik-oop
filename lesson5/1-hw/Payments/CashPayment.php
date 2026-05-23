<?php

namespace Payments;

use Core\DB;
use Core\Model;
use lesson6\Hw\Transfers\Emitter;

class CashPayment extends Model implements Emitter{
	public ?int $id = null;

	public function __construct(
		public int $userId, 
		public int $value
	){} 

	public function save(){
		$db = DB::getInstance();

		if($this->id === null){
			$db->query('INSERT INTO cash_payment (user_id, value) VALUES (:userId, :value)', [ 
				'userId' => $this->userId,
				'value' => $this->value
			]);

			$this->id = $db->lastInsertId();
		}
		else{
			$db->query('UPDATE cash_payment SET userId=:userId,value=:value WHERE id=:id', [ 
				'id' => $this->id,
				'userId' => $this->userId,
				'value' => $this->value
			]);
		}
	}

	public function id() : int {
		return $this->id;
	}

	public function value() : int {
		return $this->value;
	}

	public function userId() : int {
		return $this->userId;
	}

}