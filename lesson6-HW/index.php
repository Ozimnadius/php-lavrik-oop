<?php

use App\Controllers\CashPayments;

include_once('bootstrap.php');

/* use App\Models\CashPayment;
use App\Models\User;

$user = User::find(1);
$user->save();

$cp = CashPayment::find(1);
$cp->user_id = 2;
$cp->value = 2000;
$cp->save(); */

$cashPaymentsController = new CashPayments();

// echo $cashPaymentsController->show();
// echo $cashPaymentsController->index();

$action = $_GET['action'] ?? 'index';

echo $cashPaymentsController->$action();