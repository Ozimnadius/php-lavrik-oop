<?php

namespace Transfers;

interface Emitter{
	public function id() : int;
	public function value() : int;
	public function userId() : int;
}