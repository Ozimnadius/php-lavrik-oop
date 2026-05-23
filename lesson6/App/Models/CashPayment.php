<?php

namespace App\Models;

use Core\Model;

class CashPayment extends Model
{
	protected static string $table = 'cash_payments';

	public function user(){
		return User::find($this->user_id);
	}
}