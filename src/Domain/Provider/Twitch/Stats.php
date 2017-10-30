<?php

namespace StatsStream\Domain\Provider\Twitch;


use StatsStream\Domain\Provider\ProviderBase;
use StatsStream\Domain\ValueObject\Stats\MostPopularGamesResult;

class Stats extends ProviderBase implements \StatsStream\Domain\Provider\Stats
{
    /**
     * Return most popular games at this moment
     * @return MostPopularGamesResult
     */
    public function getMostPopularGames() : MostPopularGamesResult
    {
        $result = $this->client->getTopGames(10);

        return new MostPopularGamesResult($this->formatMostPopularGamesResult($result));
    }

    private function formatMostPopularGamesResult($result)
    {
        $return = [];
        foreach ($result['top'] as $row) {
            $return[] = $row['game']['name'];
        }

        return $return;
    }

}
