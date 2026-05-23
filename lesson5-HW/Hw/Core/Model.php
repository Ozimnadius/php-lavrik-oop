<?php

namespace lesson5-HW\Hw\Core-HW\Hw\Core-HW\Hw\Core;

use HW\Hw\Traits\Singletone;

class Model{
    use Singletone;

	protected function __construct()
	{
        echo '<pre>';
        var_dump(static::class);
        echo '</pre>';
	}
}