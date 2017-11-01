<?php

namespace StatsStream\Infrastructure\ApiClient;


use StatsStream\Config\Parameters;

class YouTube implements ClientInterface
{
    public static function get()
    {
        $client = new \Google_Client();
        $client->setDeveloperKey(Parameters::getYouTubeApiKey());

        return new \Google_Service_YouTube($client);
    }
}
