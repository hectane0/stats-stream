<?php

namespace StatsStream\Infrastructure\ApiClient;


use GuzzleHttp\Client;

class Smashcast implements ClientInterface
{
    public static function get()
    {
        //TODO: Create nice api client for Smashcast
        $client = new Client([
            'base_uri' => 'https://api.smashcast.tv/'
        ]);

        return $client;
    }
}
