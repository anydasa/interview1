<?php declare(strict_types=1);

namespace Infrastructure\Commission\Repository;

use Application\Commission\Repository\CurrencyRateRepository;
use Application\Commission\ValueObject\CurrencyRate;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;

final class CurrencyRateHttpRepository implements CurrencyRateRepository
{
    private ?array $cachedResponse = null;

    public function __construct(
        private readonly ClientInterface $httpClient,
        private readonly string $apiHost,
        private readonly string $apiKey
    )
    {
    }

    public function findPair(string $fromCurrency, string $toCurrency): ?CurrencyRate
    {

        if (null === $this->cachedResponse) {
            $this->fetchLastData();
        }

        return new CurrencyRate(
            $this->cachedResponse['rates'][$toCurrency]
        );
    }

    private function fetchLastData(): void
    {
        $request = new Request('GET', $this->apiHost.'?access_key='.$this->apiKey);

        $response = $this->httpClient->sendRequest($request);

        $this->cachedResponse = json_decode((string)$response->getBody(), true);
    }
}
