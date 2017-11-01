<?php

namespace StatsStream\Application;


use StatsStream\Domain\Provider\Search;
use StatsStream\Domain\Provider\Stream;
use StatsStream\Domain\Statistics;

class StatisticsService
{
    /**
     * @param string $serviceName e.g. YouTube, Twitch
     * @param int $limit
     * @return mixed
     */
    public function getMostPopularGamesFromService(String $serviceName, int $limit = 10)
    {
        /** @var $stats Stream */
        $stats = (new Statistics($serviceName))->get('Stream');

        return $stats->getTopStreamingGames($limit)->getList($limit);
    }

    /**
     * Get most popular games from Twitch and compare them to the number of each game's videos on YouTube
     * @param int $limit Number of considers games
     * @param bool $asXls
     * @return array Array of games witch most profitable ratio
     */
    public function profitableGames(int $limit, bool $asXls = false)
    {
        /** @var $stats Stream */
        $stats = (new Statistics('Twitch'))->get('Stream');
        $games = $stats->getTopStreamingGames($limit)->getList($limit);

        /** @var $search Search */
        $search = (new Statistics('YouTube'))->get('Search');

        $result = [];
        foreach ($games as $game) {
            $videos = $search->getVideosCountForQuery($game['name']);
            $videos = ($videos == 0 ? 1 : $videos);
            $result[$game['name']] = $game['viewers'] / $videos;
        }
        arsort($result);

        return $result;
    }
}
