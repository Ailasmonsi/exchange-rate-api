<?php

namespace App\Client;

use App\DTO\ExchangeRateDTO;
use App\Endpoints\LatestRatesEndpoint;
use App\Endpoints\HistoricalRatesEndpoint;

class ExchangeRateApiClient extends AbstractApiClient
{
    public function getLatestRates(string $base = 'USD'): ExchangeRateDTO
    {
        $endpoint = new LatestRatesEndpoint();
        $response = $this->sendRequest($endpoint->getPath(), ['base' => $base]);

        return new ExchangeRateDTO($response['base'], $response['rates'], $response['timestamp']);
    }

    public function getHistoricalRates(string $date, string $base = 'USD'): ExchangeRateDTO
    {
        $endpoint = new HistoricalRatesEndpoint($date);
        $response = $this->sendRequest($endpoint->getPath(), ['base' => $base]);

        return new ExchangeRateDTO($response['base'], $response['rates'], $response['timestamp']);
    }
}
