<?php

namespace App\DTO;

class ExchangeRateDTO
{
    public function __construct(
        public readonly string $base,
        public readonly array $rates,
        public readonly int $timestamp
    ) {}
}
