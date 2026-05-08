<?php

namespace Traits;

trait Log{
	public function log(){
		echo '<h2>' . static::class . '</h2>';
		echo '<ul>';
		
		foreach($this as $name => $value){
			echo "<li><strong>$name</strong>: " . $value . "</li>";
		}

		echo '</ul>';
	}

	public function some(){
		
	}
}