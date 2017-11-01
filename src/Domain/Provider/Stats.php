<?php

namespace StatsStream\Domain\Provider;


interface Stats
{
    /**
     * Stream constructor.
     * @param $client
     */
    public function __construct($client);
}
