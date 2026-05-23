<?php

namespace Hw\Core;

use Hw\Traits\Singletone;

class Model{
    use Singletone;

	protected function __construct()
	{
        echo '<pre>';
        var_dump(static::class);
        echo '</pre>';
	}
}