<?php

namespace App\Endpoints;

class LatestRatesEndpoint
{
    public function getPath(): string
    {
        return 'latest.json';
    }
}
