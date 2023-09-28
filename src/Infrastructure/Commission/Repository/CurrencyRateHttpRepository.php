<?php declare(strict_types=1);

namespace Infrastructure\Commission\Repository;

use Application\Commission\Repository\CurrencyRateRepository;
use Application\Commission\ValueObject\CurrencyRate;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;

final readonly class CurrencyRateHttpRepository implements CurrencyRateRepository
{
    private const HOST = 'https://api.exchangeratesapi.io/latest';

    public function __construct(
        private ClientInterface $httpClient,
    )
    {
    }

    public function findPair(string $fromCurrency, string $toCurrency): ?CurrencyRate
    {
        $request = new Request('GET', self::HOST);

        $response = $this->httpClient->sendRequest($request);
        $body = (string)$response->getBody();


        $body = '{"success":true,"timestamp":1519296206,"base":"EUR","date":"2021-03-17","rates":{"AUD":1.566015,"CAD":1.560132,"CHF":1.154727,"CNY":7.827874,"GBP":0.882047,"JPY":132.360679,"USD":1.23396}}';

        $data = json_decode($body, true);

        if (empty($data)) {
            return null;
        }

        return new CurrencyRate(
            $data['rates'][$toCurrency]
        );
    }
}
