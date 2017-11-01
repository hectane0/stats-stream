<?php

namespace StatsStream\Domain\Provider;


use StatsStream\Domain\ValueObject\Stream\TopStreamingGamesResult;

interface Stream
{
    /**
     * Stream constructor.
     * @param $client
     */
    public function __construct($client);

    /**
     * Return most popular streaming games at this moment
     * @param $limit
     * @return TopStreamingGamesResult
     */
    public function getTopStreamingGames(int $limit) : TopStreamingGamesResult;

}
