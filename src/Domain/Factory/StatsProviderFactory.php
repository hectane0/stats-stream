<?php

namespace StatsStream\Domain\Factory;


use StatsStream\Domain\Exception\ClientNotImplementedException;
use StatsStream\Infrastructure\ApiClient\ClientInterface;

class StatsProviderFactory
{
    const PROVIDERS = ['Stats', 'Stream'];

    /**
     * Return array od implemented providers for streaming service
     * @param string $service
     * @return array
     * @throws ClientNotImplementedException
     */
    public static function getAvailableProviders(String $service) : array
    {
        $providers = [];

        foreach (self::PROVIDERS as $provider) {

            $class = "StatsStream\\Domain\\Provider\\$service\\$provider";

            if (class_exists($class)) {

                /**@var $clientClass ClientInterface */
                $clientClass = "StatsStream\\Infrastructure\\ApiClient\\$service";

                if (!class_exists($clientClass)) {
                    throw new ClientNotImplementedException();
                }

                $client = $clientClass::get();
                $providers[$provider] = new $class($client);
            }
        }
        return $providers;
    }
}
