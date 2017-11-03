<?php

namespace StatsStream\Domain\Provider;


interface Video
{

    /**
     * Search constructor.
     * @param $client
     */
    public function __construct($client);

    /**
     * Return titles of most popular videos
     * @param int $limit
     * @return array
     */
    public function getMostPopularVideosTitles(int $limit = 10) : array;

}
