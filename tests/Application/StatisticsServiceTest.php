<?php

namespace StatsStream\Test\Application;


use PHPUnit\Framework\TestCase;
use StatsStream\Application\StatisticsService;
use StatsStream\Application\ValueObject\MostPopularGamesResult;
use StatsStream\Application\ValueObject\ProfitableGamesResult;
use StatsStream\Application\ValueObject\UniqueVideosOnTwitchResult;
use StatsStream\Application\ValueObject\WhichGameStreamOnSmashcastResult;

class StatisticsServiceTest extends TestCase
{

    private $service;

    public function __construct($name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);
        $this->service = new StatisticsService();
    }

    public function testIsMostPopularGamesProperlyType()
    {
        $this->assertInstanceOf(MostPopularGamesResult::class, $this->service->getMostPopularGamesFromService('Twitch'));
        $this->assertInstanceOf(MostPopularGamesResult::class, $this->service->getMostPopularGamesFromService('Smashcast'));
    }

    public function testIsProfitableGamesProperlyType()
    {
        $this->assertInstanceOf(ProfitableGamesResult::class, $this->service->profitableGames(10));
    }

    public function testIsWhichGameStreamOnSmashcastProperlyType()
    {
        $this->assertInstanceOf(WhichGameStreamOnSmashcastResult::class, $this->service->whichGameStreamOnSmashcast());
    }

    public function testIsFindUniqueVideosOnTwitchProperlyType()
    {
        $this->assertInstanceOf(UniqueVideosOnTwitchResult::class, $this->service->findUniqueVideosOnTwitch());
    }
}
