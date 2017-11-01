<?php

namespace StatsStream\Domain\Provider\Twitch;


use StatsStream\Domain\Provider\ProviderBase;
use StatsStream\Domain\ValueObject\Stream\TopStreamingGamesResult;
use TwitchApi\TwitchApi;

class Stream extends ProviderBase implements \StatsStream\Domain\Provider\Stream
{

    /** @var $client TwitchApi */
    private $client;

    /**
     * @inheritdoc
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function getTopStreamingGames(int $limit = 10) : TopStreamingGamesResult
    {
        $result = $this->client->getTopGames($limit);
        $resultFormatted = $this->formatMostPopularGamesResult($result);

        return new TopStreamingGamesResult($resultFormatted['names'], $resultFormatted['viewers']);
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
