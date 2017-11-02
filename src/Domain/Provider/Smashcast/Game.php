<?php

namespace StatsStream\Domain\Provider\Smashcast;


use GuzzleHttp\Client;
use StatsStream\Domain\Exception\GameNotFoundException;
use StatsStream\Domain\Provider\ProviderBase;

class Game extends ProviderBase implements \StatsStream\Domain\Provider\Game
{

    /** @var $client Client */
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
    public function getTotalViewersForGameName(String $name) : int
    {
        $categoryId = $this->searchCategoryFromName($name);

        $result = $this->client->get("game/$categoryId");
        $result = $this->getContentFromGuzzle($result);

        return $result['category']['category_viewers'];
    }

    /**
     * Return smashcast's category id for game name
     * @param String $name Game name
     * @return int
     * @throws GameNotFoundException
     */
    private function searchCategoryFromName(String $name) : int
    {

        $result = $this->client->get('search/games', ['query' => ['q' => $name]]);
        $result = $this->getContentFromGuzzle($result);

        $game = $result['categories'];

        if (0 == count($game)) {
            throw new GameNotFoundException();
        }

        if (count($game) > 1) {
            $game = $this->getMostSimilarGame($name, $game);
        }

        return (int)$game[0]['category_id'];
    }

    /**
     * Search most similar game title when search return more than one result
     * @param String $name Game title
     * @param array $games Set of returned games
     * @return array
     */
    private function getMostSimilarGame(String $name, array $games) : array
    {
        $results = [];
        foreach ($games as $index => $game) {
            similar_text($name, $game['category_name'], $percent);
            $results[$index] = $percent;
        }

        arsort($results);
        reset($results);

        return [$games[key($results)]];
    }
}
