<?php

namespace StatsStream\Domain\Provider\Twitch;


use StatsStream\Domain\Provider\ProviderBase;
use TwitchApi\TwitchApi;

class Search extends ProviderBase implements \StatsStream\Domain\Provider\Search
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
    public function getVideosCountForQuery(String $query): int
    {
        $result = $this->client->searchStreams($query);
        return $result['_total'];
    }

    public function getReturnedTitlesForQuery(String $query, int $limit): array
    {
        // TODO: Implement getReturnedTitlesForQuery() method.
        return [];
    }
}
