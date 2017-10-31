<?php

namespace StatsStream\Domain\Provider\Twitch;


use StatsStream\Domain\Provider\ProviderBase;
use StatsStream\Domain\ValueObject\Stats\MostPopularGamesResult;
use TwitchApi\TwitchApi;

class Stats extends ProviderBase implements \StatsStream\Domain\Provider\Stats
{

    /** @var $client TwitchApi */
    private $client;

    /**
     * Stats constructor.
     * @param $client
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * Return most popular games at this moment
     * @param $limit
     * @return MostPopularGamesResult
     */
    public function getMostPopularGames(int $limit = 10) : MostPopularGamesResult
    {
        $result = $this->client->getTopGames($limit);
        $resultFormatted = $this->formatMostPopularGamesResult($result);

        return new MostPopularGamesResult($resultFormatted['names'], $resultFormatted['viewers']);
    }

    private function formatMostPopularGamesResult(array $result) : array
    {
        $return = [];
        foreach ($result['top'] as $row) {
            $return['names'][] = $row['game']['name'];
            $return['viewers'][] = $row['viewers'];
        }

        return $return;
    }
}
