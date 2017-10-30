<?php

namespace StatsStream\Domain\Provider;


abstract class ProviderBase
{
    protected $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

}
