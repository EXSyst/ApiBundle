<?php

/*
 * This file is part of the ApiBundle package.
 *
 * (c) EXSyst
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace EXSyst\Bundle\ApiBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * EXSystApiBundle configuration.
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
        $rootNode = $treeBuilder->root('exsyst_api');

        $rootNode
            ->children()
                ->arrayNode('serialization')
                    ->canBeDisabled()
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('default_format')->cannotBeEmpty()->defaultValue('json')->end()
                    ->end()
                ->end()
                ->arrayNode('routing')
                    ->canBeEnabled()
                ->end()
                ->arrayNode('versioning')
                    ->canBeEnabled()
                    ->children()
                        ->scalarNode('attributeName')->defaultValue('apiVersion')->end()
                        ->scalarNode('default')->defaultNull()->end()
                        ->arrayNode('versions')
                            ->useAttributeAsKey('version')
                            ->prototype('array')
                                ->fixXmlConfig('version', 'versions')
                            ->end()
                        ->end()
                        ->arrayNode('resolvers')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->booleanNode('uri')->defaultTrue()->end()
                                ->booleanNode('query')->defaultTrue()->end()
                                ->booleanNode('constraint')->defaultTrue()->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('parameter')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('validation')
                            ->canBeEnabled()
                            ->children()
                                ->scalarNode('attributeName')->defaultValue('validationErrors')->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
