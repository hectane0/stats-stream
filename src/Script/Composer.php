<?php

namespace StatsStream\Script;


class Composer
{
    public static function copyParameters()
    {
        $projectDir = __DIR__ . "/../";

        $parameters = $projectDir . "Config/Parameters.php";

        if (file_exists($parameters)) {
            echo "Parameters exists! Brake\n";
            return;
        }

        $source = $projectDir . "Config/Parameters.php.example";
        $result = copy($source, $parameters);

        if ($result) {
            echo "Parameters copied! Put there your api keys!\n";
        } else {
            echo "Parameters copying failed! Copy Parameters.php.example to Parameters.php in Config dir and put your api keys!\n";
        }
    }
}
