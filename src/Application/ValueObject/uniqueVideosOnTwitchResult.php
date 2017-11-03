<?php

namespace StatsStream\Application\ValueObject;


class uniqueVideosOnTwitchResult
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
}
