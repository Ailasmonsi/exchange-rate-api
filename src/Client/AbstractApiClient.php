<?php

namespace App\Client;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Log\LoggerInterface;

abstract class AbstractApiClient
{
    public function __construct(
        protected Client $client,
        protected string $apiKey,
        protected string $baseUri,
        protected LoggerInterface $logger
    ) {}

    protected function sendRequest(string $endpoint, array $queryParams): array
    {
        try {
            $response = $this->client->request('GET', $endpoint, [
                'query' => array_merge($queryParams, ['app_id' => $this->apiKey]),
            ]);

            return json_decode($response->getBody()->getContents(), true, flags: JSON_THROW_ON_ERROR);
        } catch (RequestException $e) {
            $this->logger->error('API request failed: ' . $e->getMessage());
            throw new \RuntimeException('Failed to fetch data from the API.');
        }
    }
}
