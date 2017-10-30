<?php

namespace StatsStream\Application;


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
        $stats = new Statistics($serviceName);

        return $stats->get('Stats')->getMostPopularGames()->getList($limit);
    }
}
