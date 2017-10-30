<?php

namespace StatsStream\Domain\Provider\YouTube;


use StatsStream\Domain\Provider\ProviderBase;
use StatsStream\Domain\ValueObject\Stats\MostPopularGamesResult;

class Stats extends ProviderBase implements \StatsStream\Domain\Provider\Stats
{
    public function getMostPopularGames() : MostPopularGamesResult
    {
        return new MostPopularGamesResult([]);
    }
}
