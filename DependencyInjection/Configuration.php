<?php

namespace EXSyst\Bundle\RestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * EXSystRestBundle configuration.
 *
 * @author Ener-Getick <egetick@gmail.com>
 */
class Configuration implements ConfigurationInterface
{
    /**
     * Generates the configuration tree.
     *
     * @return TreeBuilder
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('exsyst_rest');

        $rootNode
            ->children()
                ->arrayNode('serializer')
                    ->scalarNode('default_format')->setDefaultValue('json')->end()
                ->end()
            ->end();
    }
}