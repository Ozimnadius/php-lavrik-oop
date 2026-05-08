<?php

namespace lesson4\Hw\Models;

use lesson4\Hw\Contracts\TransferEmitter;
use lesson4\Hw\Models\Model;

class CreditPayment extends Model implements TransferEmitter
{
    public function __construct(protected float $sum)
    {
    }

    public function getId(): int
    {
        return 99;
    }

    public function getAmount(): float
    {
        return $this->sum;
    }

    public function getUser(): string
    {
        return 'user';
    }
}