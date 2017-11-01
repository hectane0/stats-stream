<?php

namespace StatsStream\Domain\Provider;


use Psr\Http\Message\ResponseInterface;

abstract class ProviderBase
{
    public function getContentFromGuzzle(ResponseInterface $result) : array
    {
        $return = \GuzzleHttp\json_decode($result->getBody()->getContents(), true);

        if (!isset($return)) {
            $return = [];
        }

        return $return;
    }
}
