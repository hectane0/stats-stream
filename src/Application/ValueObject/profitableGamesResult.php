<?php

namespace StatsStream\Application\ValueObject;


use StatsStream\Domain\ValueObject\Spreadsheetable;

class profitableGamesResult implements Spreadsheetable
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
        $mapped = [];
        foreach ($this->list as $key => $value) {
            $mapped[] = [$key, $value];
        }
        return $mapped;
    }
}
