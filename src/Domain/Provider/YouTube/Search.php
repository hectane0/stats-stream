<?php

namespace StatsStream\Domain\Provider\YouTube;


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
}
