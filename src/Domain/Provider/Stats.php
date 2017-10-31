<?php

namespace StatsStream\Domain\Provider;


use StatsStream\Domain\ValueObject\Stats\MostPopularGamesResult;

interface Stats
{
    public function __construct($client);

    public function getMostPopularGames(int $limit) : MostPopularGamesResult;
}
