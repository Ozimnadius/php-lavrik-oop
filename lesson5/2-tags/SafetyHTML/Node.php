<?php

namespace SafetyHTML;

use System\Event;
use System\EventTarget;

abstract class Node implements EventTarget{
	abstract public function render();
	abstract public function isValid() : bool;

	protected array $listeners = [];

	public function addEventListener(string $name, callable $fn) : void{
		if(!isset($this->listeners[$name])){
			$this->listeners[$name] = [];
		}

		$this->listeners[$name][] = $fn;
	}

	public function removeEventListenr(string $name, callable $fn) : void{
		if(!isset($this->listeners[$name])){
			return;
		}

		// foreach -> remove fn from 
	}

	public function dispatchEvent(Event $event) : void{
		if(isset($this->listeners[$event->name])){
			foreach($this->listeners[$event->name] as $listener){
				$listener($event);
			}
		}
	}

	protected function sanitize(string $inp) : string{
		return trim(htmlspecialchars($inp));
	}
}