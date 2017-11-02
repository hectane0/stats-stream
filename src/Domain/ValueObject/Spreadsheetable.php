<?php

namespace StatsStream\Domain\ValueObject;


interface Spreadsheetable
{

    /**
     * Return array which can by save as csv with fputcsv() function.
     * @return array
     */
    public function map() : array;
}
