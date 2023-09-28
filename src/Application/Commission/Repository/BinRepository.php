<?php declare(strict_types = 1);

namespace Application\Commission\Repository;

use Application\Commission\ValueObject\Bin;

interface BinRepository
{
    public function find(int $binNumber): ?Bin;
}
