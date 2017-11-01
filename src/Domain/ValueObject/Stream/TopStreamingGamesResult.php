<?php

namespace StatsStream\Domain\ValueObject\Stream;


use StatsStream\Domain\ValueObject\Spreadsheetable;

class TopStreamingGamesResult implements Spreadsheetable
{
    private $list;

    /**
     * MostPopularGamesResult constructor.
     * @param array $names Names of games
     * @param array $viewers Numbers of viewers. Must be corresponding to names
     * @throws \Exception
     * @internal param array $list
     */
    public function __construct(array $names, array $viewers)
    {
        if (count($names) !== count($viewers)) {
            throw new \Exception("Arrays' size must be the same.");
        }

        foreach (array_combine($names, $viewers) as $name => $viewers) {
            $this->list[] = ['name' => $name, 'viewers' => $viewers];
        }
    }

    /**
     * @param $limit
     * @return array
     */
    public function getList($limit) : array
    {
        return array_slice($this->list, 0, $limit);
    }

    /**
     * @param int $position
     * @return String
     */
    public function getPosition(int $position) : String
    {
        return $this->list[$position - 1];
    }

    public function map() : array
    {
        return $this->list;
    }
}
