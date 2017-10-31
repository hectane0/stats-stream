<?php
/**
 * Created by PhpStorm.
 * User: patryk
 * Date: 10/31/17
 * Time: 7:41 PM
 */

namespace StatsStream\Test\Application;

use PHPUnit\Framework\TestCase;
use StatsStream\Domain\Statistics;
use StatsStream\Domain\ValueObject\Stats\MostPopularGamesResult;

class StatisticsServiceTest extends TestCase
{
    public function testIsMostPopularGamesProperlyType()
    {
        $stats = (new Statistics('Twitch'))->get('Stats')->getMostPopularGames();
        $this->assertInstanceOf(MostPopularGamesResult::class, $stats);
    }
}
