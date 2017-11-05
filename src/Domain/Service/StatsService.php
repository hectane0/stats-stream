<?php

namespace StatsStream\Domain\Service;


use StatsStream\Domain\Provider\Search;
use StatsStream\Domain\Statistics;

class StatsService
{

    public function isSimilarToYouTubeVideos($title)
    {
        $simpleTitle = preg_replace("/[^a-zA-Z ']/", "", $title);

        /** @var $search Search */
        $search = (new Statistics('YouTube'))->get('Search');
        $results = $search->getReturnedTitlesForQuery($simpleTitle, 10);

        foreach ($results as $result) {
            similar_text($title, $result, $percent);

            if ($percent > 35) {
                return true;
            }
        }
        return false;
    }
}
