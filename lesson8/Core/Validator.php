<?php

namespace Core;

use Rakit\Validation\Validator as RakitValidator;

class Validator
{
	protected RakitValidator $validator;

	public static function init(array $schema, array $aliases = []){
		return new static($schema, $aliases);
	}

	public function __construct(protected array $schema, protected array $aliases)
	{
		$this->validator = new RakitValidator();
		$pathToMessages = 'lang/' . LANG . '/validation.php';

		if(file_exists($pathToMessages)){
			$messages = include($pathToMessages);
			$this->validator->setMessages($messages);
		}
	}

	public function run(array $data) : ValidatorResult{
		$validation = $this->validator->make($data, $this->schema);
		$validation->setAliases($this->aliases);
		$validation->validate();
		
		if ($validation->fails()) {
			$errors = $validation->errors()->firstOfAll();
			return new ValidatorResult(false, $validation->getValidatedData(), $errors);
		} else {
			return new ValidatorResult(true, $validation->getValidData(), []);
		}
	}
}