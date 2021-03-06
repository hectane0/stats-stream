<?php

namespace StatsStream\Domain\Provider;


interface Search
{

    /**
     * Search constructor.
     * @param $client
     */
    public function __construct($client);

    /**
     * Return number of result videos for query
     * @param String $query Search query
     * @return int
     */
    public function getVideosCountForQuery(String $query) : int;

    /**
     * Return titles of found videos
     * @param String $query
     * @param int $limit
     * @return array
     */
    public function getReturnedTitlesForQuery(String $query, int $limit) : array;

}
