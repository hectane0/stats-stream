<?php

namespace StatsStream\Application;


use StatsStream\Domain\ValueObject\Spreadsheetable;

class SpreadsheetService
{

    private $generator;

    // TODO: Inject generate provider to extend generating to other formats
    public function __construct()
    {
    }

    public function download(Spreadsheetable $result)
    {
        $array = $result->map();
        $out = fopen("php://output", 'w');

        foreach ($array as $row) {
            fputcsv($out, $row,"\t");
        }
        fclose($out);

        $this->downloadSheet($out);
    }

    private function downloadSheet($file)
    {
        header('Content-Disposition: attachment; filename="result.xls"');
        header("Content-Type: application/vnd.ms-excel;");
        header("Pragma: no-cache");
        header("Expires: 0");

        echo $file;
        die;
    }
}
