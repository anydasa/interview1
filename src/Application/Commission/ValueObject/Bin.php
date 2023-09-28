<?php declare(strict_types=1);

namespace Application\Commission\ValueObject;

final readonly class Bin
{
    public function __construct(
        private string $countryAlpha2,
    )
    {
    }

    public function getCountryAlpha2(): string
    {
        return $this->countryAlpha2;
    }
}
