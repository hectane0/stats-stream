<?php

namespace StatsStream\Domain;


use StatsStream\Domain\Exception\ProviderNotImplementedException;

class Statistics
{
    private $providers = [];

    /**
     * Statistics constructor.
     * @param $service
     */
    public function __construct($service)
    {
        $this->providers = Factory\StatsProviderFactory::getAvailableProviders($service);
    }

    public function get($name)
    {
        $provider = $this->providers[$name];

        if (null == $provider) {
            throw new ProviderNotImplementedException();
        }

        return $provider;
    }
}
