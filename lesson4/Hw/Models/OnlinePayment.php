<?php

namespace lesson4\Hw\Models;

use lesson4\Hw\Contracts\TransferEmitter;
use lesson4\Hw\Models\Model;

class OnlinePayment extends Model implements TransferEmitter
{

    public function __construct(protected float $value, protected float $date)
    {
    }

    public function getId(): int
    {
        return 199;
    }

    public function getAmount(): float
    {
        return $this->value;
    }

    public function getUser(): string
    {
        return 'manager';
    }
}