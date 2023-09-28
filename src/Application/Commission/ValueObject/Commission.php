<?php

namespace Application\Commission\ValueObject;



final readonly class Commission
{
    public function __construct(private Money $money)
    {
    }

    public function getMoney(): Money
    {
        return $this->money;
    }
}