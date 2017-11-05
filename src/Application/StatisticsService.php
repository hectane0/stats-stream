<?php

namespace StatsStream\Application;


use StatsStream\Application\ValueObject\MostPopularGamesResult;
use StatsStream\Application\ValueObject\ProfitableGamesResult;
use StatsStream\Application\ValueObject\UniqueVideosOnTwitchResult;
use StatsStream\Application\ValueObject\WhichGameStreamOnSmashcastResult;
use StatsStream\Domain\Exception\GameNotFoundException;
use StatsStream\Domain\Provider\Game;
use StatsStream\Domain\Provider\Search;
use StatsStream\Domain\Provider\Stream;
use StatsStream\Domain\Provider\Video;
use StatsStream\Domain\Service\StatsService;
use StatsStream\Domain\Statistics;

class StatisticsService
{
    /**
     * Get most popular games with current number of viewers from streaming service
     * Supporting services: Twitch, Smashcast
     * @param string $serviceName e.g. 'Twitch'
     * @param int $limit limit
     * @return MostPopularGamesResult
     */
    public function getMostPopularGamesFromService(String $serviceName, int $limit = 10) : MostPopularGamesResult
    {
        /** @var $stats Stream */
        $stats = (new Statistics($serviceName))->get('Stream');
        return new MostPopularGamesResult($stats->getTopStreamingGames($limit)->getList($limit));
    }

    /**
     * Get most popular games from Twitch and compare them to the number of each game's videos on YouTube
     * Result tell you which game should you place on YouTube
     * @param int $limit Number of considers games
     * @return ProfitableGamesResult Array of games witch most profitable ratio
     */
    public function profitableGames(int $limit): profitableGamesResult
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
     * Get most popular games from Twitch and compare them to the number of each game's viewers on Smashcast
     * Result tell you which game should you stream on Smashcast
     * @return WhichGameStreamOnSmashcastResult
     */
    public function whichGameStreamOnSmashcast(): WhichGameStreamOnSmashcastResult
    {
        /** @var $stats Stream */
        $stats = (new Statistics('Twitch'))->get('Stream');
        $games = $stats->getTopStreamingGames(10)->getList(10);

        /** @var $smashcastGame Game */
        $smashcastGame = (new Statistics('Smashcast'))->get('Game');

        $result = [];
        foreach ($games as $game) {
            try {
                $count = $smashcastGame->getTotalViewersForGameName($game['name']);
            }
            catch (GameNotFoundException $e) {
                continue;
            }
            $count = (0 == $count ? 1 : $count);
            $result[$game['name']] = (float)($game['viewers'] / $count);
        }
        arsort($result);

        return new WhichGameStreamOnSmashcastResult($result);
    }

    /**
     * Get most popular videos from Twitch and check if similar videos exists on YouTube
     * Result tell you if you should create specific or similar videos because so far this kind of video does not exist on YouTube
     * @return UniqueVideosOnTwitchResult
     */
    public function findUniqueVideosOnTwitch() : UniqueVideosOnTwitchResult
    {
        /** @var $stats Video */
        $video = (new Statistics('Twitch'))->get('Video');
        $titles = $video->getMostPopularVideosTitles();

        $statsService = new StatsService();

        $result = [];
        foreach ($titles as $title) {
            if (!$statsService->isSimilarToYouTubeVideos($title)) {
                $result[] = $title;
            }
        }

        return new UniqueVideosOnTwitchResult($result);
    }
}
