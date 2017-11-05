<?php

namespace StatsStream\Application\ValueObject;


use StatsStream\Domain\ValueObject\Spreadsheetable;

class MostPopularGamesResult implements Spreadsheetable
{
    private $list;

    public function __construct(array $list)
    {
        $this->list = $list;
    }

    public function getList() : array
    {
        return $this->list;
    }

    /**
     * @inheritdoc
     */
    public function map(): array
    {
        $result = [];

        $result[] = ['Nazwa', 'Widzów'];
        foreach ($this->list as $row) {
            $result[] = [$row['name'], $row['viewers']];
        }

        return $result;
    }
}
