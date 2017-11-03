<?php

namespace StatsStream\Domain\Provider\Twitch;


use StatsStream\Domain\Provider\ProviderBase;
use TwitchApi\TwitchApi;

class Game extends ProviderBase implements \StatsStream\Domain\Provider\Game
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
    public function getTotalViewersForGameName(String $name) : int
    {
        $result = $this->client->getStreamsSummary($name);
        return $result['viewers'];
    }
}
