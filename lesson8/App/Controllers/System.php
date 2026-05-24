<?php

namespace App\Controllers;

use Core\Template;

class System
{
	public function error404(){
		header($_SERVER['SERVER_PROTOCOL'] . ' 404 Not Found');
		echo Template::getInstance()->render('errors/404');
	}
}