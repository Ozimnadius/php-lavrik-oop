<?php

namespace System;

interface EventTarget{
	public function addEventListener(string $name, callable $fn) : void;
	public function removeEventListenr(string $name, callable $fn) : void;
	public function dispatchEvent(Event $event) : void;
}