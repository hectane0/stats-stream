<?php

namespace StatsStream\Domain\Provider;


interface Game
{

    /**
     * Search constructor.
     * @param $client
     */
    public function __construct($client);


    /**
     * Return current number of viewers of given game name
     * @param String $name Game name
     * @return int Number of viewers
     */
    public function getTotalViewersForGameName(String $name) : int;

}
