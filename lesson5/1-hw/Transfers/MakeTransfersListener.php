<?php

namespace Transfers;

class MakeTransfersListener{
	public function __construct(Emitter $transferEmitter)
	{
		$id = $transferEmitter->id();
		$type = $transferEmitter::class;
		$uid = $transferEmitter->userId();
		$value = $transferEmitter->value();
		// process this transferv
		var_dump($id, $type, $uid,$value );
	}
}