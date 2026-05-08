<?php

namespace Traits;

trait NiceLog{
	public function log(){
		echo '<h1>' . static::class . '</h1>';
		var_dump($this);
	}
}