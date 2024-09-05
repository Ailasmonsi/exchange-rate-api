<?php

require_once __DIR__ . '/vendor/autoload.php';

use GuzzleHttp\Client;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;
use App\Client\ExchangeRateApiClient;

$config = require __DIR__ . '/src/Config/config.php';

// Настройка логгера
$logger = new Logger('api_logger');
$logger->pushHandler(new StreamHandler(__DIR__ . '/logs/api.log', Logger::WARNING));

// Создание экземпляра клиента Guzzle
$client = new Client([
    'base_uri' => $config['base_uri']
]);

// Создание экземпляра API клиента
$exchangeClient = new ExchangeRateApiClient($client, $config['api_key'], $config['base_uri'], $logger);

try {
    // Пример получения последних курсов
    $latestRates = $exchangeClient->getLatestRates();
    echo 'Base Currency: ' . $latestRates->base . PHP_EOL;
    echo 'Rates: ' . print_r($latestRates->rates, true) . PHP_EOL;

    // Пример получения исторических курсов
    $historicalRates = $exchangeClient->getHistoricalRates('2023-09-05');
    echo 'Historical Base Currency: ' . $historicalRates->base . PHP_EOL;
    echo 'Historical Rates: ' . print_r($historicalRates->rates, true) . PHP_EOL;
} catch (Exception $e) {
    echo 'Error: ' . $e->getMessage();
}
