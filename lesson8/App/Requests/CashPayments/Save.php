<?php

namespace App\Requests\CashPayments;

class Save
{
	public static function rules(){
		return [
			'value' => 'required|integer|min:500',
			'inn' => 'between:10,12|required_without:pass_serie,pass_number',
			'pass_serie' => 'required_without:inn|min:4',
			'pass_number' => 'required_without:inn|min:6'
		];
	}

	public static function attributes(){
		return [
			'value' => 'Сумма'
		];
	}
}