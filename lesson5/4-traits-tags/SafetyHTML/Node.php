<?php

namespace SafetyHTML;

use System\EventTarget;

abstract class Node implements EventTarget{
	use \System\Traits\EventTarget;

	abstract public function render();
	abstract public function isValid() : bool;

	protected function sanitize(string $inp) : string{
		return trim(htmlspecialchars($inp));
	}
}