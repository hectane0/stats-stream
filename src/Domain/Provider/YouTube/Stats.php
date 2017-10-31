<?php

namespace StatsStream\Domain\Provider\YouTube;


use StatsStream\Domain\Provider\ProviderBase;
use StatsStream\Domain\ValueObject\Stats\MostPopularGamesResult;

class Stats extends ProviderBase implements \StatsStream\Domain\Provider\Stats
{
    private $client;

    public function __construct($client)
    {
        $this->client = $client;
    }

    public function getMostPopularGames(int $limit = 10) : MostPopularGamesResult
    {
        return new MostPopularGamesResult([], []);
    }
}
