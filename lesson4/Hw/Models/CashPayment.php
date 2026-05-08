<?php

namespace lesson4\Hw\Models;

use lesson4\Hw\Contracts\TransferEmitter;
use lesson4\Hw\Models\Model;

class CashPayment extends Model implements TransferEmitter
{
    public function __construct(protected float $value, protected int $count, protected float $date)
    {
    }

    public function getId(): int
    {
        return 10;
    }

    public function getAmount(): float
    {
        return $this->value * $this->count;
    }

    public function getUser(): string
    {
        return 'admin';
    }
}