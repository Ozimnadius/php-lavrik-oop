<?php

use Dotenv\Dotenv;

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$dotenv->required(['BASE_URL', 'DB_HOST', 'DB_NAME', 'DB_USER', 'DB_PASSWORD']);

define('BASE_URL', $_ENV['BASE_URL']);

define('DB_HOST', $_ENV['DB_HOST']);
define('DB_NAME', $_ENV['DB_NAME']);
define('DB_USER', $_ENV['DB_USER']);
define('DB_PASSWORD', $_ENV['DB_PASSWORD']);

