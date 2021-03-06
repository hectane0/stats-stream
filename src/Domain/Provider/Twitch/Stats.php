<?php

namespace StatsStream\Domain\Provider\Twitch;


use StatsStream\Domain\Provider\ProviderBase;
use TwitchApi\TwitchApi;

class Stats extends ProviderBase implements \StatsStream\Domain\Provider\Stats
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
}
