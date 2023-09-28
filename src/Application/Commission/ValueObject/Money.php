<?php

namespace Application\Commission\ValueObject;

final readonly class Money
{
    public function __construct(
        private float $amount,
        private string $currency,
    )
    {
    }

    public function getAmount(): float
    {
        return $this->amount;
    }

    public function getCurrency(): string
    {
        return $this->currency;
    }

    public function isCurrencySame(string $currency): bool
    {
        return $this->currency === $currency;
    }

    public function multipliedBy(float $that): self
    {
        return new self(
            $this->amount * $that,
            $this->currency
        );
    }
}