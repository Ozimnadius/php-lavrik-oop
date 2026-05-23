<?php

namespace Core;

use Core\Traits\Singleton;

class Template
{
	use Singleton;

	public function render($pathToTemplateNooneCanRepeat, $varsToTemplateNooneCanRepeat = []){
		ob_start();
		extract($varsToTemplateNooneCanRepeat);
		include_once("resources/views/$pathToTemplateNooneCanRepeat.php");
		return ob_get_clean();
	}
}