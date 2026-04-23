<?php

namespace Sample4;

class Math{
	public const PI = 3.14;
	/* public static float $pi = 3.14; */

	public static function round(float $x) : int{
		return (int)($x);
	}	

	public static function rangeLength(float $r) : float{
		return 2 * $r * self::PI;
	}
}

/* $math = new Math();
echo $math->pi; */

echo Math::round(5.5) . '<br>';
/* echo Math::$pi . '<br>'; */
echo Math::PI . '<br>';
echo Math::rangeLength(5) . '<br>';