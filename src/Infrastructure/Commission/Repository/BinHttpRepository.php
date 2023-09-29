<?php declare(strict_types=1);

namespace Infrastructure\Commission\Repository;

use Application\Commission\ValueObject\Bin;
use Application\Commission\Repository\BinRepository;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;

final readonly class BinHttpRepository implements BinRepository
{
    public function __construct(
        private ClientInterface $httpClient,
        private string $apiHost,
    )
    {
    }

    public function find(int $binNumber): ?Bin
    {
        $request = new Request('GET', $this->apiHost.$binNumber);

        $response = $this->httpClient->sendRequest($request);

        $data = json_decode((string) $response->getBody(), true);

        if (empty($data)) {
            return null;
        }

        return new Bin(
            $data['country']['alpha2']
        );
    }
}
