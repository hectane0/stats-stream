<?php

namespace StatsStream\Domain\Provider\Twitch;


use StatsStream\Domain\Provider\ProviderBase;
use TwitchApi\TwitchApi;

class Video extends ProviderBase implements \StatsStream\Domain\Provider\Video
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


    public function getMostPopularVideosTitles(int $limit = 10): array
    {
        $response = $this->client->getTopVideos($limit);

        $result = [];
        foreach ($response['vods'] as $row) {
            $result[] = $row['title'];
        }

        return $result;
    }
}
