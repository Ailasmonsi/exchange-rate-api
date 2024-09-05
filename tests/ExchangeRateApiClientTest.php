<?php

use PHPUnit\Framework\TestCase;
use App\Client\ExchangeRateApiClient;
use GuzzleHttp\Client;
use Psr\Log\NullLogger;
use App\DTO\ExchangeRateDTO;

class ExchangeRateApiClientTest extends TestCase
{
    public function testGetLatestRates()
    {
        $client = new Client(['base_uri' => 'https://openexchangerates.org/api/']);
        $apiKey = 'test_api_key';
        $logger = new NullLogger();

        $exchangeClient = new ExchangeRateApiClient($client, $apiKey, 'https://openexchangerates.org/api/', $logger);

        $this->assertInstanceOf(ExchangeRateApiClient::class, $exchangeClient);
    }
}
