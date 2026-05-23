<?php

namespace lesson5-HW\Hw\Traits-HW\Hw\Traits-HW\Hw\Traits;

trait Singletone
{
    private static array $instances = [];

    public static function getInstance(): static
    {
        $class = static::class; // 'UserModel', 'PostModel' и т.д.
        if (!isset(self::$instances[$class])) {
            self::$instances[$class] = new static();
        }
        return self::$instances[$class];
    }

    protected function __construct() {
    }
}