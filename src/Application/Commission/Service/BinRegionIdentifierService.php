<?php

namespace Application\Commission\Service;

use Application\Commission\ValueObject\Bin;

final readonly class BinRegionIdentifierService
{
    private const EU_COUNTY_LIST = [
        'AT', 'BE', 'BG', 'CY', 'CZ', 'DE', 'DK', 'EE', 'ES', 'FI', 'FR', 'GR', 'HR', 'HU', 'IE', 'IT', 'LT', 'LU', 'LV', 'MT', 'NL', 'PO', 'PT', 'RO', 'SE', 'SI', 'SK'
    ];

    public function isEurope(Bin $bin): bool
    {
        return in_array($bin->getCountryAlpha2(), self::EU_COUNTY_LIST, true);
    }
}
