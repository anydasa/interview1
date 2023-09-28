<?php

namespace Application\Commission\Service;

use Application\Commission\ValueObject\Commission;
use Application\Commission\ValueObject\Transaction;
use Application\Commission\Repository\BinRepository;

final readonly class CalculateService
{
    public function __construct(
        private BinRepository              $binRepository,
        private BinRegionIdentifierService $binRegionIdentifierService,
        private MoneyConverterService      $converterService,
    )
    {
    }


    public function calculate(Transaction $transaction): Commission
    {
        $baseTransactionMoney = $this->converterService->convertToBase($transaction->getMoney());

        $commission = $baseTransactionMoney->multipliedBy($this->getCommissionRate($transaction));

        return new Commission($commission);
    }

    private function getCommissionRate(Transaction $transaction): float
    {
        $bin = $this->binRepository->find($transaction->getBin());

        if ($bin && $this->binRegionIdentifierService->isEurope($bin)) {
            return 0.01;
        }

        return 0.02;
    }
}
