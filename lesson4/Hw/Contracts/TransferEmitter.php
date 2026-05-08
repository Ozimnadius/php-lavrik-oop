<?php

namespace lesson4\Hw\Contracts;

interface TransferEmitter
{
    public function getId(): int;
    public function getAmount(): float;
    public function getUser(): string;
}