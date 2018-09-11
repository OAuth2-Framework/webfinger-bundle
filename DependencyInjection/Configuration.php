<?php

declare(strict_types=1);

/*
 * The MIT License (MIT)
 *
 * Copyright (c) 2014-2018 Spomky-Labs
 *
 * This software may be modified and distributed under the terms
 * of the MIT license.  See the LICENSE file for details.
 */

namespace OAuth2Framework\WebFingerBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * @var string
     */
    private $alias;

    /**
     * Configuration constructor.
     */
    public function __construct(string $alias)
    {
        $this->alias = $alias;
    }

    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root($this->alias);

        $rootNode
            ->children()
            ->scalarNode('response_factory')
            ->info('The response factory service')
            ->isRequired()
            ->end()
            ->scalarNode('resource_repository')
            ->info('The resource repository service')
            ->isRequired()
            ->end()
            ->scalarNode('host')
            ->info('The host of the server (e.g. example.com, my-service.net)')
            ->isRequired()
            ->end()
            ->scalarNode('path')
            ->info('The path to the issuer discovery endpoint. Should be "/.well-known/webfinger" for compliance with the RFC7033.')
            ->defaultValue('/.well-known/webfinger')
            ->end()
            ->end();

        return $treeBuilder;
    }
}