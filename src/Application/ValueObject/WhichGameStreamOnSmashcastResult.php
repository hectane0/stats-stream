<?php

namespace StatsStream\Application\ValueObject;


use StatsStream\Domain\ValueObject\Spreadsheetable;

class WhichGameStreamOnSmashcastResult implements Spreadsheetable
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
        $result[] = ['Nazwa', 'Współczynnik opłacalności'];
        foreach ($this->list as $key => $value) {
            $result[] = [$key, $value];
        }
        return $result;
    }
}
