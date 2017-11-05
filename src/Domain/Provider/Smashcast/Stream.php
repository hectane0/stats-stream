<?php

namespace StatsStream\Domain\Provider\Smashcast;


use GuzzleHttp\Client;
use Psr\Http\Message\ResponseInterface;
use StatsStream\Domain\Provider\ProviderBase;
use StatsStream\Domain\ValueObject\Stream\TopStreamingGamesResult;

class Stream extends ProviderBase implements \StatsStream\Domain\Provider\Stream
{

    /** @var $client Client */
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
        $result = $this->client->get('games', ['query' => ['limit' => $limit]]);
        $result = $this->getContentFromGuzzle($result);
        $resultFormatted = $this->formatMostPopularGamesResult($result);

        return new TopStreamingGamesResult($resultFormatted['names'], $resultFormatted['viewers']);

    }

    private function formatMostPopularGamesResult(array $result) : array
    {
        $return = [];
        foreach ($result['categories'] as $row) {
            $return['names'][] = (String)$row['category_name'];
            $return['viewers'][] = (int)$row['category_viewers'];
        }

        return $return;
    }
}
