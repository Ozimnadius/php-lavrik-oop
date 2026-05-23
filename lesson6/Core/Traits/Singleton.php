<?php

namespace Core\Traits;

trait Singleton
{
	protected static ?self $instance = null;

	public static function getInstance() : static{
		if(static::$instance === null){
			static::$instance = new static();
		}

		return static::$instance;
	}

	protected function __construct(){}
	protected function __clone(){}
}