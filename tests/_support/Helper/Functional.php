<?php declare(strict_types = 1);

namespace Tests\Helper;

use Codeception\Module;
use GuzzleHttp\Client;
use GuzzleHttp\Handler\MockHandler;
use GuzzleHttp\HandlerStack;
use GuzzleHttp\Psr7\Response;
use Psr\Http\Client\ClientInterface;

class Functional extends Module
{
    public function mockResponse(Response ...$response)
    {
        $mock = new MockHandler($response);
        $handlerStack = HandlerStack::create($mock);
        $client = new Client(['handler' => $handlerStack]);

        $this->setService(ClientInterface::class, $client);
    }

    public function setService(string $id, $service): void
    {
        $this->getModule('Symfony')
            ->kernel
            ->getContainer()
            ->set($id, $service);
    }

    public function setParameter(string $name, $value): void
    {
        $this->getModule('Symfony')
            ->kernel
            ->getContainer()
            ->setParameter($name, $value);
    }
}