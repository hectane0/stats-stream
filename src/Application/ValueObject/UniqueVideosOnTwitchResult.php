<?php

namespace StatsStream\Application\ValueObject;


use StatsStream\Domain\ValueObject\Spreadsheetable;

class UniqueVideosOnTwitchResult implements Spreadsheetable
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

    public function map(): array
    {
        $result = [];
        $result[] = ['Nazwa'];

        foreach ($this->list as $row) {
            $result[] = [$row];
        }
        return $result;
    }
}
