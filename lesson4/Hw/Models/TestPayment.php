<?php

namespace lesson4\Hw\Models;

use lesson4\Hw\Contracts\TransferEmitter;

class TestPayment implements TransferEmitter
{
    public function getId(): int
    {
        return 1;
    }

    public function getAmount(): float
    {
        return 1.0;
    }

    public function getUser(): string
    {
        return 'test';
    }
}