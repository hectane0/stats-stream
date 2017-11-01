<?php

namespace StatsStream\Test\Application;


use PHPUnit\Framework\TestCase;
use StatsStream\Domain\Statistics;
use StatsStream\Domain\ValueObject\Stats\MostPopularGamesResult;
use StatsStream\Domain\ValueObject\Stream\TopStreamingGamesResult;

class StatisticsServiceTest extends TestCase
{
    public function testIsMostPopularGamesProperlyType()
    {
        $stats = (new Statistics('Twitch'))->get('Stream')->getTopStreamingGames();
        $this->assertInstanceOf(TopStreamingGamesResult::class, $stats);
    }
}
