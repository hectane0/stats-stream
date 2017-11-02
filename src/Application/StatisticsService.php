<?php

namespace StatsStream\Application;


use StatsStream\Application\ValueObject\profitableGamesResult;
use StatsStream\Application\ValueObject\whichGameStreamOnSmashcastResult;
use StatsStream\Domain\Provider\Game;
use StatsStream\Domain\Provider\Search;
use StatsStream\Domain\Provider\Stream;
use StatsStream\Domain\Spreadsheet;
use StatsStream\Domain\Statistics;
use StatsStream\Domain\ValueObject\Stream\TopStreamingGamesResult;

class StatisticsService
{
    /**
     * @param string $serviceName e.g. YouTube, Twitch
     * @param int $limit
     * @return TopStreamingGamesResult
     */
    public function getMostPopularGamesFromService(String $serviceName, int $limit = 10)
    {
        /** @var $stats Stream */
        $stats = (new Statistics($serviceName))->get('Stream');

        return $stats->getTopStreamingGames($limit);
    }

    /**
     * Get most popular games from Twitch and compare them to the number of each game's videos on YouTube
     * Result tell you which game should you place on YouTube
     * @param int $limit Number of considers games
     * @return profitableGamesResult Array of games witch most profitable ratio
     */
    public function profitableGames(int $limit) :profitableGamesResult
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

        return new profitableGamesResult($result);
    }

    /**
     * Download list of most most profitable games as xls
     * @param int $limit Number of considers games
     */
    public function profitableGamesSheet(int $limit)
    {
        $result = $this->profitableGames($limit);

        $creator = new Spreadsheet();
        $file = $creator->generate($result);

        $this->downloadSheet($file);
    }


    /**
     * Get most popular games from Twitch and compare them to the number of each game's viewers on Smashcast
     * Result tell you which game should you stream on Smashcast
     * @return whichGameStreamOnSmashcastResult
     */
    public function whichGameStreamOnSmashcast() : whichGameStreamOnSmashcastResult
    {
        /** @var $stats Stream */
        $stats = (new Statistics('Twitch'))->get('Stream');
        $games = $stats->getTopStreamingGames(10)->getList(10);

        /** @var $smashcastGame Game */
        $smashcastGame = (new Statistics('Smashcast'))->get('Game');

        $result = [];
        foreach ($games as $game) {
            $count = $smashcastGame->getTotalViewersForGameName($game['name']);
            $count = (0 == $count ? 1: $count);
            $result[$game['name']] = (float)($game['viewers'] / $count);
        }
        arsort($result);

        return new whichGameStreamOnSmashcastResult($result);
    }

    private function downloadSheet($file)
    {
        header('Content-Disposition: attachment; filename="result.xls"');
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $file;
        die;
    }
}
