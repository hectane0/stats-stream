<?php

namespace StatsStream\Infrastructure\ApiClient;


use StatsStream\Config\Parameters;
use TwitchApi\TwitchApi;

class Twitch implements ClientInterface
{
    public static function get()
    {
        $options = [
            'client_id' => Parameters::getTwitchApiKey(),
        ];

        return new TwitchApi($options);
    }
}
