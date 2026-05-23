<?php

namespace Payments;

use Core\DB;
use Core\Model;
use lesson6\Hw\Transfers\Emitter;

class OnlinePayment extends Model implements Emitter{
	public ?int $id = null;

	public function __construct(
		public int $userId, 
		public int $amount
	){} 

	public function save(){
		$db = DB::getInstance();

		if($this->id === null){
			$db->query('INSERT INTO online_payments (user_id, amount) VALUES (:userId, :amount)', [ 
				'userId' => $this->userId,
				'amount' => $this->amount
			]);

			$this->id = $db->lastInsertId();
		}
		else{
			$db->query('UPDATE online_payments SET userId=:userId,amount=:amount WHERE id=:id', [ 
				'id' => $this->id,
				'userId' => $this->userId,
				'amount' => $this->amount
			]);
		}
	}

	public function id() : int {
		return $this->id;
	}

	public function value() : int {
		return (int)($this->amount / 100);
	}

	public function userId() : int {
		return $this->userId;
	}
}