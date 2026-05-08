<?php

abstract class Node extends EventTarget{
	abstract public function render();
	abstract public function isValid() : bool;

	protected function sanitize(string $inp) : string{
		return trim(htmlspecialchars($inp));
	}
}