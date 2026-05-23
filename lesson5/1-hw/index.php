<?php

use lesson6\Hw\Payments\CashPayment;
use lesson6\Hw\Payments\OnlinePayment;
use lesson6\Hw\Transfers\MakeTransfersListener;

spl_autoload_register(function($name){
	$path = str_replace('\\', '/', $name) . '.php';
	include_once($path);
});

$cashPayment = new CashPayment(1, 5000);
$cashPayment->save();


new MakeTransfersListener($cashPayment);
/*
echo '<pre>';
var_dump($cashPayment);
echo '</pre>';
  */

$onlinePayment = new OnlinePayment(1, 100000);
$onlinePayment->save();

new MakeTransfersListener($onlinePayment);