<?php declare(strict_types=1);

namespace Infrastructure\Commission\Repository;

use Application\Commission\ValueObject\Bin;
use Application\Commission\Repository\BinRepository;
use GuzzleHttp\Psr7\Request;
use Psr\Http\Client\ClientInterface;

final readonly class BinHttpRepository implements BinRepository
{
    private const BINLIST_HOST = 'https://lookup.binlist.net/';

    public function __construct(
        private ClientInterface $httpClient,
    )
    {
    }

    public function find(int $binNumber): ?Bin
    {
        $request = new Request('GET', self::BINLIST_HOST.$binNumber);

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
