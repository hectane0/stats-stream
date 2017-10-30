<?php

namespace StatsStream\Domain;


use StatsStream\Domain\Exception\NotImplementedException;

class Statistics
{
    private $providers = [];

    public function __construct($service)
    {
        $this->providers = Factory\StatsProviderFactory::getAvailableProviders($service);
    }

    public function get($name)
    {
        $provider = $this->providers[$name];

        if (null == $provider) {
            throw new NotImplementedException();
        }

        return $provider;
    }
}
