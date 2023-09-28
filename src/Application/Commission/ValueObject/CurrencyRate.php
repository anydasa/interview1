<?php

namespace Application\Commission\ValueObject;

final readonly class CurrencyRate
{
    public function __construct(
        private float $rate,
    )
    {
    }

    public function getRate(): float
    {
        return $this->rate;
    }

}