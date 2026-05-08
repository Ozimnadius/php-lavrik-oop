<?php

namespace lesson4\Hw;

use lesson4\Hw\Contracts\TransferEmitter;
use lesson4\Hw\Models\CashPayment;
use lesson4\Hw\Models\CreditPayment;
use lesson4\Hw\Models\OnlinePayment;
use lesson4\Hw\Models\TestPayment;

spl_autoload_register(function ($name) {
    $path = $_SERVER['DOCUMENT_ROOT'] . '/' . str_replace('\\', '/', $name) . '.php';
    include_once($path);
});

function processPayment(TransferEmitter $payment): void
{
    // Логируем данные через методы интерфейса:
    echo 'Payment ID: ' . $payment->getId();
    echo '<br>';
    echo 'Payment Amount: ' . $payment->getAmount();
    echo '<br>';
    echo 'Payment User: ' . $payment->getUser();
    echo '<hr>';
}

processPayment(new OnlinePayment(1000.50, time()));
processPayment(new CashPayment(99.01, 3, time()));
processPayment(new CreditPayment(100.50));
processPayment(new TestPayment());



