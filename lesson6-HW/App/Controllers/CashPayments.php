<?php

namespace App\Controllers;

use App\Models\CashPayment;
use Core\Template;

class CashPayments
{
	// all items
	public function index(){
		return Template::getInstance()->render('cash-payments/index', [
			'payments' => CashPayment::all()
		]);
	}

	// one item by id
	public function show(){
		$payment = CashPayment::find($_GET['id']); // mb 404

		return Template::getInstance()->render('cash-payments/show', [
			'payment' => $payment
		]);
	}

	public function create(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            $fields = [ 'value' => $_POST['value'], 'user_id' => 1 ];
            $payment = CashPayment::create($fields);
            //var_dump($payment->refresh());
            header('Location: index.php');
            exit();
        }
        else{
            $fields = [ 'value' => '' ];
        }

        echo Template::getInstance()->render('cash-payments/create', [
            'fields' => $fields
        ]);
	}

	public function update(){
		$payment = CashPayment::find($_GET['id']); // mb 404

		if($_SERVER['REQUEST_METHOD'] === 'POST'){
			//todo: validation here
			$payment->value = $_POST['value'];
			$payment->save();
			header('Location: index.php' . '?id=' . $_GET['id']);
			exit();
		}
		else{
			// show form
		}

		return Template::getInstance()->render('cash-payments/update', [
			'payment' => $payment
		]);
	}

	// destroy item by id
	public function destroy(){
        $payment = CashPayment::find($_GET['id']);
        $payment->destroy();
        header('Location: index.php');
        exit();
	}

	/*// show form for creating
	public function create(){

	}

	// in real -> POST -> save in DB
	 public function store(){

	} */
}