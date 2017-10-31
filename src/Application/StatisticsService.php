<?php

namespace StatsStream\Application;


use StatsStream\Domain\Provider\Stats;
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
        /** @var $stats Stats */
        $stats = (new Statistics($serviceName))->get('Stats');

        return $stats->getMostPopularGames($limit)->getList($limit);
    }
}
