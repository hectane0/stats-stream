<?php

namespace StatsStream\Domain\Provider;


use StatsStream\Domain\ValueObject\Stats\MostPopularGamesResult;

interface Stats
{
    public function getMostPopularGames() : MostPopularGamesResult;
}
