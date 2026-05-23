<?php

namespace App\Controllers;

use App\Models\CashPayment;
use Core\Template;

class CashPayments
{
	// all items
	public function index(){
		echo Template::getInstance()->render('cash-payments/index', [
			'payments' => CashPayment::all()
		]);
	}

	public function show(int $id){
		$payment = CashPayment::findOrFail($id);

		echo Template::getInstance()->render('cash-payments/show', [
			'payment' => $payment
		]);
	}

	public function create(){
		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$fields = [ 'value' => $_POST['value'], 'user_id' => 1 ];
			$payment = CashPayment::create($fields);
			//var_dump($payment->refresh());
			header('Location: ' . BASE_URL . '/payments/' . $payment->id);
			exit();
		}
		else{
			$fields = [ 'value' => '' ];
		}

		echo Template::getInstance()->render('cash-payments/create', [
			'fields' => $fields
		]);
	}

	public function edit(int $id){
		$payment = CashPayment::findOrFail($id); // mb 404

		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			//todo: validation here
			$payment->value = $_POST['value'];
			$payment->save();
			header('Location: ' . BASE_URL . '/payments/' . $payment->id);
			exit();
		}
		else{
			// show form
		}

		echo Template::getInstance()->render('cash-payments/update', [
			'payment' => $payment
		]);
	}

	// destroy item by id
	public function destroy(){

	}

	/*// show form for creating
	public function create(){

	}

	// in real -> POST -> save in DB
	 public function store(){

	} */
}