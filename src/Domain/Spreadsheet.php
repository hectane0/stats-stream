<?php

namespace StatsStream\Domain;


use StatsStream\Domain\ValueObject\Spreadsheetable;

class Spreadsheet
{
    public function generate(Spreadsheetable $result)
    {
        $array = $result->map();

        $out = fopen("php://output", 'w');

        foreach ($array as $row)
        {
            fputcsv($out, $row,"\t");
        }
        fclose($out);

    }
}
