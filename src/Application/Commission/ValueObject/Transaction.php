<?php

namespace Application\Commission\ValueObject;


final readonly class Transaction
{
    public function __construct(
        private int $bin,
        private Money $money,
    )
    {
    }

    public function getBin(): string
    {
        return $this->bin;
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}
