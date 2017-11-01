<?php

namespace StatsStream\Domain\ValueObject;


interface Spreadsheetable
{

    /**
     *
     * @return array
     */
    public function map() : array;
}
