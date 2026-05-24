<?php

namespace Core;

class ValidatorResult{
	public function __construct(
		protected bool $result, 
		protected array $data,
		protected array $errors
	){}

	public function isOk(){
		return $this->result;
	}

	public function data(){
		return $this->data;
	}

	public function errors(){
		return $this->errors;
	}
}