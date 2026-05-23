<?php

use Hw\Core\Model;
use \Hw\Core\DB;
use \Hw\Core\UserModel;

spl_autoload_register(function ($name) {
    $path = __DIR__ . '/../' . str_replace('\\', '/', $name) . '.php';
    include_once($path);
});

$model1 = Model::getInstance();
$model2 = Model::getInstance();
$userModel = UserModel::getInstance();

$db = DB::getInstance();
$db2 = DB::getInstance();

try {
//    new DB();
} catch (\Error $e) {
    echo "Ожидаемая ошибка: " . $e->getMessage();
}
