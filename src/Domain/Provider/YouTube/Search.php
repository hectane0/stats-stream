<?php

namespace StatsStream\Domain\Provider\YouTube;


use Google_Service_YouTube_SearchResult;
use StatsStream\Domain\Provider\ProviderBase;

class Search extends ProviderBase implements \StatsStream\Domain\Provider\Search
{

    /** @var $client \Google_Service_YouTube */
    private $client;

    /**
     * @inheritdoc
     */
    public function __construct($client)
    {
        $this->client = $client;
    }

    /**
     * @inheritdoc
     */
    public function getVideosCountForQuery(String $query): int
    {
        $date = new \DateTime('-1 month');  // Na razie trzeba ograniczyć bo maksymalna zwracana wartość to 1000000. Może parsować stronę?
        $response  = $this->client->search->listSearch('snippet', ['maxResults' => 0, 'q' => $query, 'type' => 'video', 'publishedAfter' => $date->format(DATE_RFC3339)]);

        return $response->getPageInfo()->getTotalResults();
    }

    public function getReturnedTitlesForQuery(String $query, int $limit): array
    {
        $response  = $this->client->search->listSearch('snippet', ['maxResults' => $limit, 'q' => $query, 'type' => 'video']);

        $result = [];

        /** @var $row Google_Service_YouTube_SearchResult */
        foreach ($response->getItems() as $row) {
            $result[] = $row->getSnippet()->getTitle();
        }

        return $result;
    }
}
