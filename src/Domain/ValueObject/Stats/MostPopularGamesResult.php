<?php

namespace StatsStream\Domain\ValueObject\Stats;


class MostPopularGamesResult
{
    private $list;

    /**
     * MostPopularGamesResult constructor.
     * @param array $list
     */
    public function __construct(array $list)
    {
        $this->list = $list;
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
        return $this->list[$position-1];
    }
}
