<?php

namespace StatsStream\Application\ValueObject;


use StatsStream\Domain\ValueObject\Spreadsheetable;

class ProfitableGamesResult implements Spreadsheetable
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
        $mapped[] = ['Nazwa', 'Współczynnik opłacalności'];
        foreach ($this->list as $key => $value) {
            $mapped[] = [$key, $value];
        }
        return $mapped;
    }
}
