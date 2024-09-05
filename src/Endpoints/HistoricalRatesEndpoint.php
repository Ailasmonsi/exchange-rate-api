<?php

namespace App\Endpoints;

class HistoricalRatesEndpoint
{
    private string $date;

    public function __construct(string $date)
    {
        $this->date = $date;
    }

    public function getPath(): string
    {
        return "historical/{$this->date}.json";
    }
}
