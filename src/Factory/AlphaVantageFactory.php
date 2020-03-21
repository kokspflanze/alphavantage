<?php

declare(strict_types=1);

namespace AlphaVantage\Factory;

use AlphaVantage\Client;
use AlphaVantage\Options;
use Psr\Container\ContainerInterface;

class AlphaVantageFactory
{
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null): Client
    {
        $config      = $container->has('config') ? $container->get('config') : [];
        $options     = $config['alpha_vantage'] ?? [];
        if (! isset($options['api_key'])) {
            throw new \UnexpectedValueException("Missing 'api_key' key for the alpha vantange configuration");
        }

        $option = new Options();
        $option->setApiKey($options['api_key']);

        $client = new Client($option);

        return $client;
    }
}