<?php

namespace App\Controllers;

use App\Models\CashPayment;
use Core\Template;
use Rakit\Validation\Validator;

class CashPayments
{
    // all items
    public function index()
    {
        echo Template::getInstance()->render('cash-payments/index', [
            'payments' => CashPayment::all()
        ]);
    }

    public function show(int $id)
    {
        $payment = CashPayment::findOrFail($id);

        echo Template::getInstance()->render('cash-payments/show', [
            'payment' => $payment
        ]);
    }

    public function create()
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator();
            $data = array_filter($_POST, fn($v) => $v !== '');

            $validation = $validator->make($data, [
                'value' => 'required|numeric|min:1',
                'inn'   => 'required_without:snils|digits:12',
                'snils' => 'required_without:inn|digits:11',
            ]);

            $validation->validate();

            if ($validation->fails()) {
                $errors = $validation->errors()->all();
                $fields = ['value' => $_POST['value'] ?? ''];
            } else {
                $fields = [
                    'value'  => $_POST['value'],
                    'inn'    => $_POST['inn'] ?? null,
                    'snils'  => $_POST['snils'] ?? null,
                    'user_id' => 1
                ];
                $payment = CashPayment::create($fields);
                header('Location: ' . BASE_URL . '/payments/' . $payment->id);
                exit();
            }
        } else {
            $fields = ['value' => ''];
            $errors = [];
        }

        echo Template::getInstance()->render('cash-payments/create', [
            'fields' => $fields,
            'errors' => $errors,
        ]);
    }

    public function edit(int $id)
    {
        $payment = CashPayment::findOrFail($id); // mb 404
        $errors = [];


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $validator = new Validator();
            $data = array_filter($_POST, fn($v) => $v !== '');

            $validation = $validator->make($data, [
                'value' => 'required|numeric|min:1',
                'inn'   => 'required_without:snils|digits:12',
                'snils' => 'required_without:inn|digits:11',
            ]);
            $validation->validate();

            if ($validation->fails()) {
                $errors = $validation->errors()->all();
                $payment->value = $_POST['value'] ?? '';
                $payment->inn   = $_POST['inn'] ?? '';
                $payment->snils = $_POST['snils'] ?? '';
            } else {
                $payment->value = $_POST['value'];
                $payment->inn   = $_POST['inn'] ?? null;
                $payment->snils = $_POST['snils'] ?? null;
                $payment->save();
                header('Location: ' . BASE_URL . '/payments/' . $payment->id);
                exit();
            }
        }

        echo Template::getInstance()->render('cash-payments/update', [
            'payment' => $payment,
            'errors'  => $errors,
        ]);
    }

    // destroy item by id
    public function destroy()
    {

    }

    /*// show form for creating
    public function create(){

    }

    // in real -> POST -> save in DB
     public function store(){

    } */
}