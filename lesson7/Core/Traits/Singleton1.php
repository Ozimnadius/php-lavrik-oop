<?php

namespace Core\Traits;

trait Singleton
{
	protected static ?self $instance = null;

	public static function getInstance() : self{
		if(self::$instance === null){
			self::$instance = new self();
		}

		return self::$instance;
	}

	protected function __construct(){}
	protected function __clone(){}
}