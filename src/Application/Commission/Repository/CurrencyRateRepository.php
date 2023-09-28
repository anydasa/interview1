<?php declare(strict_types = 1);

namespace Application\Commission\Repository;

use Application\Commission\ValueObject\CurrencyRate;

interface CurrencyRateRepository
{
    public function findPair(string $fromCurrency, string $toCurrency): ?CurrencyRate;
}
