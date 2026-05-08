<?php

namespace Core;

class Model{
	protected static ?self $instance = null;

	public static function getInstance() : self{
		if(self::$instance === null){
			self::$instance = new self();
		}

		return self::$instance;
	}

	protected function __construct()
	{

	}
}