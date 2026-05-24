<?php

namespace App\Controllers;

use App\Models\CashPayment;
use Core\Template;
use Core\Validator;
use App\Requests\CashPayments\Save;

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
			$validRes = Validator::init(Save::rules(), Save::attributes())->run($_POST);
			
			if($validRes->isOk()){
				$payment = CashPayment::create($validRes->data() + [ 'user_id' => 1 ]);
				header('Location: ' . BASE_URL . '/payments/' . $payment->id);
				exit();
			}
			else{
				$errors = $validRes->errors();
				$payment = CashPayment::make($validRes->data());
			}
		}
		else{
			$payment = CashPayment::make(['value' => '', 'inn' => '', 'pass_serie' => '', 'pass_number' => '']);
			$errors = [];
		}

		echo Template::getInstance()->render('cash-payments/create', [
			'payment' => $payment,
			'errors' => $errors
		]);
	}

	public function edit(int $id){
		$payment = CashPayment::findOrFail($id); // mb 404
		$errors = [];

		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			$validRes = Validator::init(Save::rules(), Save::attributes())->run($_POST);

			if($validRes->isOk()){
				$payment->update($validRes->data());
				header('Location: ' . BASE_URL . '/payments/' . $payment->id);
				exit();
			}
			else{
				$errors = $validRes->errors();
				$payment->fill($validRes->data());
			}
		}

		echo Template::getInstance()->render('cash-payments/update', [
			'payment' => $payment,
			'errors' => $errors
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