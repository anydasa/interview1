<?php

namespace Application\Commission\Service;


use Application\Commission\Repository\CurrencyRateRepository;
use Application\Commission\ValueObject\Money;


final readonly class MoneyConverterService
{
    private const DEFAULT_BASE_CURRENCY = 'EUR';

    public function __construct(
        private CurrencyRateRepository $currencyRateRepository,
        private string $baseCurrency = self::DEFAULT_BASE_CURRENCY,
    )
    {
    }

    public function convertToBase(Money $money): Money
    {
        if ($money->isCurrencySame($this->baseCurrency)) {
            return $money;
        }

        $currencyRate = $this->currencyRateRepository->findPair($this->baseCurrency, $money->getCurrency());

        return new Money(
            (float) bcmul($money->getAmount(), $currencyRate->getRate(), 8),
            $this->baseCurrency
        );
    }
}