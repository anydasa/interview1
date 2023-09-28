<?php

namespace Application\Commission\Service;

use Application\Commission\ValueObject\Commission;
use Application\Commission\ValueObject\Transaction;

final class CalculateBatchService
{
    public function __construct(
        private readonly CalculateService $calculateService,
    )
    {
    }

    /**
     * @param Transaction[] $batch
     * @return Commission[]
     */
    public function calculateBatch(iterable $batch): iterable
    {
        foreach ($batch as $transaction) {
            yield $this->calculateService->calculate($transaction);
        }
    }
}
